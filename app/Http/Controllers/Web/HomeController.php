<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\BusinessSetting;
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
use App\Utils\Helpers;
use App\Utils\ProductManager;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class HomeController extends Controller
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


    public function index(Request $request)
    {
        $theme_name = theme_root_path();
        
        return match ($theme_name) {
            'default' => self::default_theme(),
            'theme_aster' => self::theme_aster(),
            'theme_fashion' => self::theme_fashion($request),
            'theme_all_purpose' => self::theme_all_purpose(),
        };
    }


    public function theme_fashion($request): View
    {
        
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
            })->with(['category','reviews', 'flashDealProducts.flashDeal', 'tags','wishList'=>function($query){
                return $query->where('customer_id', Auth::guard('customer')->user()->id ?? 0);
            }])
            ->active()->orderBy('order_details_sum_qty', 'DESC')
            ->paginate(12);
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
        $promo_banner_bottom = Banner::where(['banner_type'=> 'Promo Banner Bottom', 'published'=> 1, 'theme'=>$theme_name])->get();

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



            //-----------------

            
            
                

            //----------------
        return view(VIEW_FILE_NAMES['home'],
            compact(
                'mergedChoices','device','custom_pages','sizes','latest_products', 'deal_of_the_day', 'top_sellers','topRatedShops', 'main_banner','most_visited_categories',
                'random_product', 'decimal_point_settings', 'newSellers', 'sidebar_banner', 'top_side_banner', 'recent_order_shops',
                'categories', 'colors_in_shop', 'all_products_info', 'most_searching_product', 'most_demanded_product', 'featured_products','promo_banner_left',
                'promo_banner_middle_top','promo_banner_middle_bottom','promo_banner_right', 'promo_banner_bottom', 'currentDate', 'all_products',
                'featured_deals'
            )
        );
    }
    

    public function toys(Request $request){
        $theme_name = theme_root_path();
        $banners = Banner::where(['resource_type'=> 'category', 'published'=> 1, 'resource_id'=>4])->latest()->get();

        return view(VIEW_FILE_NAMES['toys'], compact('banners'));
    }
    

}
