<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\FamilyRelationController;
use App\Http\Controllers\RestAPI\v1\auth\PassportAuthController;
use App\Http\Controllers\ParentArticleController;
use App\Http\Controllers\QuizController;

use App\Http\Controllers\API\FoodController;

header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::options('/{any}', function (Request $request) {
    return response()->json([], 200, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
})->where('any', '.*');



Route::get('/test-token', function () {
    $user = App\Models\User::first();
    $token = $user->createToken('LaravelAuthApp')->accessToken;
    return response()->json(['token' => $token]);
});

Route::group(['namespace' => 'RestAPI\v1', 'prefix' => 'v1', 'middleware' => ['api_lang']], function () {
    Route::get('/test-cors', function () {
        return response('CORS test')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, DELETE, PUT')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Csrf-Token');
    });
    Route::group(['namespace' => 'Customer', 'prefix' => 'customer', 'as' => 'customer.'], function () {

        Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
            Route::post('register', [PassportAuthController::class, 'register']);
            Route::post('login', [PassportAuthController::class, 'verifyToken']);
            Route::post('login-password', [PassportAuthController::class, 'login']);
            Route::post('token', [PassportAuthController::class, 'TokenCheck']);
            Route::get('logout', 'PassportAuthController@logout')->middleware('auth:api');

            Route::post('check-phone', 'PhoneVerificationController@check_phone');
            Route::post('resend-otp-check-phone', 'PhoneVerificationController@resend_otp_check_phone');
            Route::post('verify-phone', 'PhoneVerificationController@verify_phone');

            Route::post('check-email', 'EmailVerificationController@check_email');
            Route::post('resend-otp-check-email', 'EmailVerificationController@resend_otp_check_email');
            Route::post('verify-email', 'EmailVerificationController@verify_email');

            Route::post('forgot-password', 'ForgotPassword@reset_password_request');
            Route::post('verify-otp', 'ForgotPassword@otp_verification_submit');
            Route::put('reset-password', 'ForgotPassword@reset_password_submit');

            Route::post('social-login', 'SocialAuthController@social_login');
            Route::post('update-phone', 'SocialAuthController@update_phone');
        });
    });


    Route::group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@configuration');
    });

    Route::get('home', 'ConfigController@home')->name('home');
    Route::get('sizes', 'ConfigController@sizes')->name('sizes');
    Route::get('latest_products', 'ConfigController@latest_products')->name('latest_products');
    Route::get('deal_of_the_day', 'ConfigController@deal_of_the_day')->name('deal_of_the_day');
    Route::get('top_sellers', 'ConfigController@top_sellers')->name('top_sellers');
    Route::get('topRatedShops', 'ConfigController@topRatedShops')->name('topRatedShops');
    Route::get('main_banner', 'ConfigController@main_banner')->name('main_banner');
    Route::get('promo-alert-banner', 'ConfigController@alert_banner');
    Route::get('promo-deal-banner', 'ConfigController@deal_banner');
    Route::get('promo-season-banner', 'ConfigController@season_banner');
    Route::get('trends-banner', 'ConfigController@trends_banner');
    Route::get('most_visited_categories', 'ConfigController@most_visited_categories')->name('most_visited_categories');
    Route::get('random_product', 'ConfigController@random_product')->name('random_product');
    Route::get('decimal_point_settings', 'ConfigController@decimal_point_settings')->name('decimal_point_settings');
    Route::get('newSellers', 'ConfigController@newSellers')->name('newSellers');
    Route::get('sidebar_banner', 'ConfigController@sidebar_banner')->name('sidebar_banner');
    Route::get('top_side_banner', 'ConfigController@top_side_banner')->name('top_side_banner');
    Route::get('recent_order_shops', 'ConfigController@recent_order_shops')->name('recent_order_shops');
    Route::get('categories-list', 'ConfigController@categories')->name('categories');
    Route::get('colors_in_shop', 'ConfigController@colors_in_shop')->name('colors_in_shop');
    Route::get('all_products_info', 'ConfigController@all_products_info')->name('all_products_info');
    Route::get('most_searching_product', 'ConfigController@most_searching_product')->name('most_searching_product');
    Route::get('most_demanded_product', 'ConfigController@most_demanded_product')->name('most_demanded_product');
    Route::get('featured_products', 'ConfigController@featured_products')->name('featured_products');
    Route::get('promo_banner_left', 'ConfigController@promo_banner_left')->name('promo_banner_left');
    Route::get('promo_banner_middle_bottom', 'ConfigController@promo_banner_middle_bottom')->name('promo_banner_middle_bottom');
    Route::get('promo_banner_right', 'ConfigController@promo_banner_right')->name('promo_banner_right');
    Route::get('promo_banner_bottom', 'ConfigController@promo_banner_bottom')->name('promo_banner_bottom');
    Route::get('currentDate', 'ConfigController@currentDate')->name('currentDate');
    Route::get('all_products', 'ConfigController@all_products')->name('all_products');
    Route::get('featured_deals', 'ConfigController@featured_deals')->name('featured_deals');
    Route::get('childerens', 'ConfigController@childerens')->name('childerens')->middleware('auth:api');


    Route::group(['prefix' => 'shipping-method', 'middleware' => 'apiGuestCheck'], function () {
        Route::get('detail/{id}', 'ShippingMethodController@get_shipping_method_info');
        Route::get('by-seller/{id}/{seller_is}', 'ShippingMethodController@shipping_methods_by_seller');
        Route::post('choose-for-order', 'ShippingMethodController@choose_for_order');
        Route::get('chosen', 'ShippingMethodController@chosen_shipping_methods');

        Route::get('check-shipping-type', 'ShippingMethodController@check_shipping_type');
    });

    Route::group(['prefix' => 'cart', 'middleware' => 'auth:api'], function () {
        Route::get('/', 'CartController@cart');
        Route::post('add', 'CartController@add_to_cart');
        Route::post('update', 'CartController@update_cart');
        Route::post('remove', 'CartController@remove_from_cart');
        Route::post('remove-all', 'CartController@remove_all_from_cart');

    });

    Route::group(['prefix' => 'customer/order', 'middleware' => 'apiGuestCheck'], function () {
        Route::get('get-order-by-id', 'CustomerController@get_order_by_id');
    });

    Route::get('faq', 'GeneralController@faq');

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotificationController@list');
        Route::get('/seen', 'NotificationController@notification_seen')->middleware('auth:api');
    });

    Route::group(['prefix' => 'child'], function () {
        Route::get('/', [FamilyRelationController::class, 'childHome'])->middleware('auth:api');
        Route::get('detail/{id}', [FamilyRelationController::class, 'childDetail'])->middleware('auth:api');
        Route::post('add-child', [FamilyRelationController::class, 'add_child'])->middleware('auth:api');
        Route::post('update-child/{childId}', [FamilyRelationController::class, 'update_child'])->middleware('auth:api');
        Route::post('delete-child', [FamilyRelationController::class, 'delete_child'])->middleware('auth:api');
    });

    Route::group(['prefix' => 'attributes'], function () {
        Route::get('/', 'AttributeController@get_attributes');
    });

    Route::group(['prefix' => 'flash-deals'], function () {
        Route::get('/', 'FlashDealController@get_flash_deal');
        Route::get('products/{deal_id}', 'FlashDealController@get_products');
    });

    Route::group(['prefix' => 'deals'], function () {
        Route::get('featured', 'DealController@get_featured_deal');
    });

    Route::group(['prefix' => 'dealsoftheday'], function () {
        Route::get('deal-of-the-day', 'DealOfTheDayController@get_deal_of_the_day_product');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('reviews/{product_id}', 'ProductController@get_product_reviews');
        Route::get('rating/{product_id}', 'ProductController@get_product_rating');
        Route::get('counter/{product_id}', 'ProductController@counter');
        Route::get('shipping-methods', 'ProductController@get_shipping_methods');
        Route::get('social-share-link/{product_id}', 'ProductController@social_share_link');
        Route::post('reviews/submit', 'ProductController@submit_product_review')->middleware('auth:api');
    });

    Route::group(['prefix' => 'custom_page', 'as' => 'custom_page.'], function () {
        Route::get('/', [CustomPageController::class, 'custom_page'])->name('list');
        Route::get('/{id}', [CustomPageController::class, 'custom_page_detail'])->name('detail');
    });
    Route::get('products/list', 'ProductController@list');
    Route::get('products/single/{product_id}', 'ProductController@get_product_single');

    Route::group(['prefix' => 'products'], function () {
        Route::get('latest', 'ProductController@get_latest_products');
        Route::get('featured', 'ProductController@get_featured_products');
        Route::get('top-rated', 'ProductController@get_top_rated_products');
        Route::any('search', 'ProductController@get_searched_products');
        Route::any('search_suggestion', 'ProductController@get_searched_products_suggestion');
        Route::post('filter', 'ProductController@product_filter');
        Route::any('suggestion-product', 'ProductController@get_suggestion_product');
        Route::get('details/{slug}', 'ProductController@get_product');
        Route::get('related-products/{product_id}', 'ProductController@get_related_products');
        Route::get('best-sellings', 'ProductController@get_best_sellings');
        Route::get('home-categories', 'ProductController@get_home_categories');
        Route::get('discounted-product', 'ProductController@get_discounted_product');
        Route::get('most-demanded-product', 'ProductController@get_most_demanded_product');
        Route::get('shop-again-product', 'ProductController@get_shop_again_product')->middleware('auth:api');
        Route::get('just-for-you', 'ProductController@just_for_you');
        Route::get('most-searching', 'ProductController@get_most_searching_products');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@get_categories');
        Route::get('/sub-categories/{category_id}', 'CategoryController@get_sub_categories');
        Route::get('banners/{category_id}', 'CategoryController@get_banners');
        Route::get('products/{category_id}', 'CategoryController@get_products');
        Route::get('/find-what-you-need', 'CategoryController@find_what_you_need');
    });
    Route::group(['middleware' => 'apiGuestCheck'], function () {

        Route::group(['prefix' => 'seller'], function () {
            Route::get('{seller_id}/products', 'SellerController@get_seller_products');
            Route::get('{seller_id}/seller-best-selling-products', 'SellerController@get_seller_best_selling_products');
            Route::get('{seller_id}/seller-featured-product', 'SellerController@get_sellers_featured_product');
            Route::get('{seller_id}/seller-recommended-products', 'SellerController@get_sellers_recommended_products');
        });



        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandController@get_brands');
            Route::get('products/{brand_id}', 'BrandController@get_products');
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::put('cm-firebase-token', 'CustomerController@update_cm_firebase_token');

            Route::get('get-restricted-country-list', 'CustomerController@get_restricted_country_list');
            Route::get('get-restricted-zip-list', 'CustomerController@get_restricted_zip_list');

            Route::group(['prefix' => 'address'], function () {
                Route::post('add', 'CustomerController@add_new_address');
                Route::get('list', 'CustomerController@address_list');
                Route::delete('/', 'CustomerController@delete_address');
            });

            Route::group(['prefix' => 'order'], function () {
                Route::get('place', 'OrderController@place_order');
                Route::get('offline-payment-method-list', 'OrderController@offline_payment_method_list');
                Route::post('place-by-offline-payment', 'OrderController@place_order_by_offline_payment');
                Route::get('details', 'CustomerController@get_order_details');
            });
        });
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function () {
        Route::get('info', 'CustomerController@info');
        Route::post('update-profile', 'CustomerController@update_profile');
        Route::get('account-delete/{id}', 'CustomerController@account_delete');

        Route::group(['prefix' => 'address'], function () {
            Route::get('get/{id}', 'CustomerController@get_address');
            Route::put('update', 'CustomerController@update_address');
        });

        Route::group(['prefix' => 'support-ticket'], function () {
            Route::post('create', 'CustomerController@create_support_ticket');
            Route::get('get', 'CustomerController@get_support_tickets');
            Route::get('conv/{ticket_id}', 'CustomerController@get_support_ticket_conv');
            Route::post('reply/{ticket_id}', 'CustomerController@reply_support_ticket');
            Route::get('close/{id}', 'CustomerController@support_ticket_close');
        });

        Route::group(['prefix' => 'compare'], function () {
            Route::get('list', 'CompareController@list');
            Route::post('product-store', 'CompareController@compare_product_store');
            Route::delete('clear-all', 'CompareController@clear_all');
            Route::get('product-replace', 'CompareController@compare_product_replace');
        });

        Route::group(['prefix' => 'wish-list'], function () {
            Route::get('/', 'CustomerController@wish_list');
            Route::post('add', 'CustomerController@add_to_wishlist');
            Route::delete('remove', 'CustomerController@remove_from_wishlist');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('place-by-wallet', 'OrderController@place_order_by_wallet');
            Route::get('refund', 'OrderController@refund_request');
            Route::post('refund-store', 'OrderController@store_refund');
            Route::get('refund-details', 'OrderController@refund_details');
            Route::get('list', 'CustomerController@get_order_list');
            Route::post('deliveryman-reviews/submit', 'ProductController@submit_deliveryman_review')->middleware('auth:api');
            Route::post('again', 'OrderController@order_again');
        });
        // Chatting
        Route::group(['prefix' => 'chat'], function () {
            Route::get('list/{type}', 'ChatController@list');
            Route::get('get-messages/{type}/{id}', 'ChatController@get_message');
            Route::post('send-message/{type}', 'ChatController@send_message');
            Route::post('seen-message/{type}', 'ChatController@seen_message');
            Route::get('search/{type}', 'ChatController@search');
        });

        //wallet
        Route::group(['prefix' => 'wallet'], function () {
            Route::get('balance', 'UserWalletController@balance');
            Route::get('list', 'UserWalletController@list');
            Route::get('bonus-list', 'UserWalletController@bonus_list');
        });
        //loyalty
        Route::group(['prefix' => 'loyalty'], function () {
            Route::get('list', 'UserLoyaltyController@list');
            Route::post('loyalty-exchange-currency', 'UserLoyaltyController@loyalty_exchange_currency');
        });
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'apiGuestCheck'], function () {
        Route::group(['prefix' => 'order'], function () {
            Route::get('digital-product-download/{id}', 'OrderController@digital_product_download');
            Route::get('digital-product-download-otp-verify', 'OrderController@digital_product_download_otp_verify');
            Route::post('digital-product-download-otp-resend', 'OrderController@digital_product_download_otp_resend');
        });
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('track', 'OrderController@track_by_order_id');
        Route::get('cancel-order', 'OrderController@order_cancel')->middleware('auth:api');
        Route::post('track-order', 'OrderController@track_order');
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });

    Route::group(['prefix' => 'seller'], function () {
        Route::get('/', 'SellerController@get_seller_info');
        Route::get('top', 'SellerController@get_top_sellers');
        Route::get('all', 'SellerController@get_all_sellers');
        Route::get('more', 'SellerController@more_sellers');
    });

    Route::group(['prefix' => 'coupon', 'middleware' => 'auth:api'], function () {
        Route::get('apply', 'CouponController@apply');
    });
    Route::get('coupon/list', 'CouponController@list')->middleware('auth:api');
    Route::get('coupon/applicable-list', 'CouponController@applicable_list')->middleware('auth:api');
    Route::get('coupons/{seller_id}/seller-wise-coupons', 'CouponController@get_seller_wise_coupon');
    Route::get('coupon/first-order-discount', 'CouponController@first_order_discount')->middleware('auth:api');
    Route::get('coupon/first-order-discount-guest', 'CouponController@first_order_discount_guest');

    Route::get('get-guest-id', 'GeneralController@get_guest_id');

    //map api
    Route::group(['prefix' => 'mapapi'], function () {
        Route::get('place-api-autocomplete', 'MapApiController@place_api_autocomplete');
        Route::get('distance-api', 'MapApiController@distance_api');
        Route::get('place-api-details', 'MapApiController@place_api_details');
        Route::get('geocode-api', 'MapApiController@geocode_api');
    });

    Route::post('contact-us', 'GeneralController@contact_store');
    Route::put('customer/language-change', 'CustomerController@language_change')->middleware('auth:api');

    Route::group(['prefix' => 'article'], function () {
        Route::get('/', [ParentArticleController::class,'get_articles']);
        Route::get('categories', [ParentArticleController::class,'get_article_categories']);
        Route::get('category/{catID}', [ParentArticleController::class,'category_articles']);
        Route::get('trending', [ParentArticleController::class,'get_trending_articles']);
        Route::get('latest', [ParentArticleController::class,'get_latest_articles']);
        Route::get('random-category-articles', [ParentArticleController::class,'random_category_articles']);
        Route::get('detail/{id}', [ParentArticleController::class,'detail']);
    });

    Route::group(['prefix' => 'quiz', 'middleware' => 'auth:api'], function () {
        Route::get('/banner', [QuizController::class,'banner']);
        Route::get('/categories', [QuizController::class,'categories']);
        Route::get('/categories/{id}', [QuizController::class,'categories_by_id']);
        Route::get('/popular', [QuizController::class,'popular']);
        Route::get('/most-recent', [QuizController::class,'most_recent']);
        Route::get('/view/{id}', [QuizController::class,'quiz_view']);
        Route::post('/submission', [QuizController::class,'submission']);
        
    });

    Route::get('/food-categories', [FoodController::class, 'getFoodCategories']);
    Route::get('/food-categories/{id}', [FoodController::class, 'getFoodDetails']);
    Route::get('/food-details', [FoodController::class, 'getAllFoodItemDetail']);
    Route::get('/food-details/{id}', [FoodController::class, 'getFoodItemDetail']);
});
