<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Review;
use App\Models\Seller;
use App\Utils\Helpers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Nette\Utils\DateTime;
use App\Models\CustomPage;
use App\Models\DeliveryMan;
use App\Models\OrderDetail;
use App\Traits\CommonTrait;
use App\Utils\ImageManager;
use App\Utils\OrderManager;
use Illuminate\Support\Arr;
use App\Models\DealOfTheDay;
use App\Models\MostDemanded;
use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Models\SupportTicket;
use App\Utils\ProductManager;
use App\Models\FamilyRelation;
use App\Models\ProductCompare;
use App\Utils\CustomerManager;
use App\Models\DeliveryZipCode;
use App\Models\ShippingAddress;
use App\Events\OrderStatusEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    use CommonTrait;

    public function __construct(
        private Product      $product,
        private Order        $order,
        private OrderDetail  $order_details,
        private Category     $category,
        private Seller       $seller,
        private Review       $review,
        private DealOfTheDay $deal_of_the_day,
        private Banner       $banner,
        private MostDemanded $most_demanded,
        private DeliveryMan $deliver_man,
        private ProductCompare $compare,
        private Wishlist $wishlist,
    )
    {

    }

    public function user_profile(Request $request)
    {
        $wishlists = $this->wishlist->whereHas('wishlistProduct', function ($q) {
            return $q;
        })->where('customer_id', auth('customer')->id())->count();
        $total_order = $this->order->where('customer_id', auth('customer')->id())->count();
        $total_loyalty_point = auth('customer')->user()->loyalty_point;
        $total_wallet_balance = auth('customer')->user()->wallet_balance;
        $addresses = ShippingAddress::where('customer_id', auth('customer')->id())->latest()->get();
        $customer_detail = User::where('id', auth('customer')->id())->first();

        return view(VIEW_FILE_NAMES['user_profile'], compact('customer_detail', 'addresses', 'wishlists', 'total_order', 'total_loyalty_point', 'total_wallet_balance'));
    }

    public function user_account(Request $request)
    {
        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $customerDetail = User::where('id', auth('customer')->id())->first();
        return view(VIEW_FILE_NAMES['user_account'], compact('customerDetail'));

    }
    public function user_update(Request $request)
    {
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
        ], [
            'f_name.required' => 'First name is required',
            'l_name.required' => 'Last name is required',
        ]);
        if ($request->password) {
            $request->validate([
                'password' => 'required|min:8|same:confirm_password'
            ]);
        }

        if (User::where('id', '!=', auth('customer')->id())->where(['phone'=>$request['phone']])->first()) {
            Toastr::warning(translate('phone_already_taken'));
            return back();
        }

        $image = $request->file('image');

        if ($image != null) {
            $imageName = ImageManager::update('profile/', auth('customer')->user()->image, 'webp', $request->file('image'));
        } else {
            $imageName = auth('customer')->user()->image;
        }

        User::where('id', auth('customer')->id())->update([
            'image' => $imageName,
        ]);

        $userDetails = [
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'phone' => $request->phone,
            'password' => strlen($request->password) > 5 ? bcrypt($request->password) : auth('customer')->user()->password,
        ];
        if (auth('customer')->check()) {
            User::where(['id' => auth('customer')->id()])->update($userDetails);
            Toastr::info(translate('updated_successfully'));
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function account_address_add()
    {
        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $zip_restrict_status = Helpers::get_business_settings('delivery_zip_code_area_restriction');
        $default_location = Helpers::get_business_settings('default_location');

        $countries = $country_restrict_status ? $this->get_delivery_country_array() : COUNTRIES;

        $zip_codes = $zip_restrict_status ? DeliveryZipCode::all() : 0;

        if (auth('customer')->check()) {
            return view(VIEW_FILE_NAMES['account_address_add'], compact('countries', 'zip_restrict_status', 'zip_codes', 'default_location'));
        }else{
            Toastr::error(translate('please_login_first'));
            return back()->withErrors(['login' => 'Login']);
        }

    }

    public function account_delete($id)
    {
        if (auth('customer')->id() == $id) {
            $user = User::find($id);

            $ongoing = ['out_for_delivery','processing','confirmed', 'pending'];
            $order = Order::where('customer_id', $user->id)->whereIn('order_status', $ongoing)->count();
            if($order>0){
                Toastr::warning(translate('you_can`t_delete_account_due_ongoing_order'));
                return redirect()->back();
            }
            auth()->guard('customer')->logout();

            ImageManager::delete('/profile/' . $user['image']);
            session()->forget('wish_list');

            $user->delete();
            Toastr::info(translate('Your_account_deleted_successfully!!'));
            return redirect()->route('home');
        }

        Toastr::warning(translate('access_denied').'!!');
        return back();
    }

    public function account_address(): View|RedirectResponse
    {
        $country_restrict_status = getWebConfig(name: 'delivery_country_restriction');
        $zip_restrict_status = getWebConfig(name: 'delivery_zip_code_area_restriction');

        $countries = $country_restrict_status ? $this->get_delivery_country_array() : COUNTRIES;
        $zip_codes = $zip_restrict_status ? DeliveryZipCode::all() : 0;

        if (auth('customer')->check()) {
            $shippingAddresses = ShippingAddress::where('customer_id', auth('customer')->id())->latest()->get();
            return view('web-views.users-profile.account-address', compact('shippingAddresses', 'country_restrict_status', 'zip_restrict_status', 'countries', 'zip_codes'));
        } else {
            return redirect()->route('home');
        }
    }

    public function address_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $zip_restrict_status = Helpers::get_business_settings('delivery_zip_code_area_restriction');

        $country_exist = self::delivery_country_exist_check($request->country);
        $zipcode_exist = self::delivery_zipcode_exist_check($request->zip);

        if ($country_restrict_status && !$country_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_country!'));
            return back();
        }

        if ($zip_restrict_status && !$zipcode_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_zip_code_area!'));
            return back();
        }

        $address = [
            'customer_id' => auth('customer')->check() ? auth('customer')->id() : null,
            'contact_person_name' => $request->name,
            'address_type' => $request->addressAs,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone' => $request->phone,
            'is_billing' => $request->is_billing,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('shipping_addresses')->insert($address);

        Toastr::success(translate('address_added_successfully!'));

        if(theme_root_path() == 'default'){
            return back();
        }else{
            return redirect()->route('user-profile');
        }
    }

    public function address_edit(Request $request, $id)
    {
        $shippingAddress = ShippingAddress::where('customer_id', auth('customer')->id())->find($id);
        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $zip_restrict_status = Helpers::get_business_settings('delivery_zip_code_area_restriction');

        if ($country_restrict_status) {
            $delivery_countries = self::get_delivery_country_array();
        } else {
            $delivery_countries = 0;
        }
        if ($zip_restrict_status) {
            $delivery_zipcodes = DeliveryZipCode::all();
        } else {
            $delivery_zipcodes = 0;
        }
        if (isset($shippingAddress)) {
            return view(VIEW_FILE_NAMES['account_address_edit'], compact('shippingAddress', 'country_restrict_status', 'zip_restrict_status', 'delivery_countries', 'delivery_zipcodes'));
        } else {
            Toastr::warning(translate('access_denied'));
            return back();
        }
    }

    public function address_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $zip_restrict_status = Helpers::get_business_settings('delivery_zip_code_area_restriction');

        $country_exist = self::delivery_country_exist_check($request->country);
        $zipcode_exist = self::delivery_zipcode_exist_check($request->zip);

        if ($country_restrict_status && !$country_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_country!'));
            return back();
        }

        if ($zip_restrict_status && !$zipcode_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_zip_code_area!'));
            return back();
        }


        $updateAddress = [
            'contact_person_name' => $request->name,
            'address_type' => $request->addressAs,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone' => $request->phone,
            'is_billing' => $request->is_billing,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        if (auth('customer')->check()) {
            ShippingAddress::where('id', $request->id)->update($updateAddress);
            Toastr::success(translate('address_updated_successfully!'));
            return redirect()->back();
        } else {
            Toastr::error(translate('Insufficient_permission!'));
            return redirect()->back();
        }
    }

    public function address_delete(Request $request)
    {
        if (auth('customer')->check()) {
            ShippingAddress::destroy($request->id);
            Toastr::success(translate('address_Delete_Successfully'));
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function account_payment()
    {
        if (auth('customer')->check()) {
            return view('web-views.users-profile.account-payment');

        } else {
            return redirect()->route('home');
        }

    }

    public function account_order(Request $request)
    {
        $order_by = $request->order_by ?? 'desc';
        if(theme_root_path() == 'theme_fashion'){
            $show_order = $request->show_order ?? 'ongoing';

            $array = ['pending','confirmed','out_for_delivery','processing'];
            $orders = $this->order->withSum('orderDetails', 'qty')
                ->where(['customer_id'=> auth('customer')->id(), 'is_guest'=>'0'])
                ->when($show_order == 'ongoing', function($query) use($array){
                    $query->whereIn('order_status',$array);
                })
                ->when($show_order == 'previous', function($query) use($array){
                    $query->whereNotIn('order_status',$array);
                })
                ->when($request['search'], function($query) use($request){
                        $query->where('id', 'like', "%{$request['search']}%");
                })
                ->orderBy('id', $order_by)->paginate(10)->appends(['show_order'=>$show_order, 'search'=>$request->search]);
        }else{
            $orders = $this->order->withSum('orderDetails', 'qty')->where(['customer_id'=> auth('customer')->id(), 'is_guest'=>'0'])
                ->orderBy('id', $order_by)
                ->paginate(10);
        }

        return view(VIEW_FILE_NAMES['account_orders'], compact('orders', 'order_by'));
    }

    public function account_order_details(Request $request)
    {
        $order = $this->order->with(['deliveryManReview','customer','offlinePayments', 'details.product.reviewsByCustomer' => function($query){
            return $query->where('customer_id', auth('customer')->id());
        }])
        ->where(['customer_id'=>auth('customer')->id(), 'is_guest'=>'0'])
        ->find($request->id);
        $order?->details?->map(function($detail)use($order){
            $order['total_qty'] += $detail->qty;
        });

        $refund_day_limit = \App\Utils\Helpers::get_business_settings('refund_day_limit');
        $current_date = \Carbon\Carbon::now();
        if($order){
            return view(VIEW_FILE_NAMES['account_order_details'], compact('order', 'refund_day_limit', 'current_date'));
        }

        Toastr::warning(translate('invalid_order'));
        return redirect()->route('account-oder');
    }

    public function account_order_details_seller_info(Request $request)
    {
        $order = $this->order->with(['seller.shop'])->find($request->id);
        if(!$order) {
            Toastr::warning(translate('invalid_order'));
            return redirect()->route('account-oder');
        }
        $product_ids = $this->product->where(['added_by' => $order->seller_is , 'user_id'=>$order->seller_id])->pluck('id');
        $rating = $this->review->whereIn('product_id', $product_ids);
        $avg_rating = $rating->avg('rating') ?? 0 ;
        $rating_percentage = round(($avg_rating * 100) / 5);
        $rating_count = $rating->count();
        $product_count = $this->product->where(['added_by' => $order->seller_is , 'user_id'=>$order->seller_id])->active()->count();

        return view(VIEW_FILE_NAMES['seller_info'], compact('avg_rating', 'product_count', 'rating_count', 'order', 'rating_percentage'));

    }

    public function account_order_details_delivery_man_info(Request $request)
    {

        $order = $this->order->with(['verificationImages', 'details.product','deliveryMan.rating', 'deliveryManReview','deliveryMan'=>function($query){
                return $query->withCount('review');
            }])->find($request->id);

        if(!$order) {
            Toastr::warning(translate('invalid_order'));
            return redirect()->route('account-oder');
        }

        if(theme_root_path() == 'theme_fashion' || theme_root_path() == 'default') {
            foreach($order->details as $details) {
                if($details->product) {
                    if($details->product->product_type == 'physical'){
                        $order['product_type_check'] = $details->product->product_type;
                        break;
                    }else{
                        $order['product_type_check'] = $details->product->product_type;
                    }
                }
            }
        }

        $delivered_count = $this->order->where(['order_status' => 'delivered', 'delivery_man_id' => $order->delivery_man_id, 'delivery_type' => 'self_delivery'])->count();

        return view(VIEW_FILE_NAMES['delivery_man_info'], compact('delivered_count', 'order'));
    }
    public function account_order_details_reviews(Request $request){
        $order = $this->order->with('orderDetails.product.reviewsByCustomer')->where(['id' => $request->id])->first();
        if(!$order) {
            Toastr::warning(translate('invalid_order'));
            return redirect()->route('account-oder');
        }
        return view(VIEW_FILE_NAMES['order_details_review'], compact('order'));
    }


    public function account_wishlist()
    {
        if (auth('customer')->check()) {
            $wishlists = Wishlist::where('customer_id', auth('customer')->id())->get();
            return view('web-views.products.wishlist', compact('wishlists'));
        } else {
            return redirect()->route('home');
        }
    }

    public function account_tickets()
    {
        if (auth('customer')->check()) {
                $supportTickets = SupportTicket::where('customer_id', auth('customer')->id())->latest()->paginate(10);
            return view(VIEW_FILE_NAMES['account_tickets'], compact('supportTickets'));
        } else {
            // return redirect()->route('home');
            Toastr::error(translate('please_login_first'));
            return back();
        }
    }

    public function submitSupportTicket(Request $request): RedirectResponse
    {
        $request->validate([
            'ticket_subject' => 'required',
            'ticket_type' => 'required',
            'ticket_priority' => 'required',
            'ticket_description' => 'required_without_all:image.*',
            'image.*' => 'required_without_all:ticket_description|image|mimes:jpeg,png,jpg,gif|max:6000',
        ], [
            'ticket_subject.required' => translate('The_ticket_subject_is_required'),
            'ticket_type.required' => translate('The_ticket_type_is_required'),
            'ticket_priority.required' => translate('The_ticket_priority_is_required'),
            'ticket_description.required_without_all' => translate('Either_a_ticket_description_or_an_image_is_required'),
            'image.*.required_without_all' => translate('Either_a_ticket_description_or_an_image_is_required'),
            'image.*.image' => translate('The_file_must_be_an_image'),
            'image.*.mimes' => translate('The_file_must_be_of_type:_jpeg,_png,_jpg,_gif'),
            'image.*.max' => translate('The_image_must_not_exceed_6_MB'),
        ]);

        $image = [] ;
        if ($request->file('image')) {
            foreach ($request['image'] as $key => $value) {
                $image_name = ImageManager::upload('support-ticket/', 'webp', $value);
                $image[] = $image_name;
            }
        }

        $ticket = [
            'subject' => $request['ticket_subject'],
            'type' => $request['ticket_type'],
            'customer_id' => auth('customer')->check() ? auth('customer')->id() : null,
            'priority' => $request['ticket_priority'],
            'description' => $request['ticket_description'],
            'attachment' => json_encode($image),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('support_tickets')->insert($ticket);
        return back();
    }

    public function single_ticket(Request $request)
    {
        $ticket = SupportTicket::with(['conversations'=>function($query){
            $query->when(theme_root_path() == 'default' ,function($sub_query){
                $sub_query->orderBy('id', 'desc');
            });
        }])->where('id', $request->id)->first();
        return view(VIEW_FILE_NAMES['ticket_view'], compact('ticket'));
    }

    public function comment_submit(Request $request, $id)
    {
        if( $request->file('image') == null && empty($request['comment'])) {
            Toastr::error(translate('type_something').'!');
            return back();
        }

        DB::table('support_tickets')->where(['id' => $id])->update([
            'status' => 'open',
            'updated_at' => now(),
        ]);

        $image = [];
        if ($request->file('image')) {
            $validator =  $request->validate([
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:6000'
            ]);
            foreach ($request->image as $key=>$value) {
                $image_name = ImageManager::upload('support-ticket/', 'webp', $value);
                $image[] = $image_name;
            }
        }
        DB::table('support_ticket_convs')->insert([
            'customer_message' => $request->comment,
            'attachment' =>json_encode($image),
            'support_ticket_id' => $id,
            'position' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Toastr::success(translate('message_send_successfully').'!');
        return back();
    }

    public function support_ticket_close($id)
    {
        DB::table('support_tickets')->where(['id' => $id])->update([
            'status' => 'close',
            'updated_at' => now(),
        ]);
        Toastr::success(translate('ticket_closed').'!');
        return redirect('/account-tickets');
    }


    public function support_ticket_delete(Request $request)
    {

        if (auth('customer')->check()) {
            $support = SupportTicket::find($request->id);

            if ($support->attachment && count(json_decode($support->attachment)) > 0) {
                foreach (json_decode($support->attachment, true) as $image) {
                    ImageManager::delete('/support-ticket/' . $image);
                }
            }

            foreach ($support->conversations as $conversation)
            {
                if ($conversation->attachment && count(json_decode($conversation->attachment)) > 0) {
                    foreach (json_decode($conversation->attachment, true) as $image) {
                        ImageManager::delete('/support-ticket/' . $image);
                    }
                }
            }
            $support->conversations()->delete();

            $support->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }

    }

    public function track_order()
    {
        return view(VIEW_FILE_NAMES['tracking-page']);
    }
    public function track_order_wise_result(Request $request)
    {
        if (auth('customer')->check()) {
            $orderDetails = Order::with('orderDetails')->where('id', $request['order_id'])->whereHas('details', function ($query) {
                $query->where('customer_id', (auth('customer')->id()));
            })->first();

            if(!$orderDetails) {
                Toastr::warning(translate('invalid_order'));
                return redirect()->route('account-oder');
            }
            return view(VIEW_FILE_NAMES['track_order_wise_result'], compact('orderDetails'));
        }
        return back();
    }

    public function track_order_result(Request $request)
    {

        $user = auth('customer')->user();
        $user_phone = $request->phone_number ?? '';

        if (!isset($user)) {
            $user_id = User::where('phone', $request->phone_number)->first();
            $order = Order::where('id', $request['order_id'])->first();

            if($order && $order->is_guest){
                $orderDetails = Order::with('shippingAddress')->where('id', $request['order_id'])
                    ->first();

                $orderDetails = ($orderDetails && $orderDetails->shippingAddress && $orderDetails->shippingAddress->phone == $request->phone_number) ? $orderDetails : null;

                if(!$orderDetails){
                    $orderDetails = Order::where('id', $request['order_id'])
                        ->whereHas('billingAddress', function ($query) use ($request) {
                            $query->where('phone', $request->phone_number);
                        })->first();
                }
            }elseif($user_id){
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('details', function ($query) use ($user_id) {
                    $query->where('customer_id', $user_id->id);
                })->first();
            }else{
                Toastr::error(translate('invalid_Phone_Number'));
                return redirect()->back()->withInput();
            }

        } else {
            $order = Order::where('id', $request['order_id'])->first();
            if($order && $order->is_guest){
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('shippingAddress', function ($query) use ($request) {
                    $query->where('phone', $request->phone_number);
                })->first();

            }elseif ($user->phone == $request->phone_number) {
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('details', function ($query) {
                    $query->where('customer_id', auth('customer')->id());
                })->first();
            }

            if ($request->from_order_details == 1) {
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('details', function ($query) {
                    $query->where('customer_id', auth('customer')->id());
                })->first();
            }

        }

        $order_verification_status = Helpers::get_business_settings('order_verification');

        if (isset($orderDetails)) {
            return view(VIEW_FILE_NAMES['track_order'], compact('orderDetails','user_phone', 'order_verification_status'));
        }

        Toastr::error(translate('invalid_Order_Id_or_phone_Number'));
        return redirect()->back()->withInput();
    }

    public function track_last_order()
    {
        $orderDetails = OrderManager::track_order(Order::where('customer_id', auth('customer')->id())->latest()->first()->id);

        if ($orderDetails != null) {
            return view('web-views.order.tracking', compact('orderDetails'));
        } else {
            return redirect()->route('track-order.index')->with('Error', translate('invalid_Order_Id_or_phone_Number'));
        }

    }

    public function order_cancel($id)
    {
        $order = Order::where(['id' => $id])->first();
        if ($order['payment_method'] == 'cash_on_delivery' && $order['order_status'] == 'pending') {
            OrderManager::stock_update_on_order_status_change($order, 'canceled');
            Order::where(['id' => $id])->update([
                'order_status' => 'canceled'
            ]);
            Toastr::success(translate('successfully_canceled'));
        }elseif ($order['payment_method'] == 'offline_payment') {
            Toastr::error(translate('The_order_status_cannot_be_updated_as_it_is_an_offline_payment'));
        }else{
            Toastr::error(translate('status_not_changable_now'));
        }
        return back();
    }

    public function refund_request(Request $request, $id)
    {
        $order_details = OrderDetail::find($id);
        $user = auth('customer')->user();

        $wallet_status = Helpers::get_business_settings('wallet_status');
        $loyalty_point_status = Helpers::get_business_settings('loyalty_point_status');
        if ($loyalty_point_status == 1) {
            $loyalty_point = CustomerManager::count_loyalty_point_for_amount($id);

            if ($user->loyalty_point < $loyalty_point) {
                Toastr::warning(translate('you_have_not_sufficient_loyalty_point_to_refund_this_order').'!!');
                return back();
            }
        }

        return view('web-views.users-profile.refund-request', compact('order_details'));
    }

    public function store_refund(Request $request)
    {
        $request->validate([
            'order_details_id' => 'required',
            'amount' => 'required',
            'refund_reason' => 'required'

        ]);
        $order_details = OrderDetail::find($request->order_details_id);
        $user = auth('customer')->user();


        $loyalty_point_status = Helpers::get_business_settings('loyalty_point_status');
        if ($loyalty_point_status == 1) {
            $loyalty_point = CustomerManager::count_loyalty_point_for_amount($request->order_details_id);

            if ($user->loyalty_point < $loyalty_point) {
                Toastr::warning(translate('you_have_not_sufficient_loyalty_point_to_refund_this_order').'!!');
                return back();
            }
        }
        $refund_request = new RefundRequest;
        $refund_request->order_details_id = $request->order_details_id;
        $refund_request->customer_id = auth('customer')->id();
        $refund_request->status = 'pending';
        $refund_request->amount = $request->amount;
        $refund_request->product_id = $order_details->product_id;
        $refund_request->order_id = $order_details->order_id;
        $refund_request->refund_reason = $request->refund_reason;

        if ($request->file('images')) {
            $product_images = [];
            foreach ($request->file('images') as $img) {
                $product_images[] = ImageManager::upload('refund/', 'webp', $img);
            }
            $refund_request->images = json_encode($product_images);
        }
        $refund_request->save();

        $order_details->refund_request = 1;
        $order_details->save();

        $order = Order::find($order_details->order_id);
        OrderStatusEvent::dispatch('confirmed', 'customer', $order);

        Toastr::success(translate('refund_requested_successful!!'));
        return redirect()->route('account-order-details', ['id' => $order_details->order_id]);
    }

    public function generate_invoice($id)
    {
        $order = Order::with('seller')->with('shipping')->where('id', $id)->first();
        $data["email"] = $order->customer["email"];
        $data["order"] = $order;

        $mpdf_view = \View::make(VIEW_FILE_NAMES['order_invoice'], compact('order'));
        Helpers::gen_mpdf($mpdf_view, 'order_invoice_', $order->id);
    }

    public function refund_details($id)
    {
        $order_details = OrderDetail::find($id);
        $refund = RefundRequest::with(['product','order'])->where('customer_id', auth('customer')->id())
            ->where('order_details_id', $order_details->id)->first();
        $product = $this->product->find($order_details->product_id);
        $order = $this->order->find($order_details->order_id);

        if($product) {
            return view(VIEW_FILE_NAMES['refund_details'], compact('order_details', 'refund', 'product', 'order'));
        }

        Toastr::error(translate('product_not_found'));
        return redirect()->back();
    }

    public function submit_review(Request $request, $id)
    {
        $order_details = OrderDetail::where(['id' => $id])->whereHas('order', function ($q) {
            $q->where(['customer_id' => auth('customer')->id(), 'payment_status' => 'paid']);
        })->first();

        if (!$order_details) {
            Toastr::error(translate('invalid_order!'));
            return redirect('/');
        }

        return view('web-views.users-profile.submit-review', compact('order_details'));

    }

    public function refer_earn(Request $request)
    {
        $ref_earning_status = Helpers::get_business_settings('ref_earning_status') ?? 0;
        if(!$ref_earning_status){
            Toastr::error(translate('you_have_no_permission'));
            return redirect('/');
        }
        $customer_detail = User::where('id', auth('customer')->id())->first();

        return view(VIEW_FILE_NAMES['refer_earn'], compact('customer_detail'));
    }

    public function user_coupons(Request $request)
    {
        $seller_ids = Seller::approved()->pluck('id')->toArray();
        $seller_ids = array_merge($seller_ids, [NULL, '0']);

        $coupons = Coupon::with('seller')
                    ->where(['status' => 1])
                    ->whereIn('customer_id',[auth('customer')->id(), '0'])
                    ->whereIn('customer_id',[auth('customer')->id(), '0'])
                    ->whereDate('start_date', '<=', date('Y-m-d'))
                    ->whereDate('expire_date', '>=', date('Y-m-d'))
                    ->paginate(8);

        return view(VIEW_FILE_NAMES['user_coupons'], compact('coupons'));
    }

    public function get_child(Request $request)
    {
        return response()->json([
            'child_modal' => view(VIEW_FILE_NAMES['get_child_modal'])->render(),
        ]);
    }

    public function switchChild($id){

        $theme_name = theme_root_path();
        $child = FamilyRelation::where('id', $id)->first();
        $dob = new DateTime($child->dob);
        $currentDate = new DateTime();
        $diff = $currentDate->diff($dob);
        $formattedAge = '';

        if ($diff->y > 0) {
            // Convert years to months and add to months
            $totalMonths = $diff->y * 12 + $diff->m;
            $formattedAge = $totalMonths;
        } elseif ($diff->m > 0) {
            $formattedAge = $diff->m;
        } elseif($diff->m < 0){
            $formattedAge = $totalMonths;
        }
        else {
            $formattedAge = 0;
        }

        $gender[1] = $child->gender;
        $age[1] = $formattedAge;

        session(['switch_user' => $child]);

        // Accessing the stored value
        $switchedUser = session('switch_user');

        
        // dd($theme_name);
        return match ($theme_name) {
            'theme_fashion' => self::theme_fashion($gender, $age),
        };
        
    }

    public function theme_fashion($gender , $age): View
    {
        
        
        $theme_name = theme_root_path();
        $currentDate = date('Y-m-d H:i:s');


        

        // start top-rated store
        $top_sellers = $this->seller->approved()->with(['shop','orders','product.reviews'])
            ->whereHas('orders',function($query){
                $query->where('seller_is','seller');
            })
            ->withCount(['orders','product' => function ($query) {
                $query->active();
            }])->orderBy('orders_count', 'DESC')->take(12)->get();

            $top_sellers?->map(function($seller){
                $seller->product?->map(function($product){
                    $product['rating'] = $product?->reviews->pluck('rating')->sum();
                    $product['rating_count'] = $product->reviews->count();
                });
                $seller['total_rating'] = $seller?->product->pluck('rating')->sum();
                $seller['rating_count'] = $seller->product->pluck('rating_count')->sum();
                $seller['average_rating'] = $seller['total_rating'] / ($seller['rating_count'] == 0 ? 1 : $seller['rating_count']);
            });

        //end products based on top seller

        /*
         * Top rated store and new seller
         */

        $seller_list = $this->seller->approved()->with(['shop','product.reviews'])
            ->withCount(['product' => function ($query) {
                 $query->active();
                }])->get();
            $seller_list?->map(function ($seller) {
                $rating = 0;
                $count = 0;
                foreach ($seller->product as $item) {
                    foreach ($item->reviews as $review) {
                        $rating += $review->rating;
                        $count++;
                    }
                }
                $avg_rating = $rating / ($count == 0 ? 1 : $count);
                $rating_count = $count;
                $seller['average_rating'] = $avg_rating;
                $seller['rating_count'] = $rating_count;
                
                $product_count = $seller->product->count();
                $random_product = Arr::random($seller->product->toArray(), $product_count < 3 ? $product_count : 3);
                $seller['product'] = $random_product;
                return $seller;
            });
            $newSellers     =  $seller_list->sortByDesc('id')->take(12);
        $topRatedShops =  $seller_list->where('rating_count', '!=', 0)->sortByDesc('average_rating')->take(12);

        /*
         * End Top Rated store and new seller
         */
        
        //latest product
        $latest_products = $this->product->withSum('orderDetails', 'qty', function ($query) {
                $query->where('delivery_status', 'delivered');
            })->with(['category','reviews', 'flashDealProducts.flashDeal','wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }])
            ->active()->orderBy('id', 'desc')
            ->paginate(20);
        $latest_products?->map(function ($product) use ($currentDate) {
            $flash_deal_status = 0;
            $flash_deal_end_date = 0;
            if (count($product->flashDealProducts) > 0) {
                $flash_deal = $product->flashDealProducts[0]->flashDeal;
                if ($flash_deal) {
                    $start_date = date('Y-m-d H:i:s', strtotime($flash_deal->start_date));
                    $end_date = date('Y-m-d H:i:s', strtotime($flash_deal->end_date));
                    $flash_deal_status = $flash_deal->status == 1 && (($currentDate >= $start_date) && ($currentDate <= $end_date)) ? 1 : 0;
                    $flash_deal_end_date = $flash_deal->end_date;
                }
            }
            $product['flash_deal_status'] = $flash_deal_status;
            $product['flash_deal_end_date'] = $flash_deal_end_date;
            return $product;
        });
        //end latest product

        // All product Section
        $all_products = $this->product->withSum('orderDetails', 'qty', function ($query) {
                $query->where('delivery_status', 'delivered');
            })->with(['category','reviews', 'flashDealProducts.flashDeal','wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }])
            ->active()->orderBy('order_details_sum_qty', 'DESC')
            ->paginate(20);
        $all_products?->map(function ($product) use ($currentDate) {
            $flash_deal_status = 0;
            $flash_deal_end_date = 0;
            if (count($product->flashDealProducts) > 0) {
                $flash_deal = $product->flashDealProducts[0]->flashDeal;
                if ($flash_deal) {
                    $start_date = date('Y-m-d H:i:s', strtotime($flash_deal->start_date));
                    $end_date = date('Y-m-d H:i:s', strtotime($flash_deal->end_date));
                    $flash_deal_status = $flash_deal->status == 1 && (($currentDate >= $start_date) && ($currentDate <= $end_date)) ? 1 : 0;
                    $flash_deal_end_date = $flash_deal->end_date;
                }
            }
            $product['flash_deal_status'] = $flash_deal_status;
            $product['flash_deal_end_date'] = $flash_deal_end_date;
            return $product;
        });


        /**
         *  Start Deal of the day and random product and banner
         */
        $deal_of_the_day = $this->deal_of_the_day->with(['product'=>function($query){
                                $query->active();
                            }])->where('status', 1)->first();
        $random_product =$this->product->active()->inRandomOrder()->first();
        
        $main_banner = Banner::where(['banner_type'=> 'Main Banner', 'published'=> 1, 'theme'=>$theme_name])->latest()->get();

        $promo_banner_left = Banner::where(['banner_type'=> 'Promo Banner Left', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_middle_top = Banner::where(['banner_type'=> 'Promo Banner Middle Top','published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_middle_bottom = Banner::where(['banner_type'=> 'Promo Banner Middle Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_right = Banner::where(['banner_type'=> 'Promo Banner Right', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_bottom = Banner::where(['banner_type'=> 'Promo Banner Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();
        
        $sidebar_banner = Banner::where(['banner_type'=> 'Sidebar Banner','published'=> 1, 'theme'=>$theme_name])->latest()->first();
        $top_side_banner = Banner::where(['banner_type'=> 'Top Side Banner','published'=> 1, 'theme'=>$theme_name])->orderBy('id', 'desc')->latest()->first();

        /**
         * end
         */
        $decimal_point_settings = !empty(\App\Utils\Helpers::get_business_settings('decimal_point_settings')) ? \App\Utils\Helpers::get_business_settings('decimal_point_settings') : 0;
        $user = Helpers::get_customer();
        
        // theme fashion -- Shop Again From Your Recent Store
        $recent_order_shops = $user != 'offline' ?
        $this->product->with('seller.shop')
                    ->whereHas('seller.orders', function ($query) {
                        $query->where(['customer_id' => auth('customer')->id(), 'seller_is' => 'seller']);
                    })->active()
                    ->inRandomOrder()->take(12)->get()
                : [];
                //end theme fashion -- Shop Again From Your Recent Store

        $most_searching_product = Product::active()->with(['category', 'wishList'=>function($query){
            return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
        }])->withSum('tags', 'visit_count')->orderBy('tags_sum_visit_count', 'desc')->get();
        
        $all_categories = Category::withCount(['product'=>function($query){
                                $query->active();
                            }])->with(['childes' => function ($sub_query) {
                                $sub_query->with(['childes' => function ($sub_sub_query) {
                                    $sub_sub_query->withCount(['subSubCategoryProduct'])->where('position', 2);
                                }])->withCount(['subCategoryProduct'])->where('position', 1);
                            }, 'childes.childes'])
                            ->where('position', 0);

        $categories = $all_categories->get();
        $most_visited_categories = $all_categories->inRandomOrder()->get();


        $colors_in_shop = ProductManager::get_colors_form_products();

        $most_searching_product = $most_searching_product->take(10);

        $all_product_section_orders = $this->order->where(['order_type'=>'default_type']);
        $all_products_info = [
            'total_products' => $this->product->active()->count(),
            'total_orders' => $all_product_section_orders->count(),
            'total_delivary' => $all_product_section_orders->where(['payment_status'=>'paid', 'order_status'=>'delivered'])->count(),
            'total_reviews' => $this->review->where('product_id', '!=', 0)->whereNull('delivery_man_id')->count(),
        ];

        
        // start most demanded product
        $most_demanded_product = $this->most_demanded->where('status',1)->with(['product'=>function($query){
            $query->withCount('wishList','orderDetails','orderDelivered','reviews');
        }])->whereHas('product', function ($query){
            return $query->active();
        })->first();
        // end most demanded product

        // Feature products
        $featured_products = $this->product->active()->where('featured', 1)
        ->with(['wishList'=>function($query){
                                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
                            }])->latest()->take(20)->get();

                            /**
         * signature product  as featured deal
         */
        $featured_deals = $this->product->active()->with([
            'flashDealProducts.flashDeal' => function($query){
                return $query->whereDate('start_date', '<=', date('Y-m-d'))
                ->whereDate('end_date', '>=', date('Y-m-d'));
            }, 'wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }, 'compareList'=>function($query){
                return $query->where('user_id', Auth::guard('customer')->user()->id ?? 0);
            }
            ])->whereHas('flashDealProducts.featureDeal', function($query){
                $query->whereDate('start_date', '<=', date('Y-m-d'))
                ->whereDate('end_date', '>=', date('Y-m-d'));
            })->latest()->take(4)->get();
            
            $sizes = [];
            foreach ($all_products as $product) {
                $choice_options = json_decode($product->choice_options, true);
                if (is_array($choice_options) && !empty($choice_options)) {
                    $title = $choice_options[0]['title'];
                    if ($title == 'Size') {
                        $options = $choice_options[0]['options'];
                        foreach ($options as $option) {
                            $sizes[] = $option;
                        }
                    }
                }
            }
            
            $custom_sort = function ($a, $b) {
                $order = [
                    "New Born" => -1,
                    "Preemie" => 0,
                    "M" => 1,
                    "Y" => 2,
                ];
                $pattern = '/(\d+)\s?[-to]+\s?(\d+)?\s?([MY])?/i';
                preg_match($pattern, $a, $matches_a);
                preg_match($pattern, $b, $matches_b);
                $a_unit = isset($matches_a[3]) ? strtoupper($matches_a[3]) : '';
                $b_unit = isset($matches_b[3]) ? strtoupper($matches_b[3]) : '';
                $a_order = isset($order[$a_unit]) ? $order[$a_unit] : PHP_INT_MAX;
                $b_order = isset($order[$b_unit]) ? $order[$b_unit] : PHP_INT_MAX;
                if ($a_unit === "New Born" && $b_unit === "Preemie") {
                    return -1;
                } elseif ($a_unit === "Preemie" && $b_unit === "New Born") {
                    return 1;
                }
                if ($a_unit === $b_unit) {
                    $a_value = isset($matches_a[1]) ? (int)$matches_a[1] : null;
                    $b_value = isset($matches_b[1]) ? (int)$matches_b[1] : null;
            
                    if ($a_value !== null && $b_value !== null) {
                        return $a_value - $b_value;
                    }
                }
                return $a_order <=> $b_order;
            };
            usort($sizes, $custom_sort);
            $sizes = array_unique($sizes);
            $new_born_key = array_search("New Born", $sizes);
            $preemie_key = array_search("Preemie", $sizes);
            unset($sizes[$new_born_key]);
            unset($sizes[$preemie_key]);
            array_unshift($sizes, "Preemie", "New Born");

            // dd($gender, $age, $sizes);

            
            // $allProducts = [];
            // if ($age) {
            //     $products = Product::get();
            //     foreach ($products as $product) {
            //         $matchedOptions = json_decode($product->choice_options, true);
            //         if (!empty($matchedOptions)) {
            //             $title = $matchedOptions[0]['title'];
            //             $options = $matchedOptions[0]['options'];
            //             if($title == 'Size'){
            //                 if(!empty(array_intersect($age, $options))){
            //                     $allProducts[] = $product;
            //                 }
            //             }
            //         }   
            //         }
            //     $products = $allProducts;
            // }      

            $all_products = [];
            if($gender){
                $all_products = Product::whereIn('gender', $gender)
                ->paginate(20);
            }
            $genders = $gender[1];
            $custom_pages = CustomPage::get();

            return view(VIEW_FILE_NAMES['home'],
        compact(
                'custom_pages','genders','sizes','latest_products', 'deal_of_the_day', 'top_sellers','topRatedShops', 'main_banner','most_visited_categories',
                'random_product', 'decimal_point_settings', 'newSellers', 'sidebar_banner', 'top_side_banner', 'recent_order_shops',
                'categories', 'colors_in_shop', 'all_products_info', 'most_searching_product', 'most_demanded_product', 'featured_products','promo_banner_left',
                'promo_banner_middle_top','promo_banner_middle_bottom','promo_banner_right', 'promo_banner_bottom', 'currentDate', 'all_products',
                'featured_deals'
            )
        );
    }


    public function SwitchMale(){
        
        session()->forget('switch_user');
        session()->forget('switch_female');
        $theme_name = theme_root_path();
        $currentDate = date('Y-m-d H:i:s');

        $child = [
            "user_id"=> 18,
            "name"=> "Boy",
            "gender"=> "male",
            "profile_picture"=> "boy.jpg"
        ];

        session()->put('switch_male', $child);

        // Accessing the stored value
        $switchedUser = session('switch_male');
        

        // start top-rated store
        $top_sellers = $this->seller->approved()->with(['shop','orders','product.reviews'])
            ->whereHas('orders',function($query){
                $query->where('seller_is','seller');
            })
            ->withCount(['orders','product' => function ($query) {
                $query->active();
            }])->orderBy('orders_count', 'DESC')->take(12)->get();

            $top_sellers?->map(function($seller){
                $seller->product?->map(function($product){
                    $product['rating'] = $product?->reviews->pluck('rating')->sum();
                    $product['rating_count'] = $product->reviews->count();
                });
                $seller['total_rating'] = $seller?->product->pluck('rating')->sum();
                $seller['rating_count'] = $seller->product->pluck('rating_count')->sum();
                $seller['average_rating'] = $seller['total_rating'] / ($seller['rating_count'] == 0 ? 1 : $seller['rating_count']);
            });

        //end products based on top seller

        /*
         * Top rated store and new seller
         */

        $seller_list = $this->seller->approved()->with(['shop','product.reviews'])
            ->withCount(['product' => function ($query) {
                 $query->active();
                }])->get();
            $seller_list?->map(function ($seller) {
                $rating = 0;
                $count = 0;
                foreach ($seller->product as $item) {
                    foreach ($item->reviews as $review) {
                        $rating += $review->rating;
                        $count++;
                    }
                }
                $avg_rating = $rating / ($count == 0 ? 1 : $count);
                $rating_count = $count;
                $seller['average_rating'] = $avg_rating;
                $seller['rating_count'] = $rating_count;
                
                $product_count = $seller->product->count();
                $random_product = Arr::random($seller->product->toArray(), $product_count < 3 ? $product_count : 3);
                $seller['product'] = $random_product;
                return $seller;
            });
            $newSellers     =  $seller_list->sortByDesc('id')->take(12);
        $topRatedShops =  $seller_list->where('rating_count', '!=', 0)->sortByDesc('average_rating')->take(12);

        /*
         * End Top Rated store and new seller
         */
        
        //latest product
        $latest_products = $this->product->withSum('orderDetails', 'qty', function ($query) {
                $query->where('delivery_status', 'delivered');
            })->with(['category','reviews', 'flashDealProducts.flashDeal','wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }])
            ->active()->orderBy('id', 'desc')
            ->paginate(20);
        $latest_products?->map(function ($product) use ($currentDate) {
            $flash_deal_status = 0;
            $flash_deal_end_date = 0;
            if (count($product->flashDealProducts) > 0) {
                $flash_deal = $product->flashDealProducts[0]->flashDeal;
                if ($flash_deal) {
                    $start_date = date('Y-m-d H:i:s', strtotime($flash_deal->start_date));
                    $end_date = date('Y-m-d H:i:s', strtotime($flash_deal->end_date));
                    $flash_deal_status = $flash_deal->status == 1 && (($currentDate >= $start_date) && ($currentDate <= $end_date)) ? 1 : 0;
                    $flash_deal_end_date = $flash_deal->end_date;
                }
            }
            $product['flash_deal_status'] = $flash_deal_status;
            $product['flash_deal_end_date'] = $flash_deal_end_date;
            return $product;
        });
        //end latest product

        // All product Section
        $all_products = $this->product->withSum('orderDetails', 'qty', function ($query) {
                $query->where('delivery_status', 'delivered');
            })->with(['category','reviews', 'flashDealProducts.flashDeal','wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }])
            ->active()->orderBy('order_details_sum_qty', 'DESC')
            ->paginate(20);
        $all_products?->map(function ($product) use ($currentDate) {
            $flash_deal_status = 0;
            $flash_deal_end_date = 0;
            if (count($product->flashDealProducts) > 0) {
                $flash_deal = $product->flashDealProducts[0]->flashDeal;
                if ($flash_deal) {
                    $start_date = date('Y-m-d H:i:s', strtotime($flash_deal->start_date));
                    $end_date = date('Y-m-d H:i:s', strtotime($flash_deal->end_date));
                    $flash_deal_status = $flash_deal->status == 1 && (($currentDate >= $start_date) && ($currentDate <= $end_date)) ? 1 : 0;
                    $flash_deal_end_date = $flash_deal->end_date;
                }
            }
            $product['flash_deal_status'] = $flash_deal_status;
            $product['flash_deal_end_date'] = $flash_deal_end_date;
            return $product;
        });


        /**
         *  Start Deal of the day and random product and banner
         */
        $deal_of_the_day = $this->deal_of_the_day->with(['product'=>function($query){
                                $query->active();
                            }])->where('status', 1)->first();
        $random_product =$this->product->active()->inRandomOrder()->first();
        
        $main_banner = Banner::where(['banner_type'=> 'Main Banner', 'published'=> 1, 'theme'=>$theme_name])->latest()->get();

        $promo_banner_left = Banner::where(['banner_type'=> 'Promo Banner Left', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_middle_top = Banner::where(['banner_type'=> 'Promo Banner Middle Top','published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_middle_bottom = Banner::where(['banner_type'=> 'Promo Banner Middle Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_right = Banner::where(['banner_type'=> 'Promo Banner Right', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_bottom = Banner::where(['banner_type'=> 'Promo Banner Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();
        
        $sidebar_banner = Banner::where(['banner_type'=> 'Sidebar Banner','published'=> 1, 'theme'=>$theme_name])->latest()->first();
        $top_side_banner = Banner::where(['banner_type'=> 'Top Side Banner','published'=> 1, 'theme'=>$theme_name])->orderBy('id', 'desc')->latest()->first();

        /**
         * end
         */
        $decimal_point_settings = !empty(\App\Utils\Helpers::get_business_settings('decimal_point_settings')) ? \App\Utils\Helpers::get_business_settings('decimal_point_settings') : 0;
        $user = Helpers::get_customer();
        
        // theme fashion -- Shop Again From Your Recent Store
        $recent_order_shops = $user != 'offline' ?
        $this->product->with('seller.shop')
                    ->whereHas('seller.orders', function ($query) {
                        $query->where(['customer_id' => auth('customer')->id(), 'seller_is' => 'seller']);
                    })->active()
                    ->inRandomOrder()->take(12)->get()
                : [];
                //end theme fashion -- Shop Again From Your Recent Store

        $most_searching_product = Product::active()->with(['category', 'wishList'=>function($query){
            return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
        }])->withSum('tags', 'visit_count')->orderBy('tags_sum_visit_count', 'desc')->get();
        
        $all_categories = Category::withCount(['product'=>function($query){
                                $query->active();
                            }])->with(['childes' => function ($sub_query) {
                                $sub_query->with(['childes' => function ($sub_sub_query) {
                                    $sub_sub_query->withCount(['subSubCategoryProduct'])->where('position', 2);
                                }])->withCount(['subCategoryProduct'])->where('position', 1);
                            }, 'childes.childes'])
                            ->where('position', 0);

        $categories = $all_categories->get();
        $most_visited_categories = $all_categories->inRandomOrder()->get();


        $colors_in_shop = ProductManager::get_colors_form_products();

        $most_searching_product = $most_searching_product->take(10);

        $all_product_section_orders = $this->order->where(['order_type'=>'default_type']);
        $all_products_info = [
            'total_products' => $this->product->active()->count(),
            'total_orders' => $all_product_section_orders->count(),
            'total_delivary' => $all_product_section_orders->where(['payment_status'=>'paid', 'order_status'=>'delivered'])->count(),
            'total_reviews' => $this->review->where('product_id', '!=', 0)->whereNull('delivery_man_id')->count(),
        ];

        
        // start most demanded product
        $most_demanded_product = $this->most_demanded->where('status',1)->with(['product'=>function($query){
            $query->withCount('wishList','orderDetails','orderDelivered','reviews');
        }])->whereHas('product', function ($query){
            return $query->active();
        })->first();
        // end most demanded product

        // Feature products
        $featured_products = $this->product->active()->where('featured', 1)
        ->with(['wishList'=>function($query){
                                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
                            }])->latest()->take(20)->get();

                            /**
         * signature product  as featured deal
         */
        $featured_deals = $this->product->active()->with([
            'flashDealProducts.flashDeal' => function($query){
                return $query->whereDate('start_date', '<=', date('Y-m-d'))
                ->whereDate('end_date', '>=', date('Y-m-d'));
            }, 'wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }, 'compareList'=>function($query){
                return $query->where('user_id', Auth::guard('customer')->user()->id ?? 0);
            }
            ])->whereHas('flashDealProducts.featureDeal', function($query){
                $query->whereDate('start_date', '<=', date('Y-m-d'))
                ->whereDate('end_date', '>=', date('Y-m-d'));
            })->latest()->take(4)->get();
            
            $sizes = [];
            foreach ($all_products as $product) {
                $choice_options = json_decode($product->choice_options, true);
                if (is_array($choice_options) && !empty($choice_options)) {
                    $title = $choice_options[0]['title'];
                    if ($title == 'Size') {
                        $options = $choice_options[0]['options'];
                        foreach ($options as $option) {
                            $sizes[] = $option;
                        }
                    }
                }
            }
            
            $custom_sort = function ($a, $b) {
                $order = [
                    "New Born" => -1,
                    "Preemie" => 0,
                    "M" => 1,
                    "Y" => 2,
                ];
                $pattern = '/(\d+)\s?[-to]+\s?(\d+)?\s?([MY])?/i';
                preg_match($pattern, $a, $matches_a);
                preg_match($pattern, $b, $matches_b);
                $a_unit = isset($matches_a[3]) ? strtoupper($matches_a[3]) : '';
                $b_unit = isset($matches_b[3]) ? strtoupper($matches_b[3]) : '';
                $a_order = isset($order[$a_unit]) ? $order[$a_unit] : PHP_INT_MAX;
                $b_order = isset($order[$b_unit]) ? $order[$b_unit] : PHP_INT_MAX;
                if ($a_unit === "New Born" && $b_unit === "Preemie") {
                    return -1;
                } elseif ($a_unit === "Preemie" && $b_unit === "New Born") {
                    return 1;
                }
                if ($a_unit === $b_unit) {
                    $a_value = isset($matches_a[1]) ? (int)$matches_a[1] : null;
                    $b_value = isset($matches_b[1]) ? (int)$matches_b[1] : null;
            
                    if ($a_value !== null && $b_value !== null) {
                        return $a_value - $b_value;
                    }
                }
                return $a_order <=> $b_order;
            };
            usort($sizes, $custom_sort);
            $sizes = array_unique($sizes);
            $new_born_key = array_search("New Born", $sizes);
            $preemie_key = array_search("Preemie", $sizes);
            unset($sizes[$new_born_key]);
            unset($sizes[$preemie_key]);
            array_unshift($sizes, "Preemie", "New Born");

            $all_products = [];
                $all_products = Product::where('gender', 'male')
                ->paginate(20);
            
            $genders = 'male';
            $custom_pages = CustomPage::get();

            return view(VIEW_FILE_NAMES['home'],
        compact(
                'custom_pages','genders','sizes','latest_products', 'deal_of_the_day', 'top_sellers','topRatedShops', 'main_banner','most_visited_categories',
                'random_product', 'decimal_point_settings', 'newSellers', 'sidebar_banner', 'top_side_banner', 'recent_order_shops',
                'categories', 'colors_in_shop', 'all_products_info', 'most_searching_product', 'most_demanded_product', 'featured_products','promo_banner_left',
                'promo_banner_middle_top','promo_banner_middle_bottom','promo_banner_right', 'promo_banner_bottom', 'currentDate', 'all_products',
                'featured_deals'
            )
        );
    }

    public function SwitchFemale(){
        
        session()->forget('switch_user');
        session()->forget('switch_male');
        $theme_name = theme_root_path();
        $currentDate = date('Y-m-d H:i:s');

        $child = [
            "name" => "Girl",
            "gender" => "female",
            "profile_picture" => "girl.jpg"
        ];

        session()->put('switch_female', $child);

        // Accessing the stored value
        $switchedUser = session('switch_female');
        

        // start top-rated store
        $top_sellers = $this->seller->approved()->with(['shop','orders','product.reviews'])
            ->whereHas('orders',function($query){
                $query->where('seller_is','seller');
            })
            ->withCount(['orders','product' => function ($query) {
                $query->active();
            }])->orderBy('orders_count', 'DESC')->take(12)->get();

            $top_sellers?->map(function($seller){
                $seller->product?->map(function($product){
                    $product['rating'] = $product?->reviews->pluck('rating')->sum();
                    $product['rating_count'] = $product->reviews->count();
                });
                $seller['total_rating'] = $seller?->product->pluck('rating')->sum();
                $seller['rating_count'] = $seller->product->pluck('rating_count')->sum();
                $seller['average_rating'] = $seller['total_rating'] / ($seller['rating_count'] == 0 ? 1 : $seller['rating_count']);
            });

        //end products based on top seller

        /*
         * Top rated store and new seller
         */

        $seller_list = $this->seller->approved()->with(['shop','product.reviews'])
            ->withCount(['product' => function ($query) {
                 $query->active();
                }])->get();
            $seller_list?->map(function ($seller) {
                $rating = 0;
                $count = 0;
                foreach ($seller->product as $item) {
                    foreach ($item->reviews as $review) {
                        $rating += $review->rating;
                        $count++;
                    }
                }
                $avg_rating = $rating / ($count == 0 ? 1 : $count);
                $rating_count = $count;
                $seller['average_rating'] = $avg_rating;
                $seller['rating_count'] = $rating_count;
                
                $product_count = $seller->product->count();
                $random_product = Arr::random($seller->product->toArray(), $product_count < 3 ? $product_count : 3);
                $seller['product'] = $random_product;
                return $seller;
            });
            $newSellers     =  $seller_list->sortByDesc('id')->take(12);
        $topRatedShops =  $seller_list->where('rating_count', '!=', 0)->sortByDesc('average_rating')->take(12);

        /*
         * End Top Rated store and new seller
         */
        
        //latest product
        $latest_products = $this->product->withSum('orderDetails', 'qty', function ($query) {
                $query->where('delivery_status', 'delivered');
            })->with(['category','reviews', 'flashDealProducts.flashDeal','wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }])
            ->active()->orderBy('id', 'desc')
            ->paginate(20);
        $latest_products?->map(function ($product) use ($currentDate) {
            $flash_deal_status = 0;
            $flash_deal_end_date = 0;
            if (count($product->flashDealProducts) > 0) {
                $flash_deal = $product->flashDealProducts[0]->flashDeal;
                if ($flash_deal) {
                    $start_date = date('Y-m-d H:i:s', strtotime($flash_deal->start_date));
                    $end_date = date('Y-m-d H:i:s', strtotime($flash_deal->end_date));
                    $flash_deal_status = $flash_deal->status == 1 && (($currentDate >= $start_date) && ($currentDate <= $end_date)) ? 1 : 0;
                    $flash_deal_end_date = $flash_deal->end_date;
                }
            }
            $product['flash_deal_status'] = $flash_deal_status;
            $product['flash_deal_end_date'] = $flash_deal_end_date;
            return $product;
        });
        //end latest product

        // All product Section
        $all_products = $this->product->withSum('orderDetails', 'qty', function ($query) {
                $query->where('delivery_status', 'delivered');
            })->with(['category','reviews', 'flashDealProducts.flashDeal','wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }])
            ->active()->orderBy('order_details_sum_qty', 'DESC')
            ->paginate(20);
        $all_products?->map(function ($product) use ($currentDate) {
            $flash_deal_status = 0;
            $flash_deal_end_date = 0;
            if (count($product->flashDealProducts) > 0) {
                $flash_deal = $product->flashDealProducts[0]->flashDeal;
                if ($flash_deal) {
                    $start_date = date('Y-m-d H:i:s', strtotime($flash_deal->start_date));
                    $end_date = date('Y-m-d H:i:s', strtotime($flash_deal->end_date));
                    $flash_deal_status = $flash_deal->status == 1 && (($currentDate >= $start_date) && ($currentDate <= $end_date)) ? 1 : 0;
                    $flash_deal_end_date = $flash_deal->end_date;
                }
            }
            $product['flash_deal_status'] = $flash_deal_status;
            $product['flash_deal_end_date'] = $flash_deal_end_date;
            return $product;
        });


        /**
         *  Start Deal of the day and random product and banner
         */
        $deal_of_the_day = $this->deal_of_the_day->with(['product'=>function($query){
                                $query->active();
                            }])->where('status', 1)->first();
        $random_product =$this->product->active()->inRandomOrder()->first();
        
        $main_banner = Banner::where(['banner_type'=> 'Main Banner', 'published'=> 1, 'theme'=>$theme_name])->latest()->get();

        $promo_banner_left = Banner::where(['banner_type'=> 'Promo Banner Left', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_middle_top = Banner::where(['banner_type'=> 'Promo Banner Middle Top','published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_middle_bottom = Banner::where(['banner_type'=> 'Promo Banner Middle Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_right = Banner::where(['banner_type'=> 'Promo Banner Right', 'published'=> 1, 'theme'=>$theme_name])->first();
        $promo_banner_bottom = Banner::where(['banner_type'=> 'Promo Banner Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();
        
        $sidebar_banner = Banner::where(['banner_type'=> 'Sidebar Banner','published'=> 1, 'theme'=>$theme_name])->latest()->first();
        $top_side_banner = Banner::where(['banner_type'=> 'Top Side Banner','published'=> 1, 'theme'=>$theme_name])->orderBy('id', 'desc')->latest()->first();

        /**
         * end
         */
        $decimal_point_settings = !empty(\App\Utils\Helpers::get_business_settings('decimal_point_settings')) ? \App\Utils\Helpers::get_business_settings('decimal_point_settings') : 0;
        $user = Helpers::get_customer();
        
        // theme fashion -- Shop Again From Your Recent Store
        $recent_order_shops = $user != 'offline' ?
        $this->product->with('seller.shop')
                    ->whereHas('seller.orders', function ($query) {
                        $query->where(['customer_id' => auth('customer')->id(), 'seller_is' => 'seller']);
                    })->active()
                    ->inRandomOrder()->take(12)->get()
                : [];
                //end theme fashion -- Shop Again From Your Recent Store

        $most_searching_product = Product::active()->with(['category', 'wishList'=>function($query){
            return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
        }])->withSum('tags', 'visit_count')->orderBy('tags_sum_visit_count', 'desc')->get();
        
        $all_categories = Category::withCount(['product'=>function($query){
                                $query->active();
                            }])->with(['childes' => function ($sub_query) {
                                $sub_query->with(['childes' => function ($sub_sub_query) {
                                    $sub_sub_query->withCount(['subSubCategoryProduct'])->where('position', 2);
                                }])->withCount(['subCategoryProduct'])->where('position', 1);
                            }, 'childes.childes'])
                            ->where('position', 0);

        $categories = $all_categories->get();
        $most_visited_categories = $all_categories->inRandomOrder()->get();


        $colors_in_shop = ProductManager::get_colors_form_products();

        $most_searching_product = $most_searching_product->take(10);

        $all_product_section_orders = $this->order->where(['order_type'=>'default_type']);
        $all_products_info = [
            'total_products' => $this->product->active()->count(),
            'total_orders' => $all_product_section_orders->count(),
            'total_delivary' => $all_product_section_orders->where(['payment_status'=>'paid', 'order_status'=>'delivered'])->count(),
            'total_reviews' => $this->review->where('product_id', '!=', 0)->whereNull('delivery_man_id')->count(),
        ];

        
        // start most demanded product
        $most_demanded_product = $this->most_demanded->where('status',1)->with(['product'=>function($query){
            $query->withCount('wishList','orderDetails','orderDelivered','reviews');
        }])->whereHas('product', function ($query){
            return $query->active();
        })->first();
        // end most demanded product

        // Feature products
        $featured_products = $this->product->active()->where('featured', 1)
        ->with(['wishList'=>function($query){
                                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
                            }])->latest()->take(20)->get();

                            /**
         * signature product  as featured deal
         */
        $featured_deals = $this->product->active()->with([
            'flashDealProducts.flashDeal' => function($query){
                return $query->whereDate('start_date', '<=', date('Y-m-d'))
                ->whereDate('end_date', '>=', date('Y-m-d'));
            }, 'wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }, 'compareList'=>function($query){
                return $query->where('user_id', Auth::guard('customer')->user()->id ?? 0);
            }
            ])->whereHas('flashDealProducts.featureDeal', function($query){
                $query->whereDate('start_date', '<=', date('Y-m-d'))
                ->whereDate('end_date', '>=', date('Y-m-d'));
            })->latest()->take(4)->get();
            
            $sizes = [];
            foreach ($all_products as $product) {
                $choice_options = $product->choice_options;
                if (is_array($choice_options) && !empty($choice_options)) {
                    $title = $choice_options[0]['title'];
                    if ($title == 'Size') {
                        $options = $choice_options[0]['options'];
                        foreach ($options as $option) {
                            $sizes[] = $option;
                        }
                    }
                }
            }
            
            $custom_sort = function ($a, $b) {
                $order = [
                    "New Born" => -1,
                    "Preemie" => 0,
                    "M" => 1,
                    "Y" => 2,
                ];
                $pattern = '/(\d+)\s?[-to]+\s?(\d+)?\s?([MY])?/i';
                preg_match($pattern, $a, $matches_a);
                preg_match($pattern, $b, $matches_b);
                $a_unit = isset($matches_a[3]) ? strtoupper($matches_a[3]) : '';
                $b_unit = isset($matches_b[3]) ? strtoupper($matches_b[3]) : '';
                $a_order = isset($order[$a_unit]) ? $order[$a_unit] : PHP_INT_MAX;
                $b_order = isset($order[$b_unit]) ? $order[$b_unit] : PHP_INT_MAX;
                if ($a_unit === "New Born" && $b_unit === "Preemie") {
                    return -1;
                } elseif ($a_unit === "Preemie" && $b_unit === "New Born") {
                    return 1;
                }
                if ($a_unit === $b_unit) {
                    $a_value = isset($matches_a[1]) ? (int)$matches_a[1] : null;
                    $b_value = isset($matches_b[1]) ? (int)$matches_b[1] : null;
            
                    if ($a_value !== null && $b_value !== null) {
                        return $a_value - $b_value;
                    }
                }
                return $a_order <=> $b_order;
            };
            usort($sizes, $custom_sort);
            $sizes = array_unique($sizes);
            $new_born_key = array_search("New Born", $sizes);
            $preemie_key = array_search("Preemie", $sizes);
            unset($sizes[$new_born_key]);
            unset($sizes[$preemie_key]);
            array_unshift($sizes, "Preemie", "New Born");

            $all_products = [];
                $all_products = Product::where('gender', 'female')
                ->paginate(20);
            
            $genders = 'female';
            $custom_pages = CustomPage::get();

            //----------------


            $sizes = [];
            $filterOptions = [];
        foreach ($all_products as $product) {
            $temp_sizes = [];
            $choice_options = $product->choice_options;
            $filterOptions[] = $choice_options;
            if (is_array($choice_options) && !empty($choice_options)) {
                $title = $choice_options[0]['title'];
                if ($title == 'Size') {
                    $options = $choice_options[0]['options'];

                    // Initialize the sizes array if it doesn't exist
                    if (!isset($product->sizes) || !is_array($product->sizes)) {
                        $product->sizes = [];
                    }

                    foreach ($options as $option) {
                        $sizes[] = trim($option); // Collect all sizes in a separate array

                        // Directly add to the product sizes array
                        $temp_sizes[] = trim($option);
                    }
                    $product->sizes = $temp_sizes; // Reassign the array back to the product property
                }
            }
        }    


        $mergedChoices = [];

            foreach ($filterOptions as $choices) {
                foreach ($choices as $choice) {
                    if (!isset($mergedChoices[$choice['name']])) {
                        $mergedChoices[$choice['name']] = [
                            'name' => $choice['name'],
                            'title' => $choice['title'],
                            'options' => []
                        ];
                    }
                    $mergedChoices[$choice['name']]['options'] = array_unique(array_merge($mergedChoices[$choice['name']]['options'], array_map('trim', $choice['options'])));
                }
            }
    
            $allColors = [];
    
            // Loop through each product to extract colors
            foreach ($all_products as $productItem) {
                $colors = json_decode($productItem['colors'], true);
                if ($colors) {
                    $allColors = array_merge($allColors, $colors);
                }
            }
            $mergedChoices['choice_0']['title'] = "Color";
            // Remove duplicate colors
            $mergedChoices['choice_0']['options'] = array_unique($allColors);
            

            
            $custom_sort = function ($a, $b) {
                $order = [
                    "New Born" => -1,
                    "Preemie" => 0,
                    "M" => 1,
                    "Y" => 2,
                ];
                $pattern = '/(\d+)\s?[-to]+\s?(\d+)?\s?([MY])?/i';
                preg_match($pattern, $a, $matches_a);
                preg_match($pattern, $b, $matches_b);
                $a_unit = isset($matches_a[3]) ? strtoupper($matches_a[3]) : '';
                $b_unit = isset($matches_b[3]) ? strtoupper($matches_b[3]) : '';
                $a_order = isset($order[$a_unit]) ? $order[$a_unit] : PHP_INT_MAX;
                $b_order = isset($order[$b_unit]) ? $order[$b_unit] : PHP_INT_MAX;
                if ($a_unit === "New Born" && $b_unit === "Preemie") {
                    return -1;
                } elseif ($a_unit === "Preemie" && $b_unit === "New Born") {
                    return 1;
                }
                if ($a_unit === $b_unit) {
                    $a_value = isset($matches_a[1]) ? (int)$matches_a[1] : null;
                    $b_value = isset($matches_b[1]) ? (int)$matches_b[1] : null;
            
                    if ($a_value !== null && $b_value !== null) {
                        return $a_value - $b_value;
                    }
                }
                return $a_order <=> $b_order;
            };
            usort($sizes, $custom_sort);
            $sizes = array_unique($sizes);
            $new_born_key = array_search("New Born", $sizes);
            $preemie_key = array_search("Preemie", $sizes);
            unset($sizes[$new_born_key]);
            unset($sizes[$preemie_key]);
            array_unshift($sizes, "Preemie", "New Born");
            $custom_pages = CustomPage::get();


            //----------------


            return view(VIEW_FILE_NAMES['home'],
        compact(
                'custom_pages','genders','sizes','latest_products', 'deal_of_the_day', 'top_sellers','topRatedShops', 'main_banner','most_visited_categories',
                'random_product', 'decimal_point_settings', 'newSellers', 'sidebar_banner', 'top_side_banner', 'recent_order_shops',
                'categories', 'colors_in_shop', 'all_products_info', 'most_searching_product', 'most_demanded_product', 'featured_products','promo_banner_left',
                'promo_banner_middle_top','promo_banner_middle_bottom','promo_banner_right', 'promo_banner_bottom', 'currentDate', 'all_products',
                'featured_deals'
            )
        );
    }

    public function UnSwitch(){
        session()->forget('switch_user');
        session()->forget('switch_male');
        session()->forget('switch_female');
        return redirect()->route('home');
    }



    public function HomeChild(){
        if(Auth::guard('customer')->check()){
            $wishlists = $this->wishlist->whereHas('wishlistProduct', function ($q) {
                return $q;
            })->where('customer_id', auth('customer')->id())->count();
            $total_order = $this->order->where('customer_id', auth('customer')->id())->count();
            $total_loyalty_point = auth('customer')->user()->loyalty_point;
            $total_wallet_balance = auth('customer')->user()->wallet_balance;
            $addresses = ShippingAddress::where('customer_id', auth('customer')->id())->latest()->get();
            $customer_detail = User::where('id', auth('customer')->id())->first();
            $childs = FamilyRelation::where('user_id', Auth::guard('customer')->user()->id)->get();
            return view(VIEW_FILE_NAMES['child_list'], compact('childs','customer_detail', 'addresses', 'wishlists', 'total_order', 'total_loyalty_point', 'total_wallet_balance'));
            
        }else{
            Toastr::success('Please Login First');
            return redirect()->route('customer.auth.login');
        }
        
    }

    

}
