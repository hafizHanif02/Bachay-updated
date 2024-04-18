<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Growth;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Wishlist;
use App\Models\DeliveryMan;
use App\Models\OrderDetail;
use App\Models\Vaccination;
use App\Models\DealOfTheDay;
use App\Models\MostDemanded;
use Illuminate\Http\Request;
use App\Models\ParentArticle;
use App\Models\FamilyRelation;
use App\Models\ProductCompare;
use Illuminate\Support\Carbon;
use App\Models\ShippingAddress;
use App\Models\ParentMobileData;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentArticleCategory;
use App\Models\VaccinationSubmission;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
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
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::with('childs')->where('id', '!=', '0')->get();
        return view('admin-views.parent.list', compact('customers'));
    }

    public function ParentView($id)
    {
        $customer = User::where('id', $id)->with('childs')->first();
        if (isset($customer)) {
            return view('admin-views.parent.view', compact('customer'));
        }
        Toastr::error(translate('customer_Not_Found'));
        return back();
    }
    public function parenting_tools()
    {
        return view(VIEW_FILE_NAMES['parenting']);
    }

    public function parenting_profile()
    {
        $customer_detail = User::where('id', auth('customer')->id())->first();
        return view(VIEW_FILE_NAMES['profile'], compact('customer_detail'));
    }

    public function parenting_child(){
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
            $customer_detail = User::where('id', auth('customer')->id())->first();
            return view(VIEW_FILE_NAMES['my_child'], compact('customer_detail','childs','customer_detail', 'addresses', 'wishlists', 'total_order', 'total_loyalty_point', 'total_wallet_balance'));
            
        }else{
            Toastr::success('Please Login First');
            return redirect()->route('customer.auth.login');
        }
    }
    public function edit_profile(Request $request)
    {
        // $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $customer_detail = User::where('id', auth('customer')->id())->first();
        return view(VIEW_FILE_NAMES['edit-profile'], compact('customer_detail'));
    }
    public function faourite_names()
    {
        return view(VIEW_FILE_NAMES['favourite-names']);
    }
    public function parenting_bookmarks()
    {
        return view(VIEW_FILE_NAMES['my-bookmarks']);
    }
    public function parenting_bumpie()
    {
        return view(VIEW_FILE_NAMES['my-bumpie']);
    }
    public function parenting_memories()
    {
        return view(VIEW_FILE_NAMES['my-memories']);
    }
    public function parenting_milestones()
    {
        return view(VIEW_FILE_NAMES['my-milestones']);
    }
    public function quick_reads()
    {
        return view(VIEW_FILE_NAMES['my-quick-reads']);
    }
    public function parenting_topics()
    {
        return view(VIEW_FILE_NAMES['my-topics']);
    }
    public function parentuser(Request $request)
    {

        $theme_name = theme_root_path();
        $main_banner = $this->banner->where(['banner_type' => 'Parent Banner', 'theme' => $theme_name, 'published' => 1])->latest()->get();
        $main_section_banner = $this->banner->where(['banner_type' => 'Main Section Banner', 'theme' => $theme_name, 'published' => 1])->orderBy('id', 'desc')->latest()->first();
        $parent_article_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->with('child')->latest()->take(5)->get();
        $all_parent_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'desc')->with(['child.articles','articles'])->get();
        $all_parent_articles = ParentArticle::where('status', '1')->orderBy('id', 'desc')->get();
       
        $userAgent = $request->header('User-Agent');
        if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false) 
        {
            $top_banner = ParentMobileData::where(['status'=> '1', 'type' => 'top_banner'])->get();
            $scroll_one = ParentMobileData::where(['status'=> '1', 'type' => 'scroll_one'])->get();
            $scroll_two = ParentMobileData::where(['status'=> '1', 'type' => 'scroll_two'])->get();
            $scroll_three = ParentMobileData::where(['status'=> '1', 'type' => 'scroll_three'])->get();
            $middle_banner = ParentMobileData::where(['status'=> '1', 'type' => 'middle_banner'])->get();
            $scroll_four = ParentMobileData::where(['status'=> '1', 'type' => 'scroll_four'])->get();
            $bottom_banner = ParentMobileData::where(['status'=> '1', 'type' => 'bottom_banner'])->get();

            return view(
                VIEW_FILE_NAMES['parenting-mobile'],
                compact(
                    'main_section_banner',
                    'main_banner',
                    'parent_article_categories',
                    'all_parent_categories',
                    'top_banner',
                    'scroll_one',
                    'scroll_two',
                    'scroll_three',
                    'middle_banner',
                    'scroll_four',
                    'bottom_banner'
                )
            );
        }
        else{
            return view(
                VIEW_FILE_NAMES['parenting-user'],
                compact(
                    'main_section_banner',
                    'main_banner',
                    'parent_article_categories',
                    'all_parent_categories',
                    'all_parent_articles',
                )
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'relation_type' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'profile_picture' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first());
            return back();
        } else {
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $file->move(public_path('assets/images/customers/child'), $filename);
            } else {
                $filename = null;
            }
            $childId = DB::table('family_relation')->insertGetId([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'relation_type' => $request->relation_type,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'profile_picture' => ($filename ?? ''),
            ]);
            $Vaccinations = Vaccination::get();
            foreach ($Vaccinations as $vaccination) {
                $dateOfBirth = $request->dob;
                $carbonDateOfBirth = Carbon::parse($dateOfBirth);
                $resultDate = $carbonDateOfBirth->addWeeks($vaccination->age)->toDateString();
                VaccinationSubmission::create([
                    'user_id' => $request->user_id,
                    'child_id' => $childId,
                    'vaccination_id' => $vaccination->id,
                    'vaccination_date' => $resultDate,
                ]);
            }
            Toastr::success('Child Added Successfully');
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::guard('customer')->check()) {
            FamilyRelation::where(['id' => $id, 'user_id' => Auth::guard('customer')->id()])->delete();
            Toastr::success('Child Deleted Successfully');
            return back();
        } else {
            Toastr::error(translate('please_login_first'));
            return back();
        }
    }
}
