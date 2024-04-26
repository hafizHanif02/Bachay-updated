<?php

namespace App\Http\Controllers\RestAPI\v1;

use App\Models\Tag;
use App\Models\Color;
use App\Utils\Helpers;
use App\Models\Currency;
use App\Models\HelpTopic;
use App\Models\ShippingType;
use App\Utils\ProductManager;
use App\Models\FamilyRelation;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;
use function App\Utils\payment_gateways;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\CustomPage;
use App\Models\DealOfTheDay;
use App\Models\FlashDeal;
use App\Models\MostDemanded;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use Illuminate\Http\Request;    
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class ConfigController extends Controller
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
    )
    {
    }
    public function configuration()
    {
        $currency = Currency::all();
        $social_login = [];
        foreach (Helpers::get_business_settings('social_login') as $social) {
            $config = [
                'login_medium' => $social['login_medium'],
                'status' => (boolean)$social['status']
            ];
            array_push($social_login, $config);
        }

        foreach (Helpers::get_business_settings('apple_login') as $social) {
            $config = [
                'login_medium' => $social['login_medium'],
                'status' => (boolean)$social['status']
            ];
            array_push($social_login, $config);
        }

        $languages = Helpers::get_business_settings('pnc_language');
        $lang_array = [];
        foreach ($languages as $language) {
            array_push($lang_array, [
                'code' => $language,
                'name' => Helpers::get_language_name($language)
            ]);
        }

        $offline_payment = null;
        $offline_payment_status = Helpers::get_business_settings('offline_payment')['status'] == 1 ?? 0;
        if($offline_payment_status){
            $offline_payment = [
                'name' => 'offline_payment',
                'image' => asset('public/assets/back-end/img/pay-offline.png'),
            ];
        }

        $payment_methods = payment_gateways();
        $payment_methods->map(function ($payment) {
            $payment->additional_datas = json_decode($payment->additional_data);

            unset(
                $payment->additional_data,
                $payment->live_values,
                $payment->test_values,
                $payment->id,
                $payment->settings_type,
                $payment->mode,
                $payment->is_active,
                $payment->created_at,
                $payment->updated_at
            );
        });


        $admin_shipping = ShippingType::where('seller_id',0)->first();
        $shipping_type = isset($admin_shipping)==true?$admin_shipping->shipping_type:'order_wise';

        $childs =  FamilyRelation::get();

        $company_logo = asset("storage/app/public/company/").'/'.BusinessSetting::where(['type'=>'company_web_logo'])->first()->value;

        return response()->json([
            'brand_setting' => BusinessSetting::where('type', 'product_brand')->first()->value,
            'digital_product_setting' => BusinessSetting::where('type', 'digital_product')->first()->value,
            'system_default_currency' => (int)Helpers::get_business_settings('system_default_currency'),
            'digital_payment' => (boolean)Helpers::get_business_settings('digital_payment')['status'] ?? 0,
            'cash_on_delivery' => (boolean)Helpers::get_business_settings('cash_on_delivery')['status'] ?? 0,
            'seller_registration' => BusinessSetting::where('type', 'seller_registration')->first()->value,
            'pos_active' => BusinessSetting::where('type','seller_pos')->first()->value,
            'company_phone' => Helpers::get_business_settings('company_phone'),
            'company_email' => Helpers::get_business_settings('company_email'),
            'company_logo' => $company_logo,
            'delivery_country_restriction' => Helpers::get_business_settings('delivery_country_restriction'),
            'delivery_zip_code_area_restriction' => Helpers::get_business_settings('delivery_zip_code_area_restriction'),
            'base_urls' => [
                'product_image_url' => ProductManager::product_image_path('product'),
                'product_thumbnail_url' => ProductManager::product_image_path('thumbnail'),
                'digital_product_url' => asset('storage/app/public/product/digital-product'),
                'brand_image_url' => asset('storage/app/public/brand'),
                'customer_image_url' => asset('storage/app/public/profile'),
                'banner_image_url' => asset('storage/app/public/banner'),
                'category_image_url' => asset('storage/app/public/category'),
                'review_image_url' => asset('storage/app/public'),
                'seller_image_url' => asset('storage/app/public/seller'),
                'shop_image_url' => asset('storage/app/public/shop'),
                'notification_image_url' => asset('storage/app/public/notification'),
                'delivery_man_image_url' => asset('storage/app/public/delivery-man'),
                'support_ticket_image_url' => asset('storage/app/public/support-ticket'),
                'chatting_image_url' => asset('storage/app/public/chatting'),
            ],
            'static_urls' => [
                'contact_us' => route('contacts'),
                'brands' => route('brands'),
                'categories' => route('categories'),
                'customer_account' => route('user-account'),
            ],
            'about_us' => Helpers::get_business_settings('about_us'),
            'privacy_policy' => Helpers::get_business_settings('privacy_policy'),
            'faq' => HelpTopic::all(),
            'terms_&_conditions' => Helpers::get_business_settings('terms_condition'),
            'refund_policy' => Helpers::get_business_settings('refund-policy'),
            'return_policy' => Helpers::get_business_settings('return-policy'),
            'cancellation_policy' => Helpers::get_business_settings('cancellation-policy'),
            'currency_list' => $currency,
            'currency_symbol_position' => Helpers::get_business_settings('currency_symbol_position') ?? 'right',
            'business_mode'=> Helpers::get_business_settings('business_mode'),
            'maintenance_mode' => (boolean)Helpers::get_business_settings('maintenance_mode') ?? 0,
            'language' => $lang_array,
            'colors' => Color::all(),
            'unit' => Helpers::units(),
            'shipping_method' => Helpers::get_business_settings('shipping_method'),
            'email_verification' => (boolean)Helpers::get_business_settings('email_verification'),
            'phone_verification' => (boolean)Helpers::get_business_settings('phone_verification'),
            'country_code' => Helpers::get_business_settings('country_code'),
            'social_login' => $social_login,
            'currency_model' => Helpers::get_business_settings('currency_model'),
            'forgot_password_verification' => Helpers::get_business_settings('forgot_password_verification'),
            'announcement'=> Helpers::get_business_settings('announcement'),
            'pixel_analytics'=> Helpers::get_business_settings('pixel_analytics'),
            'software_version'=>env('SOFTWARE_VERSION'),
            'decimal_point_settings'=>Helpers::get_business_settings('decimal_point_settings'),
            'inhouse_selected_shipping_type'=>$shipping_type,
            'billing_input_by_customer'=>Helpers::get_business_settings('billing_input_by_customer'),
            'minimum_order_limit'=>Helpers::get_business_settings('minimum_order_limit'),
            'wallet_status'=>Helpers::get_business_settings('wallet_status'),
            'loyalty_point_status'=>Helpers::get_business_settings('loyalty_point_status'),
            'loyalty_point_exchange_rate'=>Helpers::get_business_settings('loyalty_point_exchange_rate'),
            'loyalty_point_minimum_point'=>Helpers::get_business_settings('loyalty_point_minimum_point'),
            'payment_methods' => $payment_methods,
            'offline_payment' => $offline_payment,
            'payment_method_image_path' => asset('storage/app/public/payment_modules/gateway_image'),
            'ref_earning_status' => BusinessSetting::where('type', 'ref_earning_status')->first()->value ?? 0,
            'active_theme' => theme_root_path(),
            'popular_tags'=>Tag::orderBy('visit_count', 'desc')->take(15)->get(),
            'guest_checkout'=>Helpers::get_business_settings('guest_checkout'),
            'upload_picture_on_delivery'=>Helpers::get_business_settings('upload_picture_on_delivery'),
            'user_app_version_control'=>Helpers::get_business_settings('user_app_version_control'),
            'seller_app_version_control'=>Helpers::get_business_settings('seller_app_version_control'),
            'delivery_man_app_version_control'=>Helpers::get_business_settings('delivery_man_app_version_control'),
            'add_funds_to_wallet'=>Helpers::get_business_settings('add_funds_to_wallet'),
            'minimum_add_fund_amount'=>Helpers::get_business_settings('minimum_add_fund_amount'),
            'maximum_add_fund_amount'=>Helpers::get_business_settings('maximum_add_fund_amount'),
            'inhouse_temporary_close'=>Helpers::get_business_settings('temporary_close'),
            'inhouse_vacation_add'=>Helpers::get_business_settings('vacation_add'),
            'free_delivery_status'=>Helpers::get_business_settings('free_delivery_status'),
            'free_delivery_over_amount'=>Helpers::get_business_settings('free_delivery_over_amount'),
            'free_delivery_responsibility'=>Helpers::get_business_settings('free_delivery_responsibility'),
            'free_delivery_over_amount_seller'=>Helpers::get_business_settings('free_delivery_over_amount_seller'),
            'minimum_order_amount_status'=> Helpers::get_business_settings('minimum_order_amount_status'),
            'minimum_order_amount'=> Helpers::get_business_settings('minimum_order_amount'),
            'minimum_order_amount_by_seller'=> Helpers::get_business_settings('minimum_order_amount_by_seller'),
            'order_verification'=> Helpers::get_business_settings('order_verification'),
            'referral_customer_signup_url'=> route('home').'?referral_code=',
            'system_timezone'=> getWebConfig(name: 'timezone'),
            'childerens' => $childs,
        ]);
    }

    public function home(Request $request){
        $userAgent = $request->header('User-Agent');
        if ((strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false)) {
            $device = 'mobile';
        }else{
            $device = 'desktop';
        }
        
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
                            }, 'childes.childes'])->orderBy('id','asc')
                            ->where('position', 0);

        $categories = $all_categories->get();
        $most_visited_categories = $all_categories->get();


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
            $custom_pages = CustomPage::get();

            $childerens = FamilyRelation::get();

            return response()->json([
                'device' => $device,
                'custom_pages' => $custom_pages,
                'sizes' => $sizes,
                'latest_products' => $latest_products,
                'deal_of_the_day' => $deal_of_the_day,
                'top_sellers' => $top_sellers,
                'topRatedShops' => $topRatedShops,
                'main_banner' => $main_banner,
                'most_visited_categories' => $most_visited_categories,
                'random_product' => $random_product,
                'decimal_point_settings' => $decimal_point_settings,
                'newSellers' => $newSellers,
                'sidebar_banner' => $sidebar_banner,
                'top_side_banner' => $top_side_banner,
                'recent_order_shops' => $recent_order_shops,
                'categories' => $categories,
                'colors_in_shop' => $colors_in_shop,
                'all_products_info' => $all_products_info,
                'most_searching_product' => $most_searching_product,
                'most_demanded_product' => $most_demanded_product,
                'featured_products' => $featured_products,
                'promo_banner_left' => $promo_banner_left,
                'promo_banner_middle_top' => $promo_banner_middle_top,
                'promo_banner_middle_bottom' => $promo_banner_middle_bottom,
                'promo_banner_right' => $promo_banner_right,
                'promo_banner_bottom' => $promo_banner_bottom,
                'currentDate' => $currentDate,
                'all_products' => $all_products,
                'featured_deals' => $featured_deals,
                'childerens' => $childerens
            ]);

    }

    public function sizes(){

        $all_products = Product::get();
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

            return response()->json([
                'sizes' => $sizes,
            ]);

    }


    public function latest_products(){

        $theme_name = theme_root_path();
        $currentDate = date('Y-m-d H:i:s');
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
        
        foreach($latest_products as $product){
            $product->thumbnail = asset('storage/app/public/product/thumbnail/'.$product->thumbnail);
        }

        return response()->json([
            'latest_products' => $latest_products
        ]);
    }


    public function deal_of_the_day(){
        $deal_of_the_day = $this->deal_of_the_day->with(['product'=>function($query){
            $query->active();
        }])->where('status', 1)->first();

        $deal_of_the_day->product->thumbnail = asset('storage/app/public/product/thumbnail/'.$deal_of_the_day->product->thumbnail);
        

        return response()->json([
            'deal_of_the_day' => $deal_of_the_day,
        ]);
    }

    public function top_sellers(){
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

        foreach($top_sellers as $seller){
            // $seller->image = asset('storage/app/public/top_seller/thumbnail/'.$seller->image);
            foreach($seller->product as $product){
                $product->thumbnail = asset('storage/app/public/product/thumbnail/'.$product->thumbnail);
            }
        }

        return response()->json([
            'top_sellers' => $top_sellers
        ]);
    }


    public function topRatedShops(){
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

            return response()->json([
                'topRatedShops' => $topRatedShops
            ]);
    }

    public function main_banner(){
        $theme_name = theme_root_path();

        $main_banner = Banner::where(['banner_type'=> 'Main Banner', 'published'=> 1, 'theme'=>$theme_name])->latest()->get();

        foreach($main_banner as $banner){
            $banner->photo = asset('storage/app/public/banner/'.$banner->photo);
            $banner->mobile_photo = asset('storage/app/public/banner/'.$banner->mobile_photo);
        }

        return response()->json([
            'main_banner' => $main_banner
        ]);
    }

    public function most_visited_categories(){
        $all_categories = Category::withCount(['product'=>function($query){
                                $query->active();
                            }])->with(['childes' => function ($sub_query) {
                                $sub_query->with(['childes' => function ($sub_sub_query) {
                                    $sub_sub_query->withCount(['subSubCategoryProduct'])->where('position', 2);
                                }])->withCount(['subCategoryProduct'])->where('position', 1);
                            }, 'childes.childes'])->orderBy('id','asc')
                            ->where('position', 0);

        $categories = $all_categories->get();
        $most_visited_categories = $all_categories->get();
        
        foreach($most_visited_categories as $category){
            $category->icon = asset('storage/app/public/category/'.$category->icon);
        }


        return response()->json([
            'most_visited_categories' => $most_visited_categories
        ]);

    }

    public function random_product(){
        $random_product =$this->product->active()->inRandomOrder()->first();

        $random_product->thumbnail = asset('storage/app/public/product/thumbnail/'.$random_product->thumbnail);
       
        return response()->json([
            'random_product' => $random_product
        ]);

    }
    public function decimal_point_settings(){
        $decimal_point_settings = !empty(\App\Utils\Helpers::get_business_settings('decimal_point_settings')) ? \App\Utils\Helpers::get_business_settings('decimal_point_settings') : 0;

        return response()->json([
            'decimal_point_settings' => $decimal_point_settings
        ]);
    }

    public function newSellers(){
        $seller_list = $this->seller->approved()->with(['shop','product.reviews'])
            ->withCount(['product' => function ($query) {
                 $query->active();
            }])->get();
            $seller_list?->map(function ($seller) {
                $rating = 0;
                $count = 0;
                foreach ($seller->product as $item) {
                        $item->thumbnail = asset('storage/app/public/product/thumbnail/'.$item->thumbnail);
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

        // foreach($newSellers as $seller){
        //     $seller->image = asset('storage/app/public/profile/'.$seller->image);
        // }

        return response()->json([
            'newSellers' => $newSellers
        ]);
    }

    public function sidebar_banner(){
        $theme_name = theme_root_path();

        $sidebar_banner = Banner::where(['banner_type'=> 'Sidebar Banner','published'=> 1, 'theme'=>$theme_name])->latest()->first();
    
        return response()->json([
            'sidebar_banner' => $sidebar_banner
        ]);
    }

    public function top_side_banner(){
        $theme_name = theme_root_path();

        $top_side_banner = Banner::where(['banner_type'=> 'Top Side Banner','published'=> 1, 'theme'=>$theme_name])->orderBy('id', 'desc')->latest()->first();
        if($top_side_banner){
            $top_side_banner->photo = asset('storage/app/public/banner/'.$top_side_banner->photo);
            $top_side_banner->mobile_photo = asset('storage/app/public/banner/'.$top_side_banner->mobile_photo);
        }
        return response()->json([
            'top_side_banner' => $top_side_banner
        ]);
    
    }

    public function recent_order_shops(){
        $user = Helpers::get_customer();

        $recent_order_shops = $user != 'offline' ?
                $this->product->with('seller.shop')
                    ->whereHas('seller.orders', function ($query) {
                        $query->where(['customer_id' => auth('customer')->id(), 'seller_is' => 'seller']);
                    })->active()
                    ->inRandomOrder()->take(12)->get()
                : [];

        return response()->json([
            'recent_order_shops' => $recent_order_shops
        ]);
    }

    public function categories(){
        $all_categories = Category::withCount(['product'=>function($query){
            $query->active();
        }])->with(['childes' => function ($sub_query) {
            $sub_query->with(['childes' => function ($sub_sub_query) {
                $sub_sub_query->withCount(['subSubCategoryProduct'])->where('position', 2);
            }])->withCount(['subCategoryProduct'])->where('position', 1);
        }, 'childes.childes'])->orderBy('id','asc')
        ->where('position', 0);

        $categories = $all_categories->get();
        
        foreach($categories as  $category){
            $category->icon = asset('storage/app/category/'.$category->icon);
        }
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function colors_in_shop(){
        $colors_in_shop = ProductManager::get_colors_form_products();
    
        return response()->json([
            'colors_in_shop' => $colors_in_shop
        ]);
    }

    public function all_products_info(){
        $all_product_section_orders = $this->order->where(['order_type'=>'default_type']);
        $all_products_info = [
            'total_products' => $this->product->active()->count(),
            'total_orders' => $all_product_section_orders->count(),
            'total_delivary' => $all_product_section_orders->where(['payment_status'=>'paid', 'order_status'=>'delivered'])->count(),
            'total_reviews' => $this->review->where('product_id', '!=', 0)->whereNull('delivery_man_id')->count(),
        ];

        return response()->json([
            'all_products_info' => $all_products_info
        ]);
    }

    public function most_searching_product(){

        $most_searching_product = Product::active()->with(['category', 'wishList'=>function($query){
            return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
        }])->withSum('tags', 'visit_count')->orderBy('tags_sum_visit_count', 'desc')->get();
        $most_searching_product = $most_searching_product->take(10);

    
        return response()->json([
            'most_searching_product' => $most_searching_product
        ]);
    }

    public function most_demanded_product(){
        $most_demanded_product = $this->most_demanded->where('status',1)->with(['product'=>function($query){
            $query->withCount('wishList','orderDetails','orderDelivered','reviews');
        }])->whereHas('product', function ($query){
            return $query->active();
        })->first();

        $most_demanded_product->product->thumbnail = asset('storage/app/public/product/thumbnail/'.$most_demanded_product->product->thumbnail);

        return response()->json([
            'most_demanded_product' => $most_demanded_product
        ]);
    }

    public function featured_products(){
        $featured_products = $this->product->active()->where('featured', 1)
                            ->with(['wishList'=>function($query){
                                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
                            }])->latest()->take(20)->get();
        foreach($featured_products as $product){
            $product->thumbnail = asset('storage/app/public/product/thumbnail/'.$product->thumbnail);
        }
        return response()->json([
            'featured_products' => $featured_products
        ]);
    }

    public function promo_banner_left(){
        $theme_name = theme_root_path();

        $promo_banner_left = Banner::where(['banner_type'=> 'Promo Banner Left', 'published'=> 1, 'theme'=>$theme_name])->first();

        return response()->json([
            'promo_banner_left' => $promo_banner_left
        ]);
    }

    public function promo_banner_middle_bottom(){
        $theme_name = theme_root_path();

        $promo_banner_middle_bottom = Banner::where(['banner_type'=> 'Promo Banner Middle Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();

        return response()->json([
            'promo_banner_middle_bottom' => $promo_banner_middle_bottom
        ]);
    }

    public function promo_banner_right(){
        $theme_name = theme_root_path();
        $promo_banner_right = Banner::where(['banner_type'=> 'Promo Banner Right', 'published'=> 1, 'theme'=>$theme_name])->first();

        return response()->json([
            'promo_banner_right' => $promo_banner_right
        ]);
    }

    public function promo_banner_bottom(){
        $theme_name = theme_root_path();

        $promo_banner_bottom = Banner::where(['banner_type'=> 'Promo Banner Bottom', 'published'=> 1, 'theme'=>$theme_name])->first();

        return response()->json([
            'promo_banner_bottom' => $promo_banner_bottom
        ]);
    }

    public function currentDate(){

        $currentDate = date('Y-m-d H:i:s');

        return response()->json([
            'currentDate' => $currentDate
        ]);
    }

    public function all_products(){
        $currentDate = date('Y-m-d H:i:s');

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

        foreach($all_products as $product){
            $product->thumbnail = asset('storage/app/public/product/thumbnail/'.$product->thumbnail);
        }

        return response()->json([
            'all_products' => $all_products
        ]);


    }

    public function featured_deals(){
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

        return response()->json([
            'featured_deals' => $featured_deals
        ]);
    }

    public function childerens(){
        $childerens = FamilyRelation::get();
        return response()->json([
            'childerens' => $childerens
        ]);
    }
}

