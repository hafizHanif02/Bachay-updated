<style>
    .nav-ul_text{
        color: #000 !important;
    }
</style>
@if (isset($web_config['announcement']) && $web_config['announcement']['status']==1)
    <div class="offer-bar" data-bg-img="{{theme_asset('assets/img/media/top-offer-bg.png')}}">
        <div class="d-flex py-2 gap-2 align-items-center">
            <div class="offer-bar-close px-2">
                <i class="bi bi-x-lg"></i>
            </div>
            <div class="top-offer-text flex-grow-1 d-flex justify-content-center fw-semibold text-center">
                {{ $web_config['announcement']['announcement'] }}
            </div>
        </div>
    </div>
@endif

<header class="bg-base" style="background: #fff !important;">
    <div class="search-form-header d-xl-none">
        <div class="d-flex w-100 align-items-center">
            <div class="close-search search-toggle" id="hide_search_toggle">
                <i class="bi bi-x-lg"></i>
            </div>
            <form class="search-form sidebar-search-form" action="{{route('products')}}" type="submit">
                <div class="input-group search_input_group">
                    <select class="select2-init header-select2 text-capitalize" id="search_category_value_mobile"
                            name="search_category_value">
                        <option value="all">{{ translate('all_categories') }}</option>
                        @foreach($web_config['main_categories'] as $category)
                            <option value="{{ $category->id }}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                    <input type="search" class="form-control" id="input-value-mobile" onkeyup="global_search_mobile()"
                           placeholder="{{ translate('search_for_items_or_store') }}..." name="name" autocomplete="off">

                    <button class="btn btn-base" type="submit"><i class="bi bi-search"></i></button>
                    <div class="card search-card position-absolute z-99 w-100 bg-white d-none top-100 start-0 search-result-box-mobile"></div>
                </div>
                <input name="data_from" value="search" hidden>
                <input name="page" value="1" hidden>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="mobile-header-top d-sm-none text-capitalize">
            <ul class="header-right-icons mb-2">
                @if ($web_config['business_mode'] == 'multi' && $web_config['seller_registration'])
                    <li>
                        <div class="d-flex">
                            <a href="{{route('shop.apply')}}" class="btn __btn-outline">{{translate('vendor_reg').'.'}}</a>
                        </div>
                    </li>
                @else
                    <li></li>
                @endif
                <li>
                    <a href="javascript:">
                        <i class="">{{ session('currency_symbol') }}</i>
                        <i class="ms-1 text-small bi bi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu __dropdown-menu">
                        <ul class="currencies">
                            @foreach ($web_config['currencies'] as $key => $currency)
                                <li class="{{($currency['code'] == session('currency_code')?'active':'')}} currency_change_function"
                                    data-currencycode="{{$currency['code']}}">{{ $currency->name }}</li>
                            @endforeach
                            <span id="currency-route" data-currency-route="{{route('currency.change')}}"></span>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:">
                        <i class="bi bi-translate"></i>
                        <i class="ms-1 text-small bi bi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu __dropdown-menu">
                        <ul class="language">
                            @php( $local = \App\Utils\Helpers::default_lang())
                            @foreach(json_decode($language['value'],true) as $key =>$data)
                                @if($data['status']==1)
                                    <li class="change-language" data-action="{{route('change-language')}}" data-language-code="{{$data['code']}}">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/flags/'.$data['code'].'.png') }}"
                                             alt="{{$data['name']}}">
                                        <span>{{ ucwords($data['name']) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="header-wrapper">
            <a href="{{route('home')}}" class="logo">
                <img loading="lazy" class="d-sm-none mobile-logo-cs"
                     src="{{ getValidImage(path: "storage/app/public/company/".$web_config['mob_logo']->value, type: 'logo') }}" alt="{{ translate('logo') }}">
                <img loading="lazy" class="d-none d-sm-block"
                     src="{{ getValidImage(path: "storage/app/public/company/".$web_config['web_logo']->value, type: 'logo') }}" alt="{{ translate('logo') }}">
            </a>
            <div class="container d-none d-xl-block col-3">
                <form class="search-form m-0 p-0" action="{{route('products')}}" type="submit">
                    <div class="input-group search_input_group">
                        {{-- <select class="select2-init" id="search_category_value_web" name="search_category_value">
                            <option value="all">{{translate('all_Categories')}}</option>
                            @foreach($web_config['main_categories'] as $category)
                            <option value="{{ $category->id }}" {{ $category->id == request('search_category_value') ? 'selected':'' }}>{{$category['name']}}</option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="form-control" id="input-value-web" name="name" value="{{ request('name') }}"
                                placeholder="{{ translate('search_for_items_or_store') }}" style="color: #000;">
                
                        <button class="btn btn-base bg-light border" type="submit"><i class="bi bi-search" style="color: #000;"></i></button>
                        <div class="card search-card position-absolute z-99 w-100 bg-white d-none top-100 start-0 search-result-box-web"></div>
                    </div>
                    <input name="data_from" value="search" hidden>
                    <input name="page" value="1" hidden>
                </form>
            </div>
            <div class="menu-area text-capitalize">
                <ul class="menu me-xl-4">
                    <li>
                        <a href="{{route('home')}}"
                           class="{{ Request::is('/')?'active':'' }} nav-ul_text">{{ translate('home') }}</a>
                    </li>
                    @php($categories = \App\Utils\CategoryManager::get_categories_with_counting())
                    <li>
                        <a href="javascript:" class="nav-ul_text">{{ translate('all_categories')}}</a>
                        <ul class="submenu">
                            @foreach($categories as $key => $category)
                                @if ($key <= 10)
                                    <li>
                                        <a class="py-2"
                                           href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category['name']}}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($categories->count() > 10)
                                <li>
                                    <a href="{{route('products')}}" class="btn-text">{{ translate('view_all') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if($web_config['brand_setting'])
                        <li>
                            <a href="{{route('brands')}}"
                               class="{{ Request::is('brands')?'active':'' }} nav-ul_text">{{ translate('all_brand') }}</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('products',['data_from'=>'discounted','page'=>1])}}"
                           class="{{ request('data_from')=='discounted'?'active':'' }} nav-ul_text">
                            {{ translate('offers') }}
                            <div class="offer-count flower-bg d-flex justify-content-center align-items-center offer-count-custom ">
                                {{ ($web_config['total_discount_products'] < 100 ? $web_config['total_discount_products']:'99+') }}
                            </div>
                        </a>
                    </li>

                    @if($web_config['business_mode'] == 'multi')
                        <li>
                            <a href="{{route('vendors')}}"
                               class="{{ Request::is('vendors')?'active':'' }} nav-ul_text">{{translate('shops')}}</a>
                        </li>

                        @if ($web_config['seller_registration'])
                            <li class="d-sm-none">
                                <a href="{{route('shop.apply')}}"
                                   class="{{ Request::is('shop.apply')?'active':'' }}">{{translate('vendor_reg').'.'}}</a>
                            </li>
                        @endif
                    @endif

                </ul>

                <ul class="header-right-icons">
                    <li class="d-none d-xl-block">
                        @if(auth('customer')->check())
                            <a href="{{ route('wishlists') }}">
                                <div class="position-relative mt-1 px-8px">
                                    <i class="bi bi-heart"></i>
                                    <span class="btn-status wishlist_count_status">{{session()->has('wish_list')?count(session('wish_list')):0}}</span>
                                </div>
                            </a>
                        @else
                            <a href="javascript:" class="customer_login_register_modal">
                                <div class="position-relative mt-1 px-8px">
                                    <i class="bi bi-heart nav-ul_text"></i>
                                    <span class="btn-status">{{translate('0')}}</span>
                                </div>
                            </a>
                        @endif
                    </li>
                    <li id="cart_items" class="d-none d-xl-block">
                        @include('theme-views.layouts.partials._cart')
                    </li>
                    {{-- currency --}}
                    {{-- <li class="d-none d-sm-block">
                        <a href="javascript:">
                            <i class="">{{ session('currency_symbol') }}</i>
                            <i class="ms-1 text-small bi bi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu __dropdown-menu">
                            <ul class="currencies">
                                @foreach ($web_config['currencies'] as $key => $currency)
                                    <li class="{{($currency['code'] == session('currency_code')?'active':'')}} currency_change_function"
                                        data-currencycode="{{$currency['code']}}">{{ $currency->name }}</li>
                                @endforeach
                                <span id="currency-route" data-currency-route="{{route('currency.change')}}"></span>
                            </ul>
                        </div>
                    </li> --}}
                    {{-- translate --}}
                    {{-- <li class="d-none d-sm-block">
                        <a href="javascript:">
                            <i class="bi bi-translate"></i>
                            <i class="ms-1 text-small bi bi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu __dropdown-menu">
                            <ul class="language">
                                @php( $local = \App\Utils\Helpers::default_lang())
                                @foreach(json_decode($language['value'],true) as $key =>$data)
                                    @if($data['status']==1)
                                        <li class="change-language" data-action="{{route('change-language')}}" data-language-code="{{$data['code']}}">
                                            <img loading="lazy"
                                                 src="{{ theme_asset('assets/img/flags/'.$data['code'].'.png') }}"
                                                 alt="{{$data['name']}}">
                                            <span>{{ ucwords($data['name']) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li> --}}
                    <li class="d-xl-none">
                        <a href="javascript:" class="search-toggle">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    @if(auth('customer')->check())
                        <li class="me-2 me-sm-0">
                            <a href="javascript:">
                                <i class="bi bi-person d-none d-xl-inline-block"></i>
                                <i class="bi bi-person-circle d-xl-none"></i>
                                <span class="mx-1 d-none d-md-block">{{auth('customer')->user()->f_name}}</span>
                                <i class="ms-1 text-small bi bi-chevron-down d-none d-md-block"></i>
                            </a>
                            <div class="dropdown-menu __dropdown-menu">
                                <ul class="language">
                                    <li class="thisIsALinkElement" data-linkpath="{{route('account-oder')}}">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/user/shopping-bag.svg') }}"
                                             alt="{{ translate('user') }}">
                                        <span>{{ translate('my_order') }}</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{route('user-profile')}}">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/user/profile.svg') }}"
                                             alt="{{ translate('user') }}">
                                        <span>{{ translate('my_profile') }}</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{route('customer.auth.logout')}}">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/user/logout.svg') }}"
                                             alt="{{ translate('user') }}">
                                        <span>{{translate('sign_Out')}}</span>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="me-2 me-sm-0">
                            <a href="javascript:" class="customer_login_register_modal">
                                <i class="bi bi-person d-none d-xl-inline-block nav-ul_text"></i>
                                <i class="bi bi-person-circle d-xl-none nav-ul_text"></i>
                                <span class="mx-1 d-none d-md-block nav-ul_text
                                ">{{ translate('login') }} / {{ translate('register') }}</span>
                            </a>
                        </li>
                    @endif
                    {{-- darkMode-switcher  --}}
                    {{-- <div class="darkLight-switcher d-none d-xl-block">
                        <button type="button" title="{{ translate('Dark_Mode') }}" class="dark_button">
                            <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/dark.svg')}}"
                                 alt="{{ translate('dark_Mode') }}">
                        </button>
                        <button type="button" title="{{ translate('Light_Mode') }}" class="light_button">
                            <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/light.svg')}}"
                                 alt="{{ translate('light_Mode') }}">
                        </button>
                    </div> --}}

                    {{-- vendor reg --}}
                    {{-- @if ($web_config['business_mode'] == 'multi' && $web_config['seller_registration'])
                        <li class="me-2 me-xl-0 d-none d-sm-block">
                            <a href="{{route('shop.apply')}}" class="btn __btn-outline">{{translate('vendor_reg').'.'}}</a>
                        </li>
                    @endif --}}

                    <li class="nav-toggle d-xl-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight">
                        <span></span>
                        <span></span>
                        <span></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="nav-btn" id="mega-menu" class="hide-on-med-and-down">
    <div class="fBorder">
        <ul class="container-xxl sub-nav d-flex justify-content-between align-items-baseline pt-2 pb-2 mb-0">
            <li>
                <a href="#">
                    <button class="browse-all-cate">
                        <i class="bi bi-grid"></i> Browse All
                        Categories
                    </button>
                </a>
                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                {{-- @if (isset($home_categories))
                                    @foreach ($home_categories as $category)
                                        <li><a href="#">{{ $category->name }} <span
                                                    class="color">NEW</span></a>
                                        </li>
                                    @endforeach
                                @endif --}}
                                <li><a href="#">Sets & Suits <span class="color">NEW</span></a></li>
                                    <li><a href="#">T-shirts <span class="color">NEW</span></a></li>
                                    <li><a href="">Nightwear</a></li>
                                    <li><a href="#">Sweatshirts<span class="color">NEW</span></a></li>
                                    <li><a href="#">Jackets <span class="color">NEW</span></a></li>
                                    <li><a href="#">Sweaters<span class="color">NEW</span></a></li>
                                    <li><a href="#">Ethnic Wear<span class="color">NEW</span></a></li>
                                    <li><a href="#">Party Wear<span class="color">NEW</span></a></li>
                                    <li><a href="#">Jeans & Trousers</a></li>
                                    <li><a chref="#">Lounge & Trackpants</a></li>
                                    <li><a href="#">Diaper & Bootie Leggings</a></li>
                                    <li><a href="#">Shirts <span class="color">NEW</span></a></li>
                                    <li><a href="#">Onesies & Rompers</a></li>
                                    <li><a href="#">Athleisure & Sportswear</a></li>
                                    <li><a href="#">Thermals <span class="color">NEW</span></a></li>
                                    <li><a href="#">Inner Wear</a></li>
                                    <li><a href="#">Caps & Gloves <span class="color">NEW</span></a></li>
                                    <li><a href="#">Bath Time</a></li>
                                    <li><a href="#">Swim Wear</a></li>
                                    <li><a href="#">Rainwear</a></li>
                                    <li><a href="#">Theme Costumes</a></li>
                                    <li><a href="#">View All</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY COLLECTION</h4>
                                </li>
                                <li><a href="#">Fall For Fashion <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Bestsellers</span></a></li>
                                <li><a href="">Multi-packs</a></li>
                                <li><a href="#">Baby Essentials <span class="color">NEW</span></a>
                                </li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FASHION ACCESSORIES</h4>
                                </li>
                                <li><a href="#">Sunglasses</a></li>
                                <li><a href="#">Summer Caps <span class="color">NEW</span></a></li>
                                <li><a href="#">Watches <span class="color">NEW</span></a></li>
                                <li><a href="#">Ties, Belts & Suspenders <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Bags</a></li>
                                <li><a href="#">Kids Umbrellas</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FOOTWEAR</h4>
                                </li>
                                <li><a href="#">Casual Shoes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Sneakers & Sports Shoes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Formal & Partywear <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Booties</a></li>
                                <li><a href="#">Clogs </a></li>
                                <li><a href="#">Flip Flops</a></li>
                                <li><a href="#">Sandals</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY AGE</h4>
                                </li>
                                <li><a href="#">Preemie/Tine Preemie</a></li>
                                <li><a href="#">New Born (0-3 M)</span></a></li>
                                <li><a href="">3-6 Months</a></li>
                                <li><a href="#">6-9 Months</a></li>
                                <li><a href="#">9-12 Months</span></a></li>
                                <li><a href="#">12-18 Months</a></li>
                                <li><a href="#">18-24 Months</a></li>
                                <li><a href="#">2 to 4 Years</a></li>
                                <li><a href="#">4 to 6 Years</a></li>
                                <li><a href="#">6 to 8 Years</a></li>
                                <li><a href="#">8+ Years </a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SHOP BY PRICE</h4>
                                </li>
                                <li><a href="#">All Under 199</a></li>
                                <li><a href="#">All Under 299</a></li>
                                <li><a href="#">All Under 399</a></li>
                                <li><a href="#">All Under 499</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY BRANDS</h4>
                                </li>
                                <li><a href="#">Babyhug</a></li>
                                <li><a href="#">Babyoye</a></li>
                                <li><a href="">Kookie Kids</a></li>
                                <li><a href="#">Carter's</a></li>
                                <li><a href="#">Pine Kids</a></li>
                                <li><a href="#">Cute Walk</a></li>
                                <li><a href="#">Honeyhap</a></li>
                                <li><a href="#">OLLINGTON ST.</a></li>
                                <li><a href="#">Doodle Poodle</a></li>
                                <li><a href="#">Primo Gino</a></li>
                                <li><a href="#">Mark & Mia</a></li>
                                <li><a href="#">Bonfino</a></li>
                                <li><a href="#">Earthy Touch</a></li>
                                <li><a href="#">Arias by Lara Dutta</a></li>
                                <li><a href="#">Pine Active</a></li>
                                <li><a href="#">ToffyHouse</a></li>
                                <li><a href="#">Ed-a-mamma</a></li>
                                <li><a href="#">UCB</a></li>
                                <li><a href="#">U.S. Polo Assn. Kids</a></li>
                                <li><a href="#">Monte Carlo</a></li>
                                <li><a href="#">Gini & Jony</a></li>
                                <li><a href="#">Puma</a></li>
                                <li><a href="#">Tommy Hilfiger</a></li>
                                <li><a href="#">ADIDAS KIDS</a></li>
                                <li><a href="#">RUFF</a></li>
                                <li><a href="#">Puma</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <div class="z-depth-1 polariod">
                                <img class="object-fit-cover rounded-3"
                                    src="{{ asset('public/images/img1.1.webp') }}" alt="image 1"
                                    class="theme responsive-img" width="100%" height="100%">

                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li> <a href="#" class="drp-btn active">
                    {{-- <i class="bi bi-fire"></i> Hot Deals --}}
                    <img class="align-items-center mb-2 me-1" src="{{ asset('public/images/fire.gif') }}"
                        alt="" width="17px" height="24px"> <span>Hot Deals</span>
                </a>
                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Sets & Suits <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">T-shirts <span class="color">NEW</span></a></li>
                                <li><a href="">Nightwear</a></li>
                                <li><a href="#">Sweatshirts<span class="color">NEW</span></a></li>
                                <li><a href="#">Jackets <span class="color">NEW</span></a></li>
                                <li><a href="#">Sweaters<span class="color">NEW</span></a></li>
                                <li><a href="#">Ethnic Wear<span class="color">NEW</span></a></li>
                                <li><a href="#">Party Wear<span class="color">NEW</span></a></li>
                                <li><a href="#">Jeans & Trousers</a></li>
                                <li><a chref="#">Lounge & Trackpants</a></li>
                                <li><a href="#">Diaper & Bootie Leggings</a></li>
                                <li><a href="#">Shirts <span class="color">NEW</span></a></li>
                                <li><a href="#">Onesies & Rompers</a></li>
                                <li><a href="#">Athleisure & Sportswear</a></li>
                                <li><a href="#">Thermals <span class="color">NEW</span></a></li>
                                <li><a href="#">Inner Wear</a></li>
                                <li><a href="#">Caps & Gloves <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Bath Time</a></li>
                                <li><a href="#">Swim Wear</a></li>
                                <li><a href="#">Rainwear</a></li>
                                <li><a href="#">Theme Costumes</a></li>
                                <li><a href="#">View All</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY COLLECTION</h4>
                                </li>
                                <li><a href="#">Fall For Fashion <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Bestsellers</span></a></li>
                                <li><a href="">Multi-packs</a></li>
                                <li><a href="#">Baby Essentials <span class="color">NEW</span></a>
                                </li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FASHION ACCESSORIES</h4>
                                </li>
                                <li><a href="#">Sunglasses</a></li>
                                <li><a href="#">Summer Caps <span class="color">NEW</span></a></li>
                                <li><a href="#">Watches <span class="color">NEW</span></a></li>
                                <li><a href="#">Ties, Belts & Suspenders <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Bags</a></li>
                                <li><a href="#">Kids Umbrellas</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FOOTWEAR</h4>
                                </li>
                                <li><a href="#">Casual Shoes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Sneakers & Sports Shoes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Formal & Partywear <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Booties</a></li>
                                <li><a href="#">Clogs </a></li>
                                <li><a href="#">Flip Flops</a></li>
                                <li><a href="#">Sandals</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY AGE</h4>
                                </li>
                                <li><a href="#">Preemie/Tine Preemie</a></li>
                                <li><a href="#">New Born (0-3 M)</span></a></li>
                                <li><a href="">3-6 Months</a></li>
                                <li><a href="#">6-9 Months</a></li>
                                <li><a href="#">9-12 Months</span></a></li>
                                <li><a href="#">12-18 Months</a></li>
                                <li><a href="#">18-24 Months</a></li>
                                <li><a href="#">2 to 4 Years</a></li>
                                <li><a href="#">4 to 6 Years</a></li>
                                <li><a href="#">6 to 8 Years</a></li>
                                <li><a href="#">8+ Years </a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SHOP BY PRICE</h4>
                                </li>
                                <li><a href="#">All Under 199</a></li>
                                <li><a href="#">All Under 299</a></li>
                                <li><a href="#">All Under 399</a></li>
                                <li><a href="#">All Under 499</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY BRANDS</h4>
                                </li>
                                <li><a href="#">Babyhug</a></li>
                                <li><a href="#">Babyoye</a></li>
                                <li><a href="">Kookie Kids</a></li>
                                <li><a href="#">Carter's</a></li>
                                <li><a href="#">Pine Kids</a></li>
                                <li><a href="#">Cute Walk</a></li>
                                <li><a href="#">Honeyhap</a></li>
                                <li><a href="#">OLLINGTON ST.</a></li>
                                <li><a href="#">Doodle Poodle</a></li>
                                <li><a href="#">Primo Gino</a></li>
                                <li><a href="#">Mark & Mia</a></li>
                                <li><a href="#">Bonfino</a></li>
                                <li><a href="#">Earthy Touch</a></li>
                                <li><a href="#">Arias by Lara Dutta</a></li>
                                <li><a href="#">Pine Active</a></li>
                                <li><a href="#">ToffyHouse</a></li>
                                <li><a href="#">Ed-a-mamma</a></li>
                                <li><a href="#">UCB</a></li>
                                <li><a href="#">U.S. Polo Assn. Kids</a></li>
                                <li><a href="#">Monte Carlo</a></li>
                                <li><a href="#">Gini & Jony</a></li>
                                <li><a href="#">Puma</a></li>
                                <li><a href="#">Tommy Hilfiger</a></li>
                                <li><a href="#">ADIDAS KIDS</a></li>
                                <li><a href="#">RUFF</a></li>
                                <li><a href="#">Puma</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <div class="z-depth-1 polariod">
                                <img class="object-fit-cover rounded-3"
                                    src="{{ asset('public/images/img2.2.webp') }}" alt="image 2"
                                    class="theme responsive-img" width="100%" height="100%">

                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Girls Fashion</a>
                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Sets & Suits <span class="color">NEW</span></a></li>
                                <li><a href="#">T-shirts <span class="color">NEW</span></a></li>
                                <li><a href="#">Nightwear</a></li>
                                <li><a href="#">Sweatshirts<span class="color">NEW</span></a></li>
                                <li><a href="#">Jackets <span class="color">NEW</span></a></li>
                                <li><a href="#">Sweaters<span class="color">NEW</span></a></li>
                                <li><a href="#">Ethnic Wear<span class="color">NEW</span></a></li>
                                <li><a href="#">Party Wear<span class="color">NEW</span></a></li>
                                <li><a href="#">Jeans & Trousers</a></li>
                                <li><a href="#">Lounge & Trackpants</a></li>
                                <li><a href="#">Diaper & Bootie Leggings</a></li>
                                <li><a href="#">Shirts <span class="color">NEW</span></a></li>
                                <li><a href="#">Onesies & Rompers</a></li>
                                <li><a href="#">Athleisure & Sportswear</a></li>
                                <li><a href="#">Thermals <span class="color">NEW</span></a></li>
                                <li><a href="#">Inner Wear</a></li>
                                <li><a href="#">Caps & Gloves <span class="color">NEW</span></a></li>
                                <li><a href="#">Bath Time</a></li>
                                <li><a href="#">Swim Wear</a></li>
                                <li><a href="#">Rainwear</a></li>
                                <li><a href="#">Theme Costumes</a></li>
                                <li><a href="#">View All</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY COLLECTION</h4>
                                </li>
                                <li><a href="#">Fall For Fashion <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Bestsellers</span></a></li>
                                <li><a href="">Multi-packs</a></li>
                                <li><a href="#">Baby Essentials <span class="color">NEW</span></a>
                                </li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FASHION ACCESSORIES</h4>
                                </li>
                                <li><a href="#">Sunglasses</a></li>
                                <li><a href="#">Summer Caps <span class="color">NEW</span></a></li>
                                <li><a href="#">Watches <span class="color">NEW</span></a></li>
                                <li><a href="#">Ties, Belts & Suspenders <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Bags</a></li>
                                <li><a href="#">Kids Umbrellas</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FOOTWEAR</h4>
                                </li>
                                <li><a href="#">Casual Shoes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Sneakers & Sports Shoes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Formal & Partywear <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Booties</a></li>
                                <li><a href="#">Clogs </a></li>
                                <li><a href="#">Flip Flops</a></li>
                                <li><a href="#">Sandals</a></li>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY AGE</h4>
                                </li>
                                <li><a href="#">Preemie/Tine Preemie</a></li>
                                <li><a href="#">New Born (0-3 M)</span></a></li>
                                <li><a href="">3-6 Months</a></li>
                                <li><a href="#">6-9 Months</a></li>
                                <li><a href="#">9-12 Months</span></a></li>
                                <li><a href="#">12-18 Months</a></li>
                                <li><a href="#">18-24 Months</a></li>
                                <li><a href="#">2 to 4 Years</a></li>
                                <li><a href="#">4 to 6 Years</a></li>
                                <li><a href="#">6 to 8 Years</a></li>
                                <li><a href="#">8+ Years </a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SHOP BY PRICE</h4>
                                </li>
                                <li><a href="#">All Under 199</a></li>
                                <li><a href="#">All Under 299</a></li>
                                <li><a href="#">All Under 399</a></li>
                                <li><a href="#">All Under 499</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY BRANDS</h4>
                                </li>
                                <li><a href="#">Babyhug</a></li>
                                <li><a href="#">Kookie Kids</a></li>
                                <li><a href="">Babyoye Kids</a></li>
                                <li><a href="#">Pine Kids's</a></li>
                                <li><a href="#">Carter's</a></li>
                                <li><a href="#">Cutewalk</a></li>
                                <li><a href="#">Mark & Mia</a></li>
                                <li><a href="#">Honeyhap</a></li>
                                <li><a href="#">Hola Bonita</a></li>
                                <li><a href="#">OLLINGTON ST.</a></li>
                                <li><a href="#">Doodle Poodle</a></li>
                                <li><a href="#">Earthy Touch</a></li>
                                <li><a href="#">Primo Gino</a></li>
                                <li><a href="#">Bonfino</a></li>
                                <li><a href="#">Arias by Lara Dutta</a></li>
                                <li><a href="#">Pine Active</a></li>
                                <li><a href="#">ToffyHouse</a></li>
                                <li><a href="#">Ed-a-Mamma</a></li>
                                <li><a href="#">Puma</a></li>
                                <li><a href="#">ASICS Kids</a></li>
                                <li><a href="#">ADIDAS KIDS</a></li>
                                <li><a href="#">UCB</a></li>
                                <li><a href="#">Gini & Jony</a></li>
                                <li><a href="#">Global Desi</a></li>
                                <li><a href="#">And Girl</a></li>
                                <li><a href="#">Tommy Hilfiger</a></li>
                                <li><a href="#">NIKE</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <div class="z-depth-1 polariod">
                                <img class="object-fit-cover rounded-3"
                                    src="{{ asset('public/images/premium-b-7.webp') }}" alt="premium image"
                                    class="theme responsive-img" width="100%" height="100%">

                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Boys Fashion</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Casual Shoes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Sneakers & Sports Shoess <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Mojaris/Ethnic Footwear <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Formal & Party Wear <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Booties</a></li>
                                <li><a href="#">Bellies & Peep Toes <span class="color">NEW</span></a>
                                </li>
                                <li><a href="#">Sandals</a></li>
                                <li><a href="#">Clogs</a></li>
                                <li><a href="#">Flip Flops</a></li>
                                <li><a href="#">Winter Boots</a></li>
                                <li><a href="#">School Shoes</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY AGE</h4>
                                </li>
                                <li><a href="#">Preemie/Tine Preemie</a></li>
                                <li><a href="#">New Born (0-3 M)</span></a></li>
                                <li><a href="">3-6 Months</a></li>
                                <li><a href="#">6-9 Months</a></li>
                                <li><a href="#">9-12 Months</span></a></li>
                                <li><a href="#">12-18 Months</a></li>
                                <li><a href="#">18-24 Months</a></li>
                                <li><a href="#">2 to 4 Years</a></li>
                                <li><a href="#">4 to 6 Years</a></li>
                                <li><a href="#">6 to 8 Years</a></li>
                                <li><a href="#">8+ Years </a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>DON'T MISS</h4>
                                </li>
                                <li><a href="#">Sock Shoes</a></li>
                                <li><a href="#">Socks</a></li>
                                <li><a href="#">Stockings & Tights</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY BRANDS</h4>
                                </li>
                                <li><a href="#">Cutewalk</a></li>
                                <li><a href="#">Pinekids</a></li>
                                <li><a href="">Babyoye</a></li>
                                <li><a href="#">Puma</a></li>
                                <li><a href="#">ADIDAS KIDS</a></li>
                                <li><a href="#">Crocs</a></li>
                                <li><a href="#">Skechers</a></li>
                                <li><a href="#">Campus</a></li>
                                <li><a href="#">Kazarmax</a></li>
                                <li><a href="#">Asics Kids</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <div class="z-depth-1 polariod">
                                <img class="object-fit-cover rounded-3"
                                    src="{{ asset('public/images/premium-b-6.webp') }}" alt="premium 6 image"
                                    class="theme responsive-img" width="100%" height="100%">

                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Footwear</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Musical Toys</a></li>
                                <li><a href="#">Learning & Educational Toys</a></li>
                                <li><a href="">Soft Toys</a></li>
                                <li><a href="#">Backyard Play</a></li>
                                <li><a href="#">Play Gyms & Playmats</a></li>
                                <li><a href="#">Sports & Games</a></li>
                                <li><a href="#">Role & Pretend Play Toys</a></li>
                                <li><a href="#">Blocks & Construction Sets</a></li>
                                <li><a href="#">Stacking Toys</a></li>
                                <li><a chref="#">Kids Puzzles</a></li>
                                <li><a href="#">Baby Rattles</a></li>
                                <li><a href="#">Toys Cars Trains & Vehicles</a></li>
                                <li><a href="#">Kids Musical Instruments</a></li>
                                <li><a href="#">Dolls & Dollhouses</a></li>
                                <li><a href="#">Push & Pull Along Toys</a></li>
                                <li><a href="#">Art Crafts & Hobby Kits</a></li>
                                <li><a href="#">Board Games</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4></h4>
                                </li>
                                <li><a href="#">Action Figures & Collectibles</a></li>
                                <li><a href="#">Radio & Remote Control Toys</a></li>
                                <li><a href="">Bath Toys</a></li>
                                <li><a href="#">Toys Guns & Weapons</a></li>
                                <li><a href="#">Kids Gadgets <span class="color">NEW</span></a>
                                </li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4> RIDE-ONS & SCOOTERS</h4>
                                </li>
                                <li><a href="#">Battery Operated Ride-ons</a></li>
                                <li><a href="#">Manual Push Ride-ons</a></li>
                                <li><a href="#">Swing cars/twisters</a></li>
                                <li><a href="#">Rocking Ride Ons</a></li>
                                <li><a href="#">Tricycles</a></li>
                                <li><a href="#">Bicycles</a></li>
                                <li><a href="#">Balance Bike</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4> COMBO PACKS</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BOARD GAMES</h4>
                                </li>
                                <li><a href="#">IQ Games</a></li>
                                <li><a href="#">Ludo, Snakes & Ladders</span></a></li>
                                <li><a href="">Words, Pictures & Scrabble Games</a></li>
                                <li><a href="#">Playing Cards</a></li>
                                <li><a href="#">Life & Travel Board Games</span></a></li>
                                <li><a href="#">Animal, Birds & Marine Life Games</a></li>
                                <li><a href="#">Business/Monopoly</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BHOME PLAY ACTIVITIES</h4>
                                </li>
                                <li><a href="#">Play Dough, Sand & Moulds</a></li>
                                <li><a href="#">Coloring, Sequencing & Engraving Art</a></li>
                                <li><a href="#">Activity Kit </a></li>
                                <li><a href="#">SBuilding Construction Sets</a></li>
                                <li><a href="#">Multi Model Making Sets</a></li>
                                <li><a href="#">Kitchen Sets</a></li>
                                <li><a href="#">Play Foods</a></li>
                                <li><a href="#">Kids' Doctor Sets</a></li>
                                <li><a href="#">Piano & Keyboards</a></li>
                                <li><a href="#">Drum Sets & Percussion</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY BRANDS</h4>
                                </li>
                                <li><a href="#">Fisher Price</a></li>
                                <li><a href="#">Intellikit</a></li>
                                <li><a href="">Babyhug</a></li>
                                <li><a href="#">Intelliskills</a></li>
                                <li><a href="#">Intellibaby</a></li>
                                <li><a href="#">Fab n Funky</a></li>
                                <li><a href="#">Hotwheels</a></li>
                                <li><a href="#">Disney</a></li>
                                <li><a href="#">Barbie</a></li>
                                <li><a href="#">Giggles</a></li>
                                <li><a href="#">Lego</a></li>
                                <li><a href="#">Bonfino</a></li>
                                <li><a href="#">Pine Kids</a></li>
                                <li><a href="#">Playnation</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SHOP BY PRICE</h4>
                                </li>
                                <li><a href="#">Under 299</a></li>
                                <li><a href="#">Under 499</a></li>
                                <li><a href="#">Under 699</a></li>
                                <li><a href="#">Under 999</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <div class="z-depth-1 polariod">
                                <img class="object-fit-cover rounded-3"
                                    src="{{ asset('public/images/premium-b-3.webp') }}" alt="premium b3 image"
                                    class="theme responsive-img" width="100%" height="100%">

                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Toys</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Musical Toys</a></li>
                                <li><a href="#">Learning & Educational Toys</a></li>
                                <li><a href="">Soft Toys</a></li>
                                <li><a href="#">Backyard Play</a></li>
                                <li><a href="#">Play Gyms & Playmats</a></li>
                                <li><a href="#">Sports & Games</a></li>
                                <li><a href="#">Role & Pretend Play Toys</a></li>
                                <li><a href="#">Blocks & Construction Sets</a></li>
                                <li><a href="#">Stacking Toys</a></li>
                                <li><a chref="#">Kids Puzzles</a></li>
                                <li><a href="#">Baby Rattles</a></li>
                                <li><a href="#">Toys Cars Trains & Vehicles</a></li>
                                <li><a href="#">Kids Musical Instruments</a></li>
                                <li><a href="#">Dolls & Dollhouses</a></li>
                                <li><a href="#">Push & Pull Along Toys</a></li>
                                <li><a href="#">Art Crafts & Hobby Kits</a></li>
                                <li><a href="#">Board Games</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4></h4>
                                </li>
                                <li><a href="#">Action Figures & Collectibles</a></li>
                                <li><a href="#">Radio & Remote Control Toys</a></li>
                                <li><a href="">Bath Toys</a></li>
                                <li><a href="#">Toys Guns & Weapons</a></li>
                                <li><a href="#">Kids Gadgets <span class="color">NEW</span></a>
                                </li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4> RIDE-ONS & SCOOTERS</h4>
                                </li>
                                <li><a href="#">Battery Operated Ride-ons</a></li>
                                <li><a href="#">Manual Push Ride-ons</a></li>
                                <li><a href="#">Swing cars/twisters</a></li>
                                <li><a href="#">Rocking Ride Ons</a></li>
                                <li><a href="#">Tricycles</a></li>
                                <li><a href="#">Bicycles</a></li>
                                <li><a href="#">Balance Bike</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4> COMBO PACKS</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BOARD GAMES</h4>
                                </li>
                                <li><a href="#">IQ Games</a></li>
                                <li><a href="#">Ludo, Snakes & Ladders</span></a></li>
                                <li><a href="">Words, Pictures & Scrabble Games</a></li>
                                <li><a href="#">Playing Cards</a></li>
                                <li><a href="#">Life & Travel Board Games</span></a></li>
                                <li><a href="#">Animal, Birds & Marine Life Games</a></li>
                                <li><a href="#">Business/Monopoly</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BHOME PLAY ACTIVITIES</h4>
                                </li>
                                <li><a href="#">Play Dough, Sand & Moulds</a></li>
                                <li><a href="#">Coloring, Sequencing & Engraving Art</a></li>
                                <li><a href="#">Activity Kit </a></li>
                                <li><a href="#">SBuilding Construction Sets</a></li>
                                <li><a href="#">Multi Model Making Sets</a></li>
                                <li><a href="#">Kitchen Sets</a></li>
                                <li><a href="#">Play Foods</a></li>
                                <li><a href="#">Kids' Doctor Sets</a></li>
                                <li><a href="#">Piano & Keyboards</a></li>
                                <li><a href="#">Drum Sets & Percussion</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY BRANDS</h4>
                                </li>
                                <li><a href="#">Fisher Price</a></li>
                                <li><a href="#">Intellikit</a></li>
                                <li><a href="">Babyhug</a></li>
                                <li><a href="#">Intelliskills</a></li>
                                <li><a href="#">Intellibaby</a></li>
                                <li><a href="#">Fab n Funky</a></li>
                                <li><a href="#">Hotwheels</a></li>
                                <li><a href="#">Disney</a></li>
                                <li><a href="#">Barbie</a></li>
                                <li><a href="#">Giggles</a></li>
                                <li><a href="#">Lego</a></li>
                                <li><a href="#">Bonfino</a></li>
                                <li><a href="#">Pine Kids</a></li>
                                <li><a href="#">Playnation</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SHOP BY PRICE</h4>
                                </li>
                                <li><a href="#">Under 299</a></li>
                                <li><a href="#">Under 499</a></li>
                                <li><a href="#">Under 699</a></li>
                                <li><a href="#">Under 999</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <div class="z-depth-1 polariod">
                                <img class="object-fit-cover rounded-3"
                                    src="{{ asset('public/images/premium-b-2.webp') }}" alt="premium b2 image"
                                    class="theme responsive-img" width="100%" height="100%">

                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Entertainment</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Diaper Pants</a></li>
                                <li><a href="#">Taped Diapers</a></li>
                                <li><a href="">Baby Wipes</a></li>
                                <li><a href="#">Diaper Rash Cream</a></li>
                                <li><a href="#">Cloth Nappies & Accessories</a></li>
                                <li><a href="#">Cloth Diaper Training Pants & Inserts</a></li>
                                <li><a href="#">Bed Protectors</a></li>
                                <li><a href="#">Diaper Changing Mats</a></li>
                                <li><a href="#">Diaper Bags & Backpacks</a></li>
                                <li><a chref="#">Diaper Bins & Disposable Bags</a></li>
                                <li><a href="#">Potty Chairs & Seats</a></li>
                                <li><a href="#">Waterproof Nappies</a></li>
                                <li><a href="#">Swim Diapers</a></li>
                                <li><a href="#">Diaper Monthly Packs</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BABY SKIN CARE</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>DISPOSABLE BABY DIAPERS</h4>
                                </li>
                                <li><a href="#">Diaper Pants</a></li>
                                <li><a href="#">Taped Diapers</a></li>
                                <li><a href="">Monthly Packs</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BABY DIAPER BY SIZE</h4>
                                </li>
                                <li><a href="#">New Born/Extra Small</a></li>
                                <li><a href="#">Small</a></li>
                                <li><a href="#">Medium</a></li>
                                <li><a href="#">Large</a></li>
                                <li><a href="#">Extra Large</a></li>
                                <li><a href="#">XXL/XXXL</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BABY DIAPER BY WEIGHT</h4>
                                </li>
                                <li><a href="#">0 to 7 Kg</a></li>
                                <li><a href="#">7 to 14 Kg</a></li>
                                <li><a href="#">14 to 18 Kg</a></li>
                                <li><a href="#">18 to 25 Kg</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY WIPES</h4>
                                </li>
                                <li><a href="">String Nappies</a></li>
                                <li><a href="#">Velcro Nappies</a></li>
                                <li><a href="#">Square Nappies</span></a></li>
                                <li><a href="#">Waterproof Nappies</a></li>
                                <li><a href="#">Swim Diapers</a></li>
                                <li><a href="#">Nappy Inserts & Accessories</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>NEW BORN CHECKLIST</h4>
                                </li>
                                <li><a href="#">Pampers</a></li>
                                <li><a href="#">Babyhug</a></li>
                                <li><a href="">MamyPoko</a></li>
                                <li><a href="#">Huggies</a></li>
                                <li><a href="#">Himalaya Babycare</a></li>
                                <li><a href="#">Mother Sparsh</a></li>
                                <li><a href="#">SuperBottoms</a></li>
                            </ul>
                        </div>

                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>TOP BRANDS</h4>
                                </li>
                                <li><a href="#">Pampers</a></li>
                                <li><a href="#">Babyhug</a></li>
                                <li><a href="">MamyPoko</a></li>
                                <li><a href="#">Huggies</a></li>
                                <li><a href="#">Himalaya Babycare</a></li>
                                <li><a href="#">Mother Sparsh</a></li>
                                <li><a href="#">SuperBottoms</a></li>
                                <li><a href="#">Chicco</a></li>
                                <li><a href="#">Sebamed</a></li>
                                <li><a href="#">Charlie Banana</a></li>
                                <li><a href="#">Mee Mee</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            {{-- <div class="z-depth-1 polariod">
                                    <img src="" alt="" class="theme responsive-img">

                                </div> --}}
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Nursing</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Baby Strollers & Prams</a></li>
                                <li><a href="#">Ride-ons & Scooters</a></li>
                                <li><a href="">Nightwear</a></li>
                                <li><a href="#">Battery Operated Ride-Ons</a></li>
                                <li><a href="#">Tricycles & Bikes</a></li>
                                <li><a href="#">Baby Walkers</a></li>
                                <li><a href="#">Bouncers, Rockers & Swings</a></li>
                                <li><a href="#">High Chairs & Booster Seats</a></li>
                                <li><a href="#">Car Seats</a></li>
                                <li><a chref="#">Baby On Board Stickers</a></li>
                                <li><a href="#">Baby Carriers</a></li>
                                <li><a href="#">Baby Carrycots</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BATTERY OPERATED RIDE-ONS</h4>
                                </li>
                                <li><a href="#">Cars</a></li>
                                <li><a href="#">Bikes and Scooters/a></li>
                                <li><a href="#">ATVs</a></li>
                                <li><a href="#">Jeeps</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY STROLLERS & PRAMS</h4>
                                </li>
                                <li><a href="#">Prams</a></li>
                                <li><a href="#">Lightweight Strollers</span></a></li>
                                <li><a href="">Twin Strollers & Prams</a></li>
                                <li><a href="#">Standard Strollers<span class="color">NEW</span></a>
                                </li>
                                <div class="box"></div>
                                <li><a href="#">Travel Systems</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>CAR SEATS BY TYPE</h4>
                                </li>
                                <li><a href="#">Convertible Car Seats (Rear and Forward-facing)</a>
                                </li>
                                <li><a href="#">Rear-facing Baby Car Seats</a></li>
                                <li><a href="#">Forward-facing Child Car Seats</a></li>
                                <li><a href="#">Backless Booster Car Seats</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>CAR SEATS BY CHILD WEIGHT</h4>
                                </li>
                                <li><a href="#">Upto 9 Kgs</a></li>
                                <li><a href="#">Upto 15 Kgs</a></li>
                                <li><a href="#">Upto 22 Kgs</a></li>
                                <li><a href="#">Upto 36 Kgs</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>RIDE-ONS & SCOOTERS</h4>
                                </li>
                                <li><a href="#">Battery Operated Ride-Ons</a></li>
                                <li><a href="#">Manual Push Ride-Ons</span></a></li>
                                <li><a href="">Twister/Swing Cars</a></li>
                                <li><a href="#">Kids Scooters</a></li>
                                <li><a href="#">Rocking Ride-ons</a></li>
                                <li><a href="#">Protective Gear</a></li>
                                <li><a href="#">Skates & Skateboards</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>TRICYCLES & BIKES</h4>
                                </li>
                                <li><a href="#">Tricycles</a></li>
                                <li><a href="#">Bicycles</a></li>
                                <div class="box"></div>
                                <li><a href="#">Training / Balance Bikes</a></li>
                                <li class="collection-item">
                                    <h4>HIGH CHAIRS & BOOSTER SEATS</h4>
                                </li>
                                <li><a href="#">High Chairs</a></li>
                                <li><a href="#">Wooden High Chairs</a></li>
                                <li><a href="#">Booster Seats</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY WALKERS</h4>
                                </li>
                                <li><a href="#">Musical & Regular Walkers</a></li>
                                <li><a href="#">Activity / Push Walkers</a></li>
                                <li><a href="">Walker Cum Rockers</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>INFANT ACTIVITY TIME</h4>
                                </li>
                                <li><a href="#">Rockers</a></li>
                                <li><a href="#">Bouncers</a></li>
                                <li><a href="#">Swings</a></li>

                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>TOP BRANDS</h4>
                                </li>
                                <li><a href="#">Babyhug</a></li>
                                <li><a href="#">Fab n Funky</a></li>
                                <li><a href="">R for Rabbit</a></li>
                                <li><a href="#">Fisher Price</a></li>
                                <li><a href="#">Chicco</a></li>
                                <li><a href="#">Graco</a></li>
                                <li><a href="#">Joie</a></li>
                                <li><a href="#">Luv Lap</a></li>
                                <li><a href="#">Mee Mee</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            {{-- <div class="z-depth-1 polariod">
                                    <img src="" alt="" class="theme responsive-img">

                                </div> --}}
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Health & Safety</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Baby Food & <br>Infant Formula</a></li>
                                <li><a href="#">Feeding Bottles & Teats</a></li>
                                <li><a href="">Breast Feeding</a></li>
                                <li><a href="#">Sippers & Cupsa</li>
                                <li><a href="#">Bibs & Hankies</a></li>
                                <li><a href="#">Kids Foods & Supplements</a></li>
                                <li><a href="#">Dishes & Utensils</a></li>
                                <li><a href="#">Teethers & Pacifiers</a></li>
                                <li><a href="#">Sterilizers & Warmers</a></li>
                                <li><a chref="#">Feeding Accessories</a></li>
                                <li><a href="#">Feeding Bottle Cleaning</a></li>
                                <li><a href="#">Kitchen Appliances</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY FOOD & INFANT FORMULA</h4>
                                </li>
                                <li><a href="#">Dry Milk Powder / Formula</a></li>
                                <li><a href="#">Porridge/Cereals/Grains </a></li>
                                <li><a href="">MPuree - Fruits & Vegetables</a></li>
                                <li><a href="#">Finger Food / Snacks</a></li>
                                <li><a href="#">Add on Nutritional Mix</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLE CLEANING</h4>
                                </li>
                                <li><a href="#">Bottle & Nipple Cleaning Brushes</a></li>
                                <li><a href="#">Drying Racks</a></li>
                                <li><a href="#">Cleaning Combo Sets</a></li>
                                <li><a href="#">Bottle Tongs</a></li>
                                <li><a href="#"></a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>STERLIZERS & WARMERS</h4>
                                </li>
                                <li><a href="#">Bottle Sterilizers</a></li>
                                <li><a href="#">Bottle & Food Warmers</a></li>
                                <li><a href="#">Multipurpose Sterilizers</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BREAST FEEDING</h4>
                                </li>
                                <li><a href="#">Breast Pumps</a></li>
                                <li><a href="#">Electric Breast Pump</a></li>
                                <li><a href="">Manual Breast Pump</a></li>
                                <li><a href="#">Breast Pads</a></li>
                                <li><a href="#">Nipple Shields</span></a></li>
                                <li><a href="#">Nipple Pullers</a></li>
                                <li><a href="#">Breast Milk Storage</a></li>
                                <li><a href="#">Feeding Pillows <br> & Covers</a></li>
                                <li><a href="#">Nursing Covers & Bibs</a></li>
                                <li><a href="#">Nursing Bras</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BIBS & HANKY</h4>
                                </li>
                                <li><a href="#">Bibs</a></li>
                                <li><a href="#">Burp/Wash Clothes</a></li>
                                <li><a href="#">Hanky / Napkins</a></li>
                                <li><a href="#">Aprons</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SUPER SAVERS</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLES & ACC.</h4>
                                </li>
                                <li><a href="#">Feeding Bottles</a></li>
                                <li><a href="#">Nipples & Teats</a></li>
                                <li><a href="">Food Feeder</a></li>
                                <li><a href="#">Fruit & Food Nibbler</a></li>
                                <li><a href="#">Bottle Covers & Insulated Bags</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SIPPERS & CUPS</h4>
                                </li>
                                <li><a href="#">Spout Sippers</a></li>
                                <li><a href="#">Straw Sippers</a></li>
                                <li><a href="#">Tumblers</a></li>
                                <li><a href="#">Mugs</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>TEETHERS & PACIFIERS</h4>
                                </li>
                                <li><a href="#">Silicone Teethers</a></li>
                                <li><a href="#">Water Filled Silicone Teethers</a></li>
                                <li><a href="#">Orthodontic Pacifiers</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Wooden Teethers</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KIDS FOODS & SUPPLEMENTS</h4>
                                </li>
                                <li><a href="#">Health Drinks & Powders</a></li>
                                <li><a href="#">Breakfast & Cereals</a></li>
                                <li><a href="">Ready to Cook</a></li>
                                <li><a href="#">Dry Fruits, Nuts & Seeds</a></li>
                                <li><a href="#">Snacks & Finger Food</a></li>
                                <li><a href="#">Biscuits & Cookies</a></li>
                                <li><a href="#">Chocolates, Candies & Sweets</a></li>
                                <li><a href="#">Vitamin Gummies</a></li>
                                <li><a href="#">Spreads, Jams & Ketchup</a></li>
                                <li><a href="#">Ghee & Cooking Oils</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>DISHES & UTENSILS</h4>
                                </li>
                                <li><a href="#">Bowls, Containers & Dispensers</a></li>
                                <li><a href="#">Cutlery</a></li>
                                <li><a href="#">Feeding Sets</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Dishes</a></li>
                                <li><a href="#">Milk Powder Containers</a></li>
                                <li><a href="#">Milk Tableware</a></li>
                                <li><a href="#">Milk Drinkware</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KITCHEN APPLIANCES</h4>
                                </li>
                                <li><a href="#">High Chairs and Booster Sheets</a></li>
                                <li><a href="#">TOP BRANDS</a></li>
                                <li><a href="">Babyhug</a></li>
                                <li><a href="#">Nestle</a></li>
                                <li><a href="#">Medela</a></li>
                                <li><a href="#">Chicco</a></li>
                                <li><a href="#">Pigeon</a></li>
                                <li><a href="#">Aptamil</a></li>
                                <li><a href="#">Enfagrow</a></li>
                                <li><a href="#">Enfamil</a></li>
                                <li><a href="#">PediaSure</a></li>
                                <li><a href="#">Similac</a></li>
                                <li><a href="#">Mee Mee</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Luv Lap</a></li>
                                <li><a href="#">Early Foods</a></li>
                                <li><a href="#">timios</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            {{-- <div class="z-depth-1 polariod">
                                    <img src="" alt="" class="theme responsive-img">

                                </div> --}}
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Diapering</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Baby Food & <br>Infant Formula</a></li>
                                <li><a href="#">Feeding Bottles & Teats</a></li>
                                <li><a href="">Breast Feeding</a></li>
                                <li><a href="#">Sippers & Cupsa</li>
                                <li><a href="#">Bibs & Hankies</a></li>
                                <li><a href="#">Kids Foods & Supplements</a></li>
                                <li><a href="#">Dishes & Utensils</a></li>
                                <li><a href="#">Teethers & Pacifiers</a></li>
                                <li><a href="#">Sterilizers & Warmers</a></li>
                                <li><a chref="#">Feeding Accessories</a></li>
                                <li><a href="#">Feeding Bottle Cleaning</a></li>
                                <li><a href="#">Kitchen Appliances</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY FOOD & INFANT FORMULA</h4>
                                </li>
                                <li><a href="#">Dry Milk Powder / Formula</a></li>
                                <li><a href="#">Porridge/Cereals/Grains </a></li>
                                <li><a href="">MPuree - Fruits & Vegetables</a></li>
                                <li><a href="#">Finger Food / Snacks</a></li>
                                <li><a href="#">Add on Nutritional Mix</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLE CLEANING</h4>
                                </li>
                                <li><a href="#">Bottle & Nipple Cleaning Brushes</a></li>
                                <li><a href="#">Drying Racks</a></li>
                                <li><a href="#">Cleaning Combo Sets</a></li>
                                <li><a href="#">Bottle Tongs</a></li>
                                <li><a href="#"></a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>STERLIZERS & WARMERS</h4>
                                </li>
                                <li><a href="#">Bottle Sterilizers</a></li>
                                <li><a href="#">Bottle & Food Warmers</a></li>
                                <li><a href="#">Multipurpose Sterilizers</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BREAST FEEDING</h4>
                                </li>
                                <li><a href="#">Breast Pumps</a></li>
                                <li><a href="#">Electric Breast Pump</a></li>
                                <li><a href="">Manual Breast Pump</a></li>
                                <li><a href="#">Breast Pads</a></li>
                                <li><a href="#">Nipple Shields</span></a></li>
                                <li><a href="#">Nipple Pullers</a></li>
                                <li><a href="#">Breast Milk Storage</a></li>
                                <li><a href="#">Feeding Pillows <br> & Covers</a></li>
                                <li><a href="#">Nursing Covers & Bibs</a></li>
                                <li><a href="#">Nursing Bras</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BIBS & HANKY</h4>
                                </li>
                                <li><a href="#">Bibs</a></li>
                                <li><a href="#">Burp/Wash Clothes</a></li>
                                <li><a href="#">Hanky / Napkins</a></li>
                                <li><a href="#">Aprons</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SUPER SAVERS</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLES & ACC.</h4>
                                </li>
                                <li><a href="#">Feeding Bottles</a></li>
                                <li><a href="#">Nipples & Teats</a></li>
                                <li><a href="">Food Feeder</a></li>
                                <li><a href="#">Fruit & Food Nibbler</a></li>
                                <li><a href="#">Bottle Covers & Insulated Bags</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SIPPERS & CUPS</h4>
                                </li>
                                <li><a href="#">Spout Sippers</a></li>
                                <li><a href="#">Straw Sippers</a></li>
                                <li><a href="#">Tumblers</a></li>
                                <li><a href="#">Mugs</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>TEETHERS & PACIFIERS</h4>
                                </li>
                                <li><a href="#">Silicone Teethers</a></li>
                                <li><a href="#">Water Filled Silicone Teethers</a></li>
                                <li><a href="#">Orthodontic Pacifiers</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Wooden Teethers</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KIDS FOODS & SUPPLEMENTS</h4>
                                </li>
                                <li><a href="#">Health Drinks & Powders</a></li>
                                <li><a href="#">Breakfast & Cereals</a></li>
                                <li><a href="">Ready to Cook</a></li>
                                <li><a href="#">Dry Fruits, Nuts & Seeds</a></li>
                                <li><a href="#">Snacks & Finger Food</a></li>
                                <li><a href="#">Biscuits & Cookies</a></li>
                                <li><a href="#">Chocolates, Candies & Sweets</a></li>
                                <li><a href="#">Vitamin Gummies</a></li>
                                <li><a href="#">Spreads, Jams & Ketchup</a></li>
                                <li><a href="#">Ghee & Cooking Oils</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>DISHES & UTENSILS</h4>
                                </li>
                                <li><a href="#">Bowls, Containers & Dispensers</a></li>
                                <li><a href="#">Cutlery</a></li>
                                <li><a href="#">Feeding Sets</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Dishes</a></li>
                                <li><a href="#">Milk Powder Containers</a></li>
                                <li><a href="#">Milk Tableware</a></li>
                                <li><a href="#">Milk Drinkware</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KITCHEN APPLIANCES</h4>
                                </li>
                                <li><a href="#">High Chairs and Booster Sheets</a></li>
                                <li><a href="#">TOP BRANDS</a></li>
                                <li><a href="">Babyhug</a></li>
                                <li><a href="#">Nestle</a></li>
                                <li><a href="#">Medela</a></li>
                                <li><a href="#">Chicco</a></li>
                                <li><a href="#">Pigeon</a></li>
                                <li><a href="#">Aptamil</a></li>
                                <li><a href="#">Enfagrow</a></li>
                                <li><a href="#">Enfamil</a></li>
                                <li><a href="#">PediaSure</a></li>
                                <li><a href="#">Similac</a></li>
                                <li><a href="#">Mee Mee</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Luv Lap</a></li>
                                <li><a href="#">Early Foods</a></li>
                                <li><a href="#">timios</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            {{-- <div class="z-depth-1 polariod">
                                    <img src="" alt="" class="theme responsive-img">

                                </div> --}}
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Bath</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Baby Food & <br>Infant Formula</a></li>
                                <li><a href="#">Feeding Bottles & Teats</a></li>
                                <li><a href="">Breast Feeding</a></li>
                                <li><a href="#">Sippers & Cupsa</li>
                                <li><a href="#">Bibs & Hankies</a></li>
                                <li><a href="#">Kids Foods & Supplements</a></li>
                                <li><a href="#">Dishes & Utensils</a></li>
                                <li><a href="#">Teethers & Pacifiers</a></li>
                                <li><a href="#">Sterilizers & Warmers</a></li>
                                <li><a chref="#">Feeding Accessories</a></li>
                                <li><a href="#">Feeding Bottle Cleaning</a></li>
                                <li><a href="#">Kitchen Appliances</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY FOOD & INFANT FORMULA</h4>
                                </li>
                                <li><a href="#">Dry Milk Powder / Formula</a></li>
                                <li><a href="#">Porridge/Cereals/Grains </a></li>
                                <li><a href="">MPuree - Fruits & Vegetables</a></li>
                                <li><a href="#">Finger Food / Snacks</a></li>
                                <li><a href="#">Add on Nutritional Mix</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLE CLEANING</h4>
                                </li>
                                <li><a href="#">Bottle & Nipple Cleaning Brushes</a></li>
                                <li><a href="#">Drying Racks</a></li>
                                <li><a href="#">Cleaning Combo Sets</a></li>
                                <li><a href="#">Bottle Tongs</a></li>
                                <li><a href="#"></a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>STERLIZERS & WARMERS</h4>
                                </li>
                                <li><a href="#">Bottle Sterilizers</a></li>
                                <li><a href="#">Bottle & Food Warmers</a></li>
                                <li><a href="#">Multipurpose Sterilizers</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BREAST FEEDING</h4>
                                </li>
                                <li><a href="#">Breast Pumps</a></li>
                                <li><a href="#">Electric Breast Pump</a></li>
                                <li><a href="">Manual Breast Pump</a></li>
                                <li><a href="#">Breast Pads</a></li>
                                <li><a href="#">Nipple Shields</span></a></li>
                                <li><a href="#">Nipple Pullers</a></li>
                                <li><a href="#">Breast Milk Storage</a></li>
                                <li><a href="#">Feeding Pillows <br> & Covers</a></li>
                                <li><a href="#">Nursing Covers & Bibs</a></li>
                                <li><a href="#">Nursing Bras</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BIBS & HANKY</h4>
                                </li>
                                <li><a href="#">Bibs</a></li>
                                <li><a href="#">Burp/Wash Clothes</a></li>
                                <li><a href="#">Hanky / Napkins</a></li>
                                <li><a href="#">Aprons</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SUPER SAVERS</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLES & ACC.</h4>
                                </li>
                                <li><a href="#">Feeding Bottles</a></li>
                                <li><a href="#">Nipples & Teats</a></li>
                                <li><a href="">Food Feeder</a></li>
                                <li><a href="#">Fruit & Food Nibbler</a></li>
                                <li><a href="#">Bottle Covers & Insulated Bags</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SIPPERS & CUPS</h4>
                                </li>
                                <li><a href="#">Spout Sippers</a></li>
                                <li><a href="#">Straw Sippers</a></li>
                                <li><a href="#">Tumblers</a></li>
                                <li><a href="#">Mugs</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>TEETHERS & PACIFIERS</h4>
                                </li>
                                <li><a href="#">Silicone Teethers</a></li>
                                <li><a href="#">Water Filled Silicone Teethers</a></li>
                                <li><a href="#">Orthodontic Pacifiers</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Wooden Teethers</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KIDS FOODS & SUPPLEMENTS</h4>
                                </li>
                                <li><a href="#">Health Drinks & Powders</a></li>
                                <li><a href="#">Breakfast & Cereals</a></li>
                                <li><a href="">Ready to Cook</a></li>
                                <li><a href="#">Dry Fruits, Nuts & Seeds</a></li>
                                <li><a href="#">Snacks & Finger Food</a></li>
                                <li><a href="#">Biscuits & Cookies</a></li>
                                <li><a href="#">Chocolates, Candies & Sweets</a></li>
                                <li><a href="#">Vitamin Gummies</a></li>
                                <li><a href="#">Spreads, Jams & Ketchup</a></li>
                                <li><a href="#">Ghee & Cooking Oils</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>DISHES & UTENSILS</h4>
                                </li>
                                <li><a href="#">Bowls, Containers & Dispensers</a></li>
                                <li><a href="#">Cutlery</a></li>
                                <li><a href="#">Feeding Sets</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Dishes</a></li>
                                <li><a href="#">Milk Powder Containers</a></li>
                                <li><a href="#">Milk Tableware</a></li>
                                <li><a href="#">Milk Drinkware</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KITCHEN APPLIANCES</h4>
                                </li>
                                <li><a href="#">High Chairs and Booster Sheets</a></li>
                                <li><a href="#">TOP BRANDS</a></li>
                                <li><a href="">Babyhug</a></li>
                                <li><a href="#">Nestle</a></li>
                                <li><a href="#">Medela</a></li>
                                <li><a href="#">Chicco</a></li>
                                <li><a href="#">Pigeon</a></li>
                                <li><a href="#">Aptamil</a></li>
                                <li><a href="#">Enfagrow</a></li>
                                <li><a href="#">Enfamil</a></li>
                                <li><a href="#">PediaSure</a></li>
                                <li><a href="#">Similac</a></li>
                                <li><a href="#">Mee Mee</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Luv Lap</a></li>
                                <li><a href="#">Early Foods</a></li>
                                <li><a href="#">timios</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            {{-- <div class="z-depth-1 polariod">
                                    <img src="" alt="" class="theme responsive-img">

                                </div> --}}
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Feeding</a>

                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Baby Food & <br>Infant Formula</a></li>
                                <li><a href="#">Feeding Bottles & Teats</a></li>
                                <li><a href="">Breast Feeding</a></li>
                                <li><a href="#">Sippers & Cupsa</li>
                                <li><a href="#">Bibs & Hankies</a></li>
                                <li><a href="#">Kids Foods & Supplements</a></li>
                                <li><a href="#">Dishes & Utensils</a></li>
                                <li><a href="#">Teethers & Pacifiers</a></li>
                                <li><a href="#">Sterilizers & Warmers</a></li>
                                <li><a chref="#">Feeding Accessories</a></li>
                                <li><a href="#">Feeding Bottle Cleaning</a></li>
                                <li><a href="#">Kitchen Appliances</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY FOOD & INFANT FORMULA</h4>
                                </li>
                                <li><a href="#">Dry Milk Powder / Formula</a></li>
                                <li><a href="#">Porridge/Cereals/Grains </a></li>
                                <li><a href="">MPuree - Fruits & Vegetables</a></li>
                                <li><a href="#">Finger Food / Snacks</a></li>
                                <li><a href="#">Add on Nutritional Mix</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLE CLEANING</h4>
                                </li>
                                <li><a href="#">Bottle & Nipple Cleaning Brushes</a></li>
                                <li><a href="#">Drying Racks</a></li>
                                <li><a href="#">Cleaning Combo Sets</a></li>
                                <li><a href="#">Bottle Tongs</a></li>
                                <li><a href="#"></a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>STERLIZERS & WARMERS</h4>
                                </li>
                                <li><a href="#">Bottle Sterilizers</a></li>
                                <li><a href="#">Bottle & Food Warmers</a></li>
                                <li><a href="#">Multipurpose Sterilizers</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BREAST FEEDING</h4>
                                </li>
                                <li><a href="#">Breast Pumps</a></li>
                                <li><a href="#">Electric Breast Pump</a></li>
                                <li><a href="">Manual Breast Pump</a></li>
                                <li><a href="#">Breast Pads</a></li>
                                <li><a href="#">Nipple Shields</span></a></li>
                                <li><a href="#">Nipple Pullers</a></li>
                                <li><a href="#">Breast Milk Storage</a></li>
                                <li><a href="#">Feeding Pillows <br> & Covers</a></li>
                                <li><a href="#">Nursing Covers & Bibs</a></li>
                                <li><a href="#">Nursing Bras</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BIBS & HANKY</h4>
                                </li>
                                <li><a href="#">Bibs</a></li>
                                <li><a href="#">Burp/Wash Clothes</a></li>
                                <li><a href="#">Hanky / Napkins</a></li>
                                <li><a href="#">Aprons</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SUPER SAVERS</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLES & ACC.</h4>
                                </li>
                                <li><a href="#">Feeding Bottles</a></li>
                                <li><a href="#">Nipples & Teats</a></li>
                                <li><a href="">Food Feeder</a></li>
                                <li><a href="#">Fruit & Food Nibbler</a></li>
                                <li><a href="#">Bottle Covers & Insulated Bags</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SIPPERS & CUPS</h4>
                                </li>
                                <li><a href="#">Spout Sippers</a></li>
                                <li><a href="#">Straw Sippers</a></li>
                                <li><a href="#">Tumblers</a></li>
                                <li><a href="#">Mugs</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>TEETHERS & PACIFIERS</h4>
                                </li>
                                <li><a href="#">Silicone Teethers</a></li>
                                <li><a href="#">Water Filled Silicone Teethers</a></li>
                                <li><a href="#">Orthodontic Pacifiers</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Wooden Teethers</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KIDS FOODS & SUPPLEMENTS</h4>
                                </li>
                                <li><a href="#">Health Drinks & Powders</a></li>
                                <li><a href="#">Breakfast & Cereals</a></li>
                                <li><a href="">Ready to Cook</a></li>
                                <li><a href="#">Dry Fruits, Nuts & Seeds</a></li>
                                <li><a href="#">Snacks & Finger Food</a></li>
                                <li><a href="#">Biscuits & Cookies</a></li>
                                <li><a href="#">Chocolates, Candies & Sweets</a></li>
                                <li><a href="#">Vitamin Gummies</a></li>
                                <li><a href="#">Spreads, Jams & Ketchup</a></li>
                                <li><a href="#">Ghee & Cooking Oils</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>DISHES & UTENSILS</h4>
                                </li>
                                <li><a href="#">Bowls, Containers & Dispensers</a></li>
                                <li><a href="#">Cutlery</a></li>
                                <li><a href="#">Feeding Sets</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Dishes</a></li>
                                <li><a href="#">Milk Powder Containers</a></li>
                                <li><a href="#">Milk Tableware</a></li>
                                <li><a href="#">Milk Drinkware</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KITCHEN APPLIANCES</h4>
                                </li>
                                <li><a href="#">High Chairs and Booster Sheets</a></li>
                                <li><a href="#">TOP BRANDS</a></li>
                                <li><a href="">Babyhug</a></li>
                                <li><a href="#">Nestle</a></li>
                                <li><a href="#">Medela</a></li>
                                <li><a href="#">Chicco</a></li>
                                <li><a href="#">Pigeon</a></li>
                                <li><a href="#">Aptamil</a></li>
                                <li><a href="#">Enfagrow</a></li>
                                <li><a href="#">Enfamil</a></li>
                                <li><a href="#">PediaSure</a></li>
                                <li><a href="#">Similac</a></li>
                                <li><a href="#">Mee Mee</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Luv Lap</a></li>
                                <li><a href="#">Early Foods</a></li>
                                <li><a href="#">timios</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            {{-- <div class="z-depth-1 polariod">
                                    <img src="" alt="" class="theme responsive-img">

                                </div> --}}
                        </div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="drp-btn">Health</a>
                <div class="mega-menu-container">
                    <div class="mega-menu-grid">
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>SHOP BY CATEGORY</h4>
                                </li>
                                <li><a href="#">Baby Food & <br>Infant Formula</a></li>
                                <li><a href="#">Feeding Bottles & Teats</a></li>
                                <li><a href="">Breast Feeding</a></li>
                                <li><a href="#">Sippers & Cupsa</li>
                                <li><a href="#">Bibs & Hankies</a></li>
                                <li><a href="#">Kids Foods & Supplements</a></li>
                                <li><a href="#">Dishes & Utensils</a></li>
                                <li><a href="#">Teethers & Pacifiers</a></li>
                                <li><a href="#">Sterilizers & Warmers</a></li>
                                <li><a chref="#">Feeding Accessories</a></li>
                                <li><a href="#">Feeding Bottle Cleaning</a></li>
                                <li><a href="#">Kitchen Appliances</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BABY FOOD & INFANT FORMULA</h4>
                                </li>
                                <li><a href="#">Dry Milk Powder / Formula</a></li>
                                <li><a href="#">Porridge/Cereals/Grains </a></li>
                                <li><a href="">MPuree - Fruits & Vegetables</a></li>
                                <li><a href="#">Finger Food / Snacks</a></li>
                                <li><a href="#">Add on Nutritional Mix</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLE CLEANING</h4>
                                </li>
                                <li><a href="#">Bottle & Nipple Cleaning Brushes</a></li>
                                <li><a href="#">Drying Racks</a></li>
                                <li><a href="#">Cleaning Combo Sets</a></li>
                                <li><a href="#">Bottle Tongs</a></li>
                                <li><a href="#"></a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>STERLIZERS & WARMERS</h4>
                                </li>
                                <li><a href="#">Bottle Sterilizers</a></li>
                                <li><a href="#">Bottle & Food Warmers</a></li>
                                <li><a href="#">Multipurpose Sterilizers</a></li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>BREAST FEEDING</h4>
                                </li>
                                <li><a href="#">Breast Pumps</a></li>
                                <li><a href="#">Electric Breast Pump</a></li>
                                <li><a href="">Manual Breast Pump</a></li>
                                <li><a href="#">Breast Pads</a></li>
                                <li><a href="#">Nipple Shields</span></a></li>
                                <li><a href="#">Nipple Pullers</a></li>
                                <li><a href="#">Breast Milk Storage</a></li>
                                <li><a href="#">Feeding Pillows <br> & Covers</a></li>
                                <li><a href="#">Nursing Covers & Bibs</a></li>
                                <li><a href="#">Nursing Bras</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>BIBS & HANKY</h4>
                                </li>
                                <li><a href="#">Bibs</a></li>
                                <li><a href="#">Burp/Wash Clothes</a></li>
                                <li><a href="#">Hanky / Napkins</a></li>
                                <li><a href="#">Aprons</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SUPER SAVERS</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>FEEDING BOTTLES & ACC.</h4>
                                </li>
                                <li><a href="#">Feeding Bottles</a></li>
                                <li><a href="#">Nipples & Teats</a></li>
                                <li><a href="">Food Feeder</a></li>
                                <li><a href="#">Fruit & Food Nibbler</a></li>
                                <li><a href="#">Bottle Covers & Insulated Bags</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>SIPPERS & CUPS</h4>
                                </li>
                                <li><a href="#">Spout Sippers</a></li>
                                <li><a href="#">Straw Sippers</a></li>
                                <li><a href="#">Tumblers</a></li>
                                <li><a href="#">Mugs</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>TEETHERS & PACIFIERS</h4>
                                </li>
                                <li><a href="#">Silicone Teethers</a></li>
                                <li><a href="#">Water Filled Silicone Teethers</a></li>
                                <li><a href="#">Orthodontic Pacifiers</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Wooden Teethers</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KIDS FOODS & SUPPLEMENTS</h4>
                                </li>
                                <li><a href="#">Health Drinks & Powders</a></li>
                                <li><a href="#">Breakfast & Cereals</a></li>
                                <li><a href="">Ready to Cook</a></li>
                                <li><a href="#">Dry Fruits, Nuts & Seeds</a></li>
                                <li><a href="#">Snacks & Finger Food</a></li>
                                <li><a href="#">Biscuits & Cookies</a></li>
                                <li><a href="#">Chocolates, Candies & Sweets</a></li>
                                <li><a href="#">Vitamin Gummies</a></li>
                                <li><a href="#">Spreads, Jams & Ketchup</a></li>
                                <li><a href="#">Ghee & Cooking Oils</a></li>
                                <div class="box"></div>
                                <li class="collection-item">
                                    <h4>DISHES & UTENSILS</h4>
                                </li>
                                <li><a href="#">Bowls, Containers & Dispensers</a></li>
                                <li><a href="#">Cutlery</a></li>
                                <li><a href="#">Feeding Sets</a></li>
                                <li><a href="#">Pacifiers</a></li>
                                <li><a href="#">Dishes</a></li>
                                <li><a href="#">Milk Powder Containers</a></li>
                                <li><a href="#">Milk Tableware</a></li>
                                <li><a href="#">Milk Drinkware</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            <ul class="collection">
                                <li class="collection-item">
                                    <h4>KITCHEN APPLIANCES</h4>
                                </li>
                                <li><a href="#">High Chairs and Booster Sheets</a></li>
                                <li><a href="#">TOP BRANDS</a></li>
                                <li><a href="">Babyhug</a></li>
                                <li><a href="#">Nestle</a></li>
                                <li><a href="#">Medela</a></li>
                                <li><a href="#">Chicco</a></li>
                                <li><a href="#">Pigeon</a></li>
                                <li><a href="#">Aptamil</a></li>
                                <li><a href="#">Enfagrow</a></li>
                                <li><a href="#">Enfamil</a></li>
                                <li><a href="#">PediaSure</a></li>
                                <li><a href="#">Similac</a></li>
                                <li><a href="#">Mee Mee</a></li>
                                <li><a href="#">Rattle Teethers</a></li>
                                <li><a href="#">Luv Lap</a></li>
                                <li><a href="#">Early Foods</a></li>
                                <li><a href="#">timios</a></li>
                                <div class="box"></div>
                            </ul>
                        </div>
                        <div class="sub-nav-column">
                            {{-- <div class="z-depth-1 polariod">
                                    <img src="" alt="" class="theme responsive-img">

                                </div> --}}
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-capitalize d-flex flex-column">
        <div>
            <ul class="menu scrollY-60 ">
                <li>
                    <a href="{{route('home')}}">{{ translate('home') }}</a>
                </li>
                <li>
                    <a href="javascript:">{{ translate('all_categories') }}</a>
                    <ul class="submenu">
                        @foreach($categories as $key => $category)
                            @if ($key <= 10)
                                <li>
                                    <a class="py-2"
                                       href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category['name']}}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($categories->count() > 10)
                            <li>
                                <a href="{{route('products')}}" class="btn-text">{{ translate('view_all') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if($web_config['brand_setting'])
                    <li>
                        <a href="{{route('brands')}}">{{ translate('all_brand') }}</a>
                    </li>
                @endif
                <li>
                    <a class="d-flex align-items-center gap-2"
                       href="{{route('products',['data_from'=>'discounted','page'=>1])}}">
                        {{ translate('offers') }}
                        <div class="offer-count flower-bg d-flex justify-content-center align-items-center offer-count-custom">
                            {{ ($web_config['total_discount_products'] < 100 ? $web_config['total_discount_products']:'99+') }}
                        </div>
                    </a>
                </li>

                @if($web_config['business_mode'] == 'multi')
                    <li>
                        <a href="{{route('vendors')}}">{{translate('vendors')}}</a>
                    </li>

                    @if ($web_config['seller_registration'])
                        <li class="d-sm-none">
                            <a href="{{route('shop.apply')}}">{{translate('vendor_reg').'.'}}</a>
                        </li>
                    @endif
                @endif

            </ul>
        </div>

        <div class="d-flex align-items-center gap-2 justify-content-between py-4 mt-3">
            <span class="text-dark">{{ translate('theme_mode') }}</span>
            <div class="theme-bar">
                <button class="light_button active">
                    <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/light.svg')}}"
                         alt="{{ translate('light_Mode') }}">
                </button>
                <button class="dark_button">
                    <img loading="lazy" class="svg" src="{{theme_asset('assets/img/icons/dark.svg')}}" alt="{{ translate('dark_Mode') }}">
                </button>
            </div>
        </div>

        @if(auth('customer')->check())
            <div class="d-flex justify-content-center mb-2 pb-3 mt-auto px-4">
                <a href="{{route('customer.auth.logout')}}" class="btn btn-base w-100">{{ translate('logout') }}</a>
            </div>
        @else
            <div class="d-flex justify-content-center mb-2 pb-3 mt-auto px-4">
                <a href="javascript:" class="btn btn-base w-100 customer_login_register_modal">
                    {{ translate('login') }} / {{ translate('register') }}
                </a>
            </div>
        @endif
    </div>
</div>
<style>
    .collection-item h4 {
    font-size: 16px;
    font-weight: 700 !important;
    font-family: "poppins";
}
.collection li a {
    font-size: 14px;
    font-weight: 500;
    font-family: "poppins";
}
.collection li a:hover{
   color: #845DC2;
}
.collection li a .color {
    font-family: "poppins";
    color: red;
    font-weight: 700 !important;
}
.collection li a .color:hover{
    color: #DE8E9D;
}
.borderline {
    border-top: 2px solid lightgrey;
    border-bottom: 2px solid lightgrey;
    padding: 10px;
    display: flex;
    justify-content: space-between;
}

/* Optional: Style for the buttons inside .sub-btn */
/* .collection button {
    border: none;
    background-color: transparent;
    cursor: pointer;
} */

.nav-btn ul {
    list-style: none;
    padding: 0;
}

.nav-btn ul li a {
    text-decoration: none;
    color: inherit;
}
.sub-nav {
    position: relative;
    cursor: default;
    z-index: 1004;
    padding-left: 50px !important;
    padding-right: 50px !important;
}
.sub-nav > li > a {
    font-family: myfont;
    position: relative;
    z-index: 510;
    height: 45px;
    line-height: 20px;
    font-weight: 500;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
    font-size: 16px;
}
.NewSeasonBorder {
    transition: margin-top 0.3s ease;
  }
  .NewSeasonBorder:hover {
        margin-top: -10px;
  }
/* .sub-card {
    border: 1px solid transparent;
    transition: border 0.5s ease;
} */
.sub-card:hover {
    /* border: 1px solid #dbdcd4; */
    box-shadow: 0 0 4px 1px #aaa;
}

.sub-nav > li:hover {
    cursor: pointer;
}
.sub-nav > li:hover > i:after {
    pointer-events: none;
}
.sub-nav > li > div {
    position: absolute;
    display: block;
    width: 100%;
    top: 62px;
    left: 0;
    visibility: hidden;
    overflow-y: auto;
    opacity: 0;
    background: #ffffff;
    border-radius: 0 0 3px 3px;
    -webkit-transition: all 0.3s ease 0.15s;
    -o-transition: all 0.3s ease 0.15s;
    transition: all 0.3s ease 0.15s;
    z-index: 1005;
}
.radio-container input[type="radio"] {
    height: 18px;
    width: 18px;
    vertical-align: middle;
    padding: 0;
    border: 2px solid #fff;
}

.sub-nav > li:hover > div {
    opacity: 1;
    visibility: visible;
    overflow: visible;
}
.mega-menu-grid {
    display: flex;
    justify-content: space-between;
    height: 80vh;
    overflow-y: auto;
}
.mega-menu-grid > * {
    text-align: left;
    padding-bottom: 50px;
    padding: 20px;
}
.collection-item {
    background-color: #fff;
    line-height: 1.5rem;
    padding: 10px 20px 10px 0;
    margin: 0;
}


    .fBorder {
        border-bottom: 1px solid transparent;
        border-top: 1px solid transparent;
        border-image: linear-gradient(270deg,
                #845dc2 -0.09%,
                #d55fad 36.37%,
                #fc966c 72.82%,
                #f99327 100.48%,
                #ffc55d 145.17%);
        border-image-slice: 1;
    }
</style>