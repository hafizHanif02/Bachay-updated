<style>
    @media (min-width: 768px) and (max-width: 909px) {
        .sub-nav li:nth-child(n + 8) {
            display: none;
        }

        .custom-gap {
            padding: 0%;
        }

        .sub-nav>li>a {
            font-size: 10px !important;
        }

        .sub-nav.sub-nav-media-query {
            padding-left: 2.714286rem !important;
            padding-right: 2.214286rem !important;
        }
    }

    @media (min-width: 910px) and (max-width: 1091px) {
        .sub-nav li:nth-child(n + 9) {
            display: none;
        }

        .sub-nav>li>a {
            font-size: 10px !important;
        }

        .sub-nav.sub-nav-media-query {
            padding-left: 7.414286rem !important;
            padding-right: 6.914286rem !important;
        }
    }

    @media (min-width: 1092px) and (max-width: 1199px) {
        .sub-nav li:nth-last-child(2) {
            display: none;
        }

        .sub-nav.sub-nav-media-query {
            padding-left: 5.3rem !important;
            padding-right: 5rem !important;
        }
    }

    @media (min-width: 1200px) and (max-width: 1399px) {
        .sub-nav.sub-nav-media-query {
            padding-left: 3.514286rem !important;
            padding-right: 4.214286rem !important;
        }
    }

    .nav-ul_text {
        color: #000 !important;
    }

    .nav-ul_text:hover {
        color: #845dc2 !important;
    }

    .heading_for_profile:hover {
        color: #845dc2 !important;
    }

    .heading_for_profile {
        margin: 0;
        color: gray;
        font-size: 10px;
        margin-top: -3px;
    }

    .all_categories {
        font-weight: 600 !important;
        background: linear-gradient(90.27deg, #845dc2 -27.96%, #f99327 -27.94%, #d55fad 28.41%, #845dc2 82.13%, #845dc2 130.57%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-family: 'Aristotelica' !important;
        font-size: 14px !important;
    }

    .seller_reg {
        color: #fff !important;
        background: #835ec1 !important;
    }

    .seller_reg:hover {
        background: #ff9670 !important;
    }
</style>
<style>
    li::marker {
        content: "";
    }

    .font-poppins {
        font-family: 'poppins' !important;
    }

    .drp-btn {
        color: #000 !important;
        font-family: 'Aristotelica' !important;
    }

    .drp-btn:hover {
        color: #845dc2 !important;
    }

    .collection-item h4 {
        font-size: 16px;
        font-weight: 700 !important;
        font-family: "poppins";
        color: #000;
    }

    .collection li a {
        font-size: 14px;
        font-weight: 500;
        font-family: "poppins";
    }

    .collection li a:hover {
        color: #845DC2;
    }

    .collection li a .color {
        font-family: "poppins";
        color: red;
        font-weight: 700 !important;
    }

    .collection li a .color:hover {
        color: #DE8E9D;
    }

    .nav-btn ul {
        list-style: none;
        padding: 0;
    }

    .nav-btn ul li a {
        text-decoration: none;
        color: inherit;
        color: #000;
    }

    .sub-nav {
        position: relative;
        cursor: default;
        z-index: 0;
        /* z-index: 1004;
        padding-left: 50px !important;
        padding-right: 50px !important; */
        padding-left: 1.7142857143rem !important;
        padding-right: 1.7142857143rem !important;
    }

    .sub-nav>li>a {
        font-family: myfont;
        position: relative;
        z-index: 510;
        /* height: 45px; */
        line-height: 20px;
        font-weight: 500;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
        font-size: 12px;
    }

    .sub-nav>li:hover {
        cursor: pointer;
    }

    .sub-nav>li:hover>i:after {
        pointer-events: none;
    }

    .sub-nav>li>div {
        position: absolute;
        display: block;
        width: 100%;
        top: 100%;
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

    .sub-nav>li:hover>div {
        opacity: 1;
        visibility: visible;
        overflow: visible;
    }

    .mega-menu-grid {
        display: flex;
        justify-content: space-between;
        height: 70vh;
        overflow-y: auto;
    }

    .mega-menu-grid>* {
        text-align: left;
        padding-bottom: 50px;
        padding-top: 0px !important;
        padding: 20px;
    }

    .collection-item {
        background-color: #fff;
        line-height: 1.5rem;
        padding: 10px 20px 10px 0;
        margin: 0;
    }

    .collection-item:hover {
        color: #845DC2;
    }

    /* .bg_mega_menu {
        background-color: #845dc2;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

    } */

    .all_cate_btn {
        background: var(--greadient-normal, linear-gradient(270deg, #d55fad 36.37%, #fc966c 72.82%, #f99327 100.48%, #ffc55d 145.17%));
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #333;
        color: #fff;
        padding: 10px 0;
        transition: top 0.5s;
        z-index: 998;
    }

    .custom-style {
        box-shadow: 0 5px 3px -3px rgba(0, 0, 0, 0.29);
        font-size: 9px;
        border-top: 1px lightgray solid;
        padding: 5px 0 0 0;
    }

    .custom-style li a {
        color: var(--title);
    }

    .custom-style li a.active {
        color: var(--base);
    }

    .custom-border {
        padding: 8px 0px;
        border-bottom: 1px solid #ddd;
    }

    .big-text {
        font-size: 30px;
        font-family: "Aristotelica";
        font-size: 20px;
        background: linear-gradient(90.27deg, #845dc2 -27.96%, #f99327 -27.94%, #d55fad 28.41%, #845dc2 82.13%, #845dc2 130.57%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<header class="bg-base pb-0" id="header" style="background: #fff !important;">
    <div class="search-form-header d-xl-none">
        <div class="d-flex w-100 align-items-center">
            <div class="close-search search-toggle" id="hide_search_toggle">
                <i class="bi bi-x-lg"></i>
            </div>
            <form class="search-form sidebar-search-form" action="{{ route('products') }}" type="submit">
                <div class="input-group search_input_group">
                    <select class="select2-init header-select2 text-capitalize" id="search_category_value_mobile"
                        name="search_category_value">
                        <option value="all">{{ translate('all_categories') }}</option>
                        @foreach ($web_config['main_categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    <input type="search" class="form-control" id="input-value-mobile" onkeyup="global_search_mobile()"
                        placeholder="{{ translate('search_for_items_or_store') }}..." name="name" autocomplete="off">

                    <button class="btn btn-base" type="submit"><i class="bi bi-search"></i></button>
                    <div
                        class="card search-card position-absolute z-99 w-100 bg-white d-none top-100 start-0 search-result-box-mobile">
                    </div>
                </div>
                <input name="data_from" value="search" hidden>
                <input name="page" value="1" hidden>
            </form>
        </div>
    </div>
    <div class="container-fluid" style="padding: 0;color: black;">
        @if (isset($web_config['announcement']) && $web_config['announcement']['status'] == 1)
            <div class="offer-bar" data-bg-img="{{ theme_asset('assets/img/media/top-offer-bg2.jpg') }}" style="margin-top: -10px; margin-bottom: 10px; width: 100%;padding: 0;height: 39px;object-fit: contain;background-size: contain;">
                <div class="d-flex py-2 gap-2 align-items-center">
                    <div class="offer-bar-close px-2">
                        <i class="bi bi-x-lg"></i>
                    </div>
                    <div class="top-offer-text flex-grow-1 d-flex justify-content-center fw-semibold text-center">
                        {{-- {{ $web_config['announcement']['announcement'] }} --}}
                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="mobile-header-top d-sm-none text-capitalize">
            <ul class="header-right-icons mb-2">
                @if ($web_config['business_mode'] == 'multi' && $web_config['seller_registration'])
                    <li>
                        <div class="d-flex">
                            <a href="{{ route('shop.apply') }}"
                                class="btn __btn-outline">{{ translate('vendor_reg') . '.' }}</a>
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
                                <li class="{{ $currency['code'] == session('currency_code') ? 'active' : '' }} currency_change_function"
                                    data-currencycode="{{ $currency['code'] }}">{{ $currency->name }}</li>
                            @endforeach
                            <span id="currency-route" data-currency-route="{{ route('currency.change') }}"></span>
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
                            @php($local = \App\Utils\Helpers::default_lang())
                            @foreach (json_decode($language['value'], true) as $key => $data)
                                @if ($data['status'] == 1)
                                    <li class="change-language" data-action="{{ route('change-language') }}"
                                        data-language-code="{{ $data['code'] }}">
                                        <img loading="lazy"
                                            src="{{ theme_asset('assets/img/flags/' . $data['code'] . '.png') }}"
                                            alt="{{ $data['name'] }}">
                                        <span>{{ ucwords($data['name']) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div> --}}
        <div class="header-wrapper container">
            <div class="d-lg-none d-xl-none">
                @if (session('switch_user'))
                    <?php $child = session('switch_user'); ?>
                    <li>
                        <a href="javascript:" class="add_child_con nav-ul_text d-flex align-items-center pe-0">
                            <img class="rounded-circle me-2"
                                src="{{ asset('public/assets/images/customers/child/' . $child->profile_picture) }}"
                                alt="" width="30px" height="30px">
                            <div>
                                Shop for
                                <p class="heading_for_profile">{{ $child->name }} <i class="bi bi-chevron-down"></i>
                                </p>
                            </div>
                        </a>
                    </li>
                @elseif(session('switch_female'))
                    <li>
                        <a href="javascript:" class="add_child_con nav-ul_text d-flex align-items-center pe-0">
                            <img class="rounded-circle me-2" src="{{ asset('public/images/girl.jpg') }}" alt=""
                                width="30px" height="30px">
                            <div>
                                Shop for
                                <p class="heading_for_profile">Girl <i class="bi bi-chevron-down"></i></p>
                            </div>
                        </a>
                    </li>
                @elseif(session('switch_male'))
                    <li>
                        <a href="javascript:" class="add_child_con nav-ul_text d-flex align-items-center pe-0">
                            <img class="rounded-circle me-2" src="{{ asset('public/images/boy.jpg') }}" alt=""
                                width="30px" height="30px">
                            <div>
                                Shop for
                                <p class="heading_for_profile">Boy <i class="bi bi-chevron-down"></i></p>
                            </div>
                        </a>
                    </li>
                @else
                    <li class="me-2 me-sm-0">
                        <a href="javascript:" class="add_child_con nav-ul_text d-flex align-items-center pe-0">
                            <img class="rounded-circle me-2" src="{{ asset('public/images/all.jpg') }}" alt=""
                                width="30px" height="30px">
                            <div>
                                Shop for
                                <p class="heading_for_profile">All <i class="bi bi-chevron-down"></i></p>
                            </div>
                        </a>
                    </li>
                @endif
            </div>
            <a href="{{ route('home') }}" class="logo">
                <img loading="lazy" class="d-sm-none mobile-logo-cs"
                    src="{{ getValidImage(path: 'storage/app/public/company/' . $web_config['mob_logo']->value, type: 'logo') }}"
                    alt="{{ translate('logo') }}">
                <img loading="lazy" class="d-none d-sm-block"
                    src="{{ getValidImage(path: 'storage/app/public/company/' . $web_config['web_logo']->value, type: 'logo') }}"
                    alt="{{ translate('logo') }}">
            </a>
            <div class="container d-none d-xl-block col-4">
                <form class="search-form m-0 p-0" action="{{ route('products') }}" type="submit">
                    <div class="input-group search_input_group">
                        {{-- <select class="select2-init" id="search_category_value_web" name="search_category_value">
                            <option value="all">{{translate('all_Categories')}}</option>
                            @foreach ($web_config['main_categories'] as $category)
                            <option value="{{ $category->id }}" {{ $category->id == request('search_category_value') ? 'selected':'' }}>{{$category['name']}}</option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="form-control" id="input-value-web" name="name"
                            value="{{ request('name') }}" placeholder="{{ translate('search_for_items_or_store') }}"
                            style="color: #000;">

                        <button class="btn btn-base bg-light border" type="submit"><i class="bi bi-search"
                                style="color: #000;"></i></button>
                        <div
                            class="card search-card position-absolute z-99 w-100 bg-white d-none top-100 start-0 search-result-box-web">
                        </div>
                    </div>
                    <input name="data_from" value="search" hidden>
                    <input name="page" value="1" hidden>
                </form>
            </div>
            <div class="menu-area text-capitalize">
                <ul class="menu me-xl-2 font-poppins">
                    {{-- SWITCH USER USER --}}
                    @if (session('switch_user'))
                        <?php $child = session('switch_user'); ?>
                        <li>
                            <a href="javascript:" class="switchuser nav-ul_text d-flex align-items-center pe-0">
                                <img class="rounded-circle me-2"
                                    src="{{ asset('public/assets/images/customers/child/' . $child->profile_picture) }}"
                                    alt="" width="30px" height="30px">
                                <div>
                                    Shop for
                                    <p class="heading_for_profile">{{ $child->name }} <i
                                            class="bi bi-chevron-down"></i></p>

                                </div>


                            </a>
                        </li>
                    @elseif(session('switch_female'))
                        <li>
                            <a href="javascript:" class="switchuser nav-ul_text d-flex align-items-center pe-0">
                                <img class="rounded-circle me-2" src="{{ asset('public/images/girl.jpg') }}"
                                    alt="" width="30px" height="30px">
                                <div>
                                    Shop for
                                    <p class="heading_for_profile">Girl <i class="bi bi-chevron-down"></i></p>

                                </div>
                            </a>
                        </li>
                    @elseif(session('switch_male'))
                        <li>
                            <a href="javascript:" class="switchuser nav-ul_text d-flex align-items-center pe-0">
                                <img class="rounded-circle me-2" src="{{ asset('public/images/boy.jpg') }}"
                                    alt="" width="30px" height="30px">
                                <div>
                                    Shop for
                                    <p class="heading_for_profile">Boy <i class="bi bi-chevron-down"></i></p>

                                </div>
                            </a>
                        </li>
                    @else
                        <li class="me-2 me-sm-0">
                            <a href="javascript:" class="switchuser nav-ul_text d-flex align-items-center pe-0">
                                <img class="rounded-circle me-2" src="{{ asset('public/images/all.jpg') }}"
                                    alt="" width="30px" height="30px">
                                <div>
                                    Shop for
                                    <p class="heading_for_profile">All <i class="bi bi-chevron-down"></i></p>

                                </div>
                            </a>
                        </li>
                    @endif

                    @auth('customer')
                        <li>
                            <a href="{{ route('account-address-add') }}" class="nav-ul_text">
                                <img src="{{ asset('public/images/location.gif') }}" alt="" width="20px"
                                    height="20px">

                                {{ translate('location') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="javascript:" class="customer_login_register_modal nav-ul_text">
                                <img src="{{ asset('public/images/location.gif') }}" alt="" width="20px"
                                    height="20px">
                                {{ translate('location') }}
                            </a>
                        </li>
                    @endauth
                    {{-- @if ($web_config['business_mode'] == 'multi')
                        <li>
                            <a href="{{ route('vendors') }}"
                                class="{{ Request::is('vendors') ? 'active' : '' }} nav-ul_text">{{ translate('shops') }}</a>
                        </li>

                        @if ($web_config['seller_registration'])
                            <li class="d-sm-none">
                                <a href="{{ route('shop.apply') }}"
                                    class="{{ Request::is('shop.apply') ? 'active' : '' }}">{{ translate('vendor_reg') . '.' }}</a>
                            </li>
                        @endif
                    @endif --}}

                    {{-- <li>
                        <a href="{{ route('home') }}" class="nav-ul_text">{{ translate('Support') }}</a>
                    </li> --}}
                    @auth('customer')
                        <li>
                            <a href="{{ route('account-tickets') }}" class="nav-ul_text">{{ translate('Support') }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('account-tickets') }}" class="nav-ul_text">{{ translate('Support') }}</a>
                        </li>
                    @endauth
                    {{-- @php($categories = \App\Utils\CategoryManager::get_categories_with_counting())
                    <li>
                        <a href="javascript:" class="nav-ul_text">{{ translate('categories') }}</a>
                        <ul class="submenu">
                            @foreach ($categories as $key => $category)
                                @if ($key <= 10)
                                    <li>
                                        <a class="py-2"
                                            href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $category['name'] }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($categories->count() > 10)
                                <li>
                                    <a href="{{ route('products') }}"
                                        class="btn-text">{{ translate('view_all') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li> --}}
                    {{-- @if ($web_config['brand_setting'])
                        <li>
                            <a href="{{ route('brands') }}"
                                class="{{ Request::is('brands') ? 'active' : '' }} nav-ul_text">{{ translate('brand') }}</a>
                        </li>
                    @endif --}}
                    {{-- <li>
                        <a href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}"
                            class="{{ request('data_from') == 'discounted' ? 'active' : '' }} nav-ul_text">
                            {{ translate('offers') }}
                            <div
                                class="offer-count flower-bg d-flex justify-content-center align-items-center offer-count-custom ">
                                {{ $web_config['total_discount_products'] < 100 ? $web_config['total_discount_products'] : '99+' }}
                            </div>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('track-order.index') }}"
                            class="nav-ul_text">{{ translate('track_order') }}</a>
                    </li>
                </ul>
                <ul class="header-right-icons">
                    <li class="d-xl-block">
                        @if (auth('customer')->check())
                            <a href="{{ route('wishlists') }}">
                                <div class="position-relative mt-1 px-8px">
                                    <i class="bi bi-heart nav-ul_text" style="font-size: 16px !important;"></i>
                                    <span
                                        class="btn-status wishlist_count_status">{{ session()->has('wish_list') ? count(session('wish_list')) : 0 }}</span>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('customer.auth.login') }}">
                                {{-- for not reloading page when clicking whishlist heart icon before login --}}
                                {{-- <a href="{{ Request::is('customer/auth/login') ? 'javascript:void(0)' : route('customer.auth.login') }}"> --}}
                                {{-- <a href="javascript:" class="customer_login_register_modal"> --}}
                                <div class="position-relative mt-1 px-8px">
                                    <i class="bi bi-heart nav-ul_text" style="font-size: 16px !important;"></i>
                                    <span class="btn-status">{{ translate('0') }}</span>
                                </div>
                            </a>
                        @endif
                    </li>
                    <li id="cart_items" class="d-xl-block">
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
                                @foreach (json_decode($language['value'], true) as $key => $data)
                                    @if ($data['status'] == 1)
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
                    <li class="d-none d-xl-none">
                        <a href="javascript:" class="search-toggle">
                            <i class="bi bi-search" style="color: #000;"></i>
                        </a>
                    </li>
                    @if (auth('customer')->check())
                        <li class="me-2 me-sm-0 d-none d-xl-block">
                            <a href="javascript:" onclick="getViewByOnclickProfile()">
                                {{-- <i class="bi bi-person d-none d-xl-inline-block nav-ul_text"
                                    style="font-size: 16px !important"></i> --}}
                                {{-- <i class="bi bi-person-circle d-xl-none nav-ul_text"
                                    style="font-size: 16px !important"></i> --}}
                                {{-- <span class="rounded-circle" style="border: 1px solid #000; !important">
                                    <img alt="#" class="rounded-circle"
                                        src="{{ 'storage/app/public/profile/' . auth('customer')->user()->image }}"
                                        width="30px" height="30px">

                                </span> --}}

                                <i class="bi bi-person-fill" style="color: #000"></i>
                                <span class="mx-1 d-none d-md-block nav-ul_text">Hello,
                                    {{ auth('customer')->user()->f_name }}</span>

                                {{-- <span
                                    class="mx-1 d-none d-md-block nav-ul_text">{{ auth('customer')->user()->image }}</span> --}}
                                <i class="ms-1 text-small bi bi-chevron-down d-none d-md-block nav-ul_text"></i>
                            </a>
                            <div class="dropdown-menu __dropdown-menu" id="header-profile-dropdown">
                                <ul class="language">
                                <li class="thisIsALinkElement" data-linkpath="{{ route('account-oder') }}" style="font-weight: bold;border-bottom: 1px solid #bebebe;">
                                        
                                        <span>{{ auth('customer')->user()->f_name }} {{ auth('customer')->user()->l_name }}</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{ route('account-oder') }}">
                                        <!-- <img loading="lazy"
                                            src="{{ theme_asset('assets/img/user/shopping-bag.svg') }}"
                                            alt="{{ translate('user') }}"> -->
                                        <span>{{ translate('my_order') }}</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{route('my-child.list')}}">
                                        
                                        <span>My Child</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{route('wishlists')}}">
                                        <!-- <img loading="lazy" src="{{ theme_asset('assets/img/user/profile.svg') }}"
                                            alt="{{ translate('user') }}"> -->
                                        <span>My Wishlist</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{ route('wallet') }}">
                                        
                                        <span>My Wallet</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{route('account-tickets')}}">
                                        
                                        <span>Support</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{route('refer-earn')}}">
                                       
                                        <span>Refer & Earn</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{route('user-coupons')}}">
                                       
                                        <span>Coupons</span>
                                    </li>
                                    <li class="thisIsALinkElement"
                                        data-linkpath="{{ route('customer.auth.logout') }}" style="border-top: 1px solid #bebebe;margin-top: 12px;">
                                        <!-- <img loading="lazy" src="{{ theme_asset('assets/img/user/logout.svg') }}"
                                            alt="{{ translate('user') }}"> -->
                                        <span>{{ translate('sign_Out') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="me-2 me-sm-0 d-none d-xl-block">
                            <a href="javascript:" class="customer_login_register_modal">
                                <i class="bi bi-person d-none d-xl-inline-block nav-ul_text"
                                    style="font-size: 16px !important;"></i>
                                <i class="bi bi-person-circle d-xl-none nav-ul_text"
                                    style="font-size: 16px !important;"></i>
                                <span
                                    class="mx-1 d-none d-md-block nav-ul_text
                                ">{{ translate('login') }}
                                    / {{ translate('register') }}</span>
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
   
    <div class="nav-btn mt-3" id="mega-menu" class="hide-on-med-and-down"
        style="background-image: url('{{ asset('public/images/top-offer-bg.png') }}');">
        <div class="bg_mega_menu">
            <ul
                class="container-xxl sub-nav sub-nav-media-query d-flex justify-content-between align-items-center mb-0">
                <li>
                    <a href="{{ route('products') }}" class="all_categories">
                        <img src="{{ asset('public/images/Union.png') }}" alt="" width="15px"
                            height="15px">
                        <span class="mt-1">Browse All
                            Categories </span>
                    </a>
                    <div class="mega-menu-container">
                        <div class="mega-menu-grid">
                            <div class="sub-nav-column">
                                <ul class="collection">
                                    <li class="collection-item">
                                        <h4>SHOP BY CATEGORY</h4>
                                    </li>
                                    <?php

                                        $allCategories = \App\Utils\Helpers::categoryList();
                                    ?>
                                    @foreach ($allCategories as $key => $category)
                                        <li>
                                            <a href="{{ route('products') }}?id={{$category->id}}&name={{urlencode($category->name)}}&data_from=category&page=1">
                                                <img src="{{ asset('public/images/category/'.$category->icon) }}">
                                                {{ $category->name }}
                                            </a>

                                        </li>
                                    @endforeach
                                    
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
                <li> <a href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}"
                        class="drp-btn active">
                        <img class="align-items-center mb-2 me-1" src="{{ asset('public/images/fire.gif') }}"
                            alt="" width="17px" height="24px"> <span style="color: #ff6b00; ">Hot
                            Deals</span>
                    </a>
                    {{-- <div class="mega-menu-container">
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
                    </div> --}}
                </li>
                {{-- <li> <a href="{{ url('/parenting') }}" class="drp-btn active"
                        style="margin-left: -15px; !important">

                        <img class="align-items-center" src="{{ asset('public/images/heartgif.gif') }}"
                            alt="" width="40px" height="40px"> <span
                            style="color: #ff6f92; margin-left: -6px;">Parenting</span>
                    </a>

                </li> --}}
                @auth('customer')
                    <li class="me-2 me-sm-0">
                        <a href="{{ url('/parenting-user') }}" class="drp-btn active"
                            style="margin-left: -15px; !important">
                            <img class="align-items-center" src="{{ asset('public/images/heartgif.gif') }}"
                                alt="" width="40px" height="40px">
                            <span style="color: #ff6f92; margin-left: -6px;">Parenting</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/parenting') }}" class="drp-btn active" style="margin-left: -15px; !important">
                            <img class="align-items-center" src="{{ asset('public/images/heartgif.gif') }}"
                                alt="" width="40px" height="40px">
                            <span style="color: #ff6f92; margin-left: -6px;">Parenting</span>
                        </a>
                    </li>
                @endauth
                <li> <a href="#" class="drp-btn active" style="margin-left: -15px; !important">

                        <img class="align-items-center" src="{{ asset('public/images/book.gif') }}" alt=""
                            width="22px" height="22px"> <span style="color: #a866ed;">Education</span>
                    </a>
                </li>
                <li><a href="{{ url('/products?id=1&data_from=category&page=1') }}" class="drp-btn">Boys Fashion</a>
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
                <li><a href="{{ url('/products?id=2&data_from=category&page=1') }}" class="drp-btn">Girls Fashion</a>
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
                <li><a href="{{ url('/products?id=4&data_from=category&page=1') }}" class="drp-btn">Baby Care</a>
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
                <li><a href="{{ url('/products?id=3&data_from=category&page=1') }}" class="drp-btn">Toys</a>
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
                <li><a href="{{ url('/articles') }}" class="drp-btn">Articles</a>
                    {{-- <div class="mega-menu-container">
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
                    </div> --}}
                </li>
                <li><a href="#" class="drp-btn">Nursing</a>

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
                @if ($web_config['business_mode'] == 'multi' && $web_config['seller_registration'])
                    <li class="me-2 me-xl-0 d-none d-sm-block">
                        <a href="{{ route('shop.apply') }}" class=" drp-btn seller_reg p-3"
                            style="color: #fff !important;">{{ translate('Sell_with_us') . '.' }}</a>
                    </li>
                @endif
                {{-- <li><a href="#" class="drp-btn bg-info pt-2 pb-2">Health & Safety</a>
                </li> --}}
            </ul>
        </div>
    </div>

    
    
    
    
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header justify-content-end pb-0">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="text-capitalize d-flex flex-column custom-gap pt-0">
        <div class="ps-3 pe-3">
            <h3 class="font-poppins fs-6 mb-1 text-center">Welcome to Bachay</h3>
            @if (auth('customer')->check())               
                <span class="text-center mb-2 mx-1 d-block d-md-none d-lg-none d-xl-none nav-ul_text">Hello,
                    {{ auth('customer')->user()->f_name }}
                    {{ auth('customer')->user()->l_name }}
                </span>
                <div class="d-flex justify-content-center mt-auto mb-2">
                    <a href="{{ route('customer.auth.logout') }}"
                        class="btn btn-base w-100">{{ translate('logout') }}</a>
                </div>
            @else
                <div class="d-flex justify-content-center mt-auto mb-2">
                    <a @if ($device = 'mobile') href="{{ route('customer.auth.login') }}"
                    @else
                     href="javascript:" @endif
                        {{-- commented below class for popup login modal --}} {{-- class="btn btn-base w-100 customer_login_register_modal"> --}} class="btn btn-base w-100">
                        {{ translate('login') }} / {{ translate('register') }}
                    </a>
                </div>
            @endif
        </div>
        <ul class="list-unstyled d-flex justify-content-around gap-3 mb-0 position-relative custom-style ps-3 pe-3">
            @if (auth('customer')->check())
                <li>
                    <a href="{{ Request::is('/user-account') || Request::is('user-account') ? 'javascript:void(0)' : route('user-account') }}"
                        class="d-flex align-items-center {{ Request::is('/user-account') || Request::is('user-account') ? 'active' : '' }} flex-column gap-1">
                        @if (Request::is('/user-account') || Request::is('user-account'))
                            <i class="bi bi bi-person-fill custom-icon"></i>
                        @else
                            <i class="bi bi bi-person custom-icon"></i>
                        @endif
                        <span>{{ translate('account') }}</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ Request::is('customer/auth/login') ? '{{-- javascript:void(0) --}}' : route('customer.auth.login') }}"
                        {{-- <a href="javascript:" --}}
                        class="d-flex align-items-center {{ Request::is('/user-account') || Request::is('user-account') ? 'active' : '' }} flex-column gap-1 ">
                        <i class="bi bi bi-person custom-icon"></i>
                        <span>{{ translate('account') }}</span>
                    </a>
                </li>
            @endif
            @if (auth('customer')->check())
                <li>
                    <a href="{{ Request::is('/account-oder') || Request::is('account-oder') ? 'javascript:void(0)' : route('account-oder') }}"
                        class="d-flex align-items-center {{ Request::is('/account-oder') || Request::is('account-oder') ? 'active' : '' }} flex-column gap-1">
                        @if (Request::is('/account-oder') || Request::is('account-oder'))
                            <i class="bi bi-box-seam-fill custom-icon"></i>
                        @else
                            <i class="bi bi-box-seam custom-icon"></i>
                        @endif
                        <span>{{ translate('order_history') }}</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ Request::is('customer/auth/login') ? '{{-- javascript:void(0) --}}' : route('customer.auth.login') }}"
                        {{-- <a href="javascript:" --}}
                        class="d-flex align-items-center {{-- customer_login_register_modal --}} {{ Request::is('/account-oder') || Request::is('account-oder') ? 'active' : '' }} flex-column gap-1">
                        <i class="bi bi-box-seam custom-icon"></i>
                        <span>{{ translate('order_history') }}</span>
                    </a>
                </li>
            @endif
            @if (auth('customer')->check())
                <li>
                    <a href="{{ Request::is('/track-order') || Request::is('track-order') ? 'javascript:void(0)' : route('track-order.index') }}"
                        class="d-flex align-items-center {{ Request::is('/track-order') || Request::is('track-order') ? 'active' : '' }} flex-column gap-1">
                        @if (Request::is('/track-order') || Request::is('track-order'))
                            <i class="bi bi-truck custom-icon"></i>
                        @else
                            <i class="bi bi-truck-flatbed custom-icon"></i>
                        @endif
                        <span>{{ translate('track_order') }}</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ Request::is('customer/auth/login') ? '{{-- javascript:void(0) --}}' : route('customer.auth.login') }}"
                        {{-- <a href="javascript:" --}}
                        class="d-flex align-items-center {{-- customer_login_register_modal --}} {{ Request::is('/track-order') || Request::is('track-order') ? 'active' : '' }} flex-column gap-1">
                        <i class="bi bi-truck custom-icon"></i>
                        <span>{{ translate('track_order') }}</span>
                    </a>
                </li>
            @endif
            @if (auth('customer')->check())
                <li>
                    <a href="{{ Request::is('/refund-policy') || Request::is('refund-policy') ? 'javascript:void(0)' : route('refund-policy') }}"
                        class="d-flex align-items-center {{ Request::is('/refund-policy') || Request::is('refund-policy') ? 'active' : '' }} flex-column gap-1">
                        @if (Request::is('/refund-policy') || Request::is('refund-policy'))
                            <i class="bi bi-circle-fill custom-icon"></i>
                        @else
                            <i class="bi bi-arrow-repeat custom-icon"></i>
                        @endif
                        <span>{{ translate('cash_refund') }}</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ Request::is('customer/auth/login') ? '{{-- javascript:void(0) --}}' : route('customer.auth.login') }}"
                        {{-- <a href="javascript:" --}}
                        class="d-flex align-items-center {{-- customer_login_register_modal --}} {{ Request::is('/refund-policy') || Request::is('refund-policy') ? 'active' : '' }} flex-column gap-1">
                        <i class="bi bi-arrow-repeat custom-icon"></i>
                        <span>{{ translate('cash_refund') }}</span>
                    </a>
                </li>
            @endif
        </ul>
        <div>
            <ul class="menu scrollY-60 ">
                <li class="custom-border">
                    <a href="{{ route('home') }}" class="ps-3 nav-ul_text">
                        <i class="bi bi-house me-3"></i>
                        {{ translate('home') }}
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript:">{{ translate('all_categories') }}</a>
                    <ul class="submenu">
                        @foreach ($categories as $key => $category)
                            @if ($key <= 10)
                                <li>
                                    <a class="py-2"
                                        href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $category['name'] }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($categories->count() > 10)
                            <li>
                                <a href="{{ route('products') }}" class="btn-text">{{ translate('view_all') }}</a>
                            </li>
                        @endif
                    </ul>
                </li> --}}
                {{-- @if ($web_config['brand_setting'])
                    <li>
                        <a href="{{ route('brands') }}">{{ translate('all_brand') }}</a>
                    </li>
                @endif --}}
                @auth('customer')
                    <li class="custom-border">
                        <a href="{{ route('account-address-add') }}" class="ps-3 nav-ul_text">
                            {{-- <img src="{{ asset('public/images/location.gif') }}" alt="" width="20px" height="20px"> --}}
                            <i class="bi bi-geo-alt me-3"></i>
                            {{ translate('location') }}
                        </a>
                    </li>
                @else
                    <li class="custom-border">
                        <a href="{{ route('account-address-add') }}" class="ps-3 nav-ul_text">
                            {{-- <img src="{{ asset('public/images/location.gif') }}" alt="" width="20px" height="20px"> --}}
                            <i class="bi bi-geo-alt me-3"></i>
                            {{ translate('location') }}
                        </a>
                    </li>
                @endauth
                {{-- <li>
                    <a class="d-flex align-items-center gap-2"
                        href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}">
                        {{ translate('offers') }}
                        <div
                            class="offer-count flower-bg d-flex justify-content-center align-items-center offer-count-custom">
                            {{ $web_config['total_discount_products'] < 100 ? $web_config['total_discount_products'] : '99+' }}
                        </div>
                    </a>
                </li> --}}
                @if ($web_config['business_mode'] == 'multi')
                    <li class="custom-border">
                        <a href="{{ route('vendors') }}"
                            class="{{ Request::is('vendors') ? 'active' : '' }} ps-3 nav-ul_text"><i
                                class="bi bi-shop-window me-3"></i>{{ translate('shops') }}</a>
                    </li>
                @endif
                {{-- @if ($web_config['business_mode'] == 'multi')
                    <li>
                        <a href="{{ route('vendors') }}">{{ translate('vendors') }}</a>
                    </li>

                    @if ($web_config['seller_registration'])
                        <li class="d-sm-none">
                            <a href="{{ route('shop.apply') }}">{{ translate('vendor_reg') . '.' }}</a>
                        </li>
                    @endif
                @endif --}}
                {{-- @auth('customer') --}}
                <li class="custom-border">
                    <a href="{{ route('articles') }}" class="ps-3 nav-ul_text">
                        <i class="bi bi-book me-3"></i>{{ translate('Articles') }}</a>
                </li>
                <li class="custom-border">
                    <a href="{{ route('account-tickets') }}" class="ps-3 nav-ul_text">
                        <i class="bi bi-headset me-3"></i>{{ translate('Support') }}</a>
                </li>
                {{-- @else
                    <li>
                        <a href="{{ route('account-tickets') }}" class="nav-ul_text">{{ translate('Support') }}</a>
                    </li>
                @endauth --}}
                @if ($web_config['brand_setting'])
                    <li class="custom-border">
                        <a href="{{ route('brands') }}"
                            class="{{ Request::is('brands') ? 'active' : '' }} ps-3 nav-ul_text"><i
                                class="bi bi-bag-check me-3"></i>{{ translate('brand') }}</a>
                    </li>
                @endif
                <li class="custom-border">
                    <a href="{{ route('track-order.index') }}" class="ps-3 nav-ul_text"><i
                            class="bi bi-boxes me-3"></i>{{ translate('track_order') }}</a>
                </li>
                <li class="mt-1 custom-border">
                    <a href="{{ route('home') }}" class="ps-3 nav-ul_text" style="display: inline-block;">
                        <img src="https://bachay.com/public/images/heartgif.gif" alt width="30px" height="30px"
                            style="margin-left: -7px; margin-top: -10px;">
                        <span class="big-text pt-1 pb-1">Bachay Parenting</span>
                        {{-- <img src="https://bachay.com/public/images/bachay-parenting.png" alt="Main Image"> --}}
                    </a>
                </li>
                <div>
                    <div class="custom-border">
                        <span class="px-3 toggleActivity fw-bold d-flex justify-content-between">My Activity
                            <div>
                                <i class="arrow-down bi bi-chevron-down"></i>
                                <i class="arrow-up bi bi-chevron-right d-none"></i>
                            </div>
                        </span>
                        <ul class="activityList">
                            <li><a href="{{ route('home') }}" class="ps-3 text-dark"><i
                                        class="bi bi-eye me-3"></i>{{ translate('Recently_viewed') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}" class="ps-3 text-dark"><i
                                        class="bi bi-heart me-3"></i>{{ translate('My_shortlist') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}" class="ps-3 text-dark"><i
                                        class="bi bi-cart me-3"></i>{{ translate(' Quick_reorder') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="custom-border">
                        <span class="px-3 toggleActivity fw-bold d-flex justify-content-between">Shop By Category
                            <div>
                                <i class="arrow-down bi bi-chevron-down"></i>
                                <i class="arrow-up bi bi-chevron-right d-none"></i>
                            </div>
                        </span>
                        <ul class="activityList">
                            <li>
                                <a href="https://bachay.com/categories/detail/Baby%20Care" class="ps-3 text-dark">
                                    <i class="bi bi-emoji-smile me-3"></i>
                                    Baby Care
                                </a>
                            </li>
                            <li>
                                <a href="https://bachay.com/categories/detail/Boys%20Fashion" class="ps-3 text-dark">
                                    <i class="bi bi-universal-access me-3"></i>
                                    Boys Fashion
                                </a>
                            </li>
                            <li>
                                <a href="https://bachay.com/categories/detail/Girls%20Fashion" class="ps-3 text-dark">
                                    <i class="bi bi-universal-access me-3"></i>
                                    Girls Fashion
                                </a>
                            </li>
                            <li>
                                <a href="https://bachay.com/categories/detail/Toys" class="ps-3 text-dark">
                                    <i class="bi bi-car-front me-3"></i>
                                    Toys
                                </a>
                            </li>
                            <li>
                                <a href="" class="ps-3 text-dark">
                                    <i class="bi bi-flower1 me-3"></i>
                                    Beauty
                                </a>
                            </li>
                            <li>
                                <a href="" class="ps-3 text-dark">
                                    <i class="bi bi-droplet me-3"></i>
                                    Diaper
                                </a>
                            </li>
                            <li>
                                <a href="" class="ps-3 text-dark">
                                    <i class="bi bi-lungs me-3"></i>
                                    Health & Safety
                                </a>
                            </li>
                            <li>
                                <a href="" class="ps-3 text-dark">
                                    <i class="bi bi-book me-3"></i>
                                    Books & School
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li class="custom-border">
                                <a href="{{ route('home') }}" class="ps-3 text-dark"><i
                                        class="bi bi-gift me-3"></i>{{ translate('Gift_certificate') }}</a>
                            </li>
                            <li class="custom-border">
                                <a href="{{ route('home') }}" class="ps-3 text-dark"><i
                                        class="bi bi-telephone me-3"></i>{{ translate('Contact_us') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}" class="ps-3 text-dark"><i
                                        class="bi bi-hammer me-3"></i>{{ translate('Policies') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </ul>
        </div>
        {{-- <div class="d-flex align-items-center gap-2 justify-content-between py-4 mt-3">
            <span class="text-dark">{{ translate('theme_mode') }}</span>
            <div class="theme-bar">
                <button class="light_button active">
                    <img loading="lazy" class="svg" src="{{ theme_asset('assets/img/icons/light.svg') }}"
                        alt="{{ translate('light_Mode') }}">
                </button>
                <button class="dark_button">
                    <img loading="lazy" class="svg" src="{{ theme_asset('assets/img/icons/dark.svg') }}"
                        alt="{{ translate('dark_Mode') }}">
                </button>
            </div>
        </div> --}}

        {{-- @if (auth('customer')->check())
            <div class="d-flex justify-content-center mb-2 pb-3 mt-auto px-4">
                <a href="{{ route('customer.auth.logout') }}"
                    class="btn btn-base w-100">{{ translate('logout') }}</a>
            </div>
        @else
            <div class="d-flex justify-content-center mb-2 pb-3 mt-auto px-4">
                <a href="javascript:" class="btn btn-base w-100 customer_login_register_modal">
                    {{ translate('login') }} / {{ translate('register') }}
                </a>
            </div>
        @endif --}}
    </div>
</div>
<script>
    let lastScrollTop = 0;
    const threshold = window.innerHeight * 0.9;

    window.addEventListener("scroll", function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        if (currentScroll > lastScrollTop) {
            // Scroll down
            if (currentScroll > threshold) {
                document.getElementById("header").style.top = "-110px";
            }
        } else {
            // Scroll up
            document.getElementById("header").style.top = "0";
        }
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    }, false);
</script>
<script>
    $(document).ready(function() {
        $(".toggleActivity").click(function() {
            // Toggle visibility of .activityList
            $(this).next(".activityList").toggle();

            // Toggle classes for the arrow icons
            $(this).find(".bi-chevron-down, .bi-chevron-right").toggleClass("d-none");
        });
    });

    
function getViewByOnclickProfile() {
    document.getElementById("header-profile-dropdown").classList.toggle("__dropdown-menu-show");
}

</script>
