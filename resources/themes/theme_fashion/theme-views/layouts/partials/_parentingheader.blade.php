<style>
    @media (min-width: 768px) and (max-width: 909px) {
        .sub-nav li:nth-child(n + 8) {
            display: none;
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
        z-index: 1000;
    }

    .parenting-drpdown:hover .dropbtn:after {
        background-color: #845DC2;
        width: 100%;
        top: 22px;
    }

    .parenting-drpdown .dropbtn:after {
        background-color: transparent;
        content: "";
        width: 0;
        height: 3px;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0 auto;
        transform: translateZ(0);
        transition: width .2s ease;
    }

    li::marker {
        content: "";
    }
</style>
<style>
    .parenting-drpdown {
        position: relative;
        display: inline-block;
    }

    .parenting-drpdown a i {
        font-size: 10px;
    }

    .parenting-drpdown a {
        font-size: 12px;
        color: #000;
        text-transform: capitalize;
        font-weight: 600;
        font-family: 'Aristotelica';
    }

    .parenting-drpdown-content {
        display: none;
        position: absolute;
        background-color: #ebf4fc;
        padding: 10px;
        min-width: 160px;
        left: -10px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .parenting-drpdown:hover .parenting-drpdown-content {
        display: block;
    }

    .con {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between
    }

    .parenting-drpdown-con {
        margin: 10px 0;
    }

    .parenitng-option {
        margin: 15px 0 0 0;
    }

    .dropbtn:hover {
        color: #845dc2 !important;
    }

    li a:hover {
        color: #845dc2 !important;
    }

    .accordion {
        max-width: 400px;
        margin: 0 auto;
        /* border: 1px solid #ccc; */
        border-radius: 5px;
        overflow: hidden;
    }

    .accordion-item {
        background: transparent;
        border: none !important;
    }

    .accordion-header {
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 21px;
    }

    .accordion-item-content {
        padding: 10px 20px;
        display: none;
    }

    .accordion-item-content.open {
        display: block;
    }

    #offcanvasRight {
        background: -moz-linear-gradient(top, #ef779d 0%, #db1a4d 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ef779d), color-stop(100%, #db1a4d));
        background: -webkit-linear-gradient(top, #ef779d 0%, #db1a4d 100%);
        background: -o-linear-gradient(top, #ef779d 0%, #db1a4d 100%);
        background: -ms-linear-gradient(top, #ef779d 0%, #db1a4d 100%);
        background: linear-gradient(to bottom, #ef779d 0%, #db1a4d 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ef779d', endColorstr='#db1a4d', GradientType=0);
    }

    .offcanvas {
        width: 100% !important;
    }

    .offcanvas-body .menu li a {
        font-size: 21px !important;
        color: #fff !important;
        padding: 0;
    }
</style>
@if (isset($web_config['announcement']) && $web_config['announcement']['status'] == 1)
    <div class="offer-bar" data-bg-img="{{ theme_asset('assets/img/media/top-offer-bg.png') }}">
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
<header class="bg-base pb-0" id="header" style="background: #fff !important;">
    <div class="search-form-header d-xl-none">
        <div class="d-flex w-100 align-items-center">
            <div class="close-search search-toggle" id="hide_search_toggle">
                <i class="bi bi-x-lg"></i>
            </div>
            <form class="search-form sidebar-search-form" action="{{ route('products') }}" type="submit">
                <div class="input-group search_input_group mt-4">
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
    <div class="container">
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
        <div class="header-wrapper">
            <div class="d-lg-none d-xl-none">
                <li class="me-2 me-sm-0">
                    <a href="javascript:" class="add_child_con nav-ul_text d-flex align-items-center pe-0">
                        <img class="rounded-circle me-2" src="http://localhost/public/images/all.jpg" alt=""
                            width="30px" height="30px">
                        <div>
                            Shop for
                            <p class="heading_for_profile">All <i class="bi bi-chevron-down"></i></p>
                        </div>
                    </a>
                </li>




            </div>
            <a href="{{ route('parenting-user') }}" class="logo">
                <img loading="lazy" class="d-sm-none mobile-logo-cs"
                    src="{{ asset('public/images/bachay-parenting.png') }}" alt="{{ translate('logo') }}">
                <img loading="lazy" class="d-none d-sm-block" src="{{ asset('public/images/bachay-parenting.png') }}"
                    alt="{{ translate('logo') }}">
            </a>
            <div class="container d-none d-xl-block col-5">
                <form class="search-form m-0 p-0" action="{{ route('products') }}" type="submit">
                    <div class="input-group search_input_group">

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
                    <li>
                        <a href="{{ route('home') }}" class="nav-ul_text" style="color: #6D3CF7 !important;">
                            <img src="{{ asset('public/images/shopping.gif') }}" alt="" width="30px"
                                height="30px"> {{ translate('Shopping') }}</a>
                    </li>
                    <li>
                        <a href="#" class="nav-ul_text" style="color: #a866ed !important;">
                            <img class="align-items-center" src="http://localhost/public/images/book.gif"
                                alt="" width="22px" height="22px">
                            {{ translate('Education') }}
                        </a>
                    </li>

                    @auth('customer')
                        <li>
                            <a href="{{ route('account-tickets') }}" class="nav-ul_text">{{ translate('Support') }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('account-tickets') }}" class="nav-ul_text">{{ translate('Support') }}</a>
                        </li>
                    @endauth






                </ul>

                <ul class="header-right-icons">
                   
                    <li class="d-xl-none ">
                        <a href="javascript:" class="search-toggle">
                            <i class="bi bi-search" style="color: #000;"></i>
                        </a>
                    </li>
                    @if (session('switch_user'))
                        <?php $child = session('switch_user'); ?>
                        <li>
                            <a href="javascript:" class="rounded  nav-ul_text">
                                <img class="rounded-circle me-2"
                                    src="{{ asset('public/assets/images/customers/child/' . $child->profile_picture) }}"
                                    alt="" width="20px" height="20px">
                                {{ $child->name }}
                            </a>
                        </li>
                    @endif
                    @if (session('switch_female'))
                        <li>
                            <a href="javascript:" class="rounded  nav-ul_text">
                                <img class="rounded-circle me-2" src="{{ asset('public/images/girl.jpg') }}"
                                    alt="" width="20px" height="20px">
                                Girl
                            </a>
                        </li>
                    @endif
                    @if (session('switch_male'))
                        <li>
                            <a href="javascript:" class="rounded  nav-ul_text">
                                <img class="rounded-circle me-2" src="{{ asset('public/images/boy.jpg') }}"
                                    alt="" width="20px" height="20px">
                                Boy
                            </a>
                        </li>
                    @endif
                    @if (auth('customer')->check())
                        <li class="me-2 me-sm-0 d-none d-xl-inline-block">
                            <a href="javascript:">
                                {{-- <i class="bi bi-person d-none d-xl-inline-block nav-ul_text"
                                    style="font-size: 16px !important"></i> --}}
                                {{-- <i class="bi bi-person-circle d-xl-none nav-ul_text"
                                    style="font-size: 16px !important"></i> --}}
                                <i class="bi bi-person-fill" style="color: #000"></i>
                                <span class="mx-1 d-none d-md-block nav-ul_text">Hello,
                                    {{ auth('customer')->user()->f_name }}</span>



                                {{-- <span
                                    class="mx-1 d-none d-md-block nav-ul_text">{{ auth('customer')->user()->image }}</span> --}}
                                <i class="ms-1 text-small bi bi-chevron-down d-none d-md-block nav-ul_text"></i>
                            </a>
                            <div class="dropdown-menu __dropdown-menu">
                                <ul class="language">
                                    <li class="thisIsALinkElement" data-linkpath="{{ route('account-oder') }}">
                                        <img loading="lazy"
                                            src="{{ theme_asset('assets/img/user/shopping-bag.svg') }}"
                                            alt="{{ translate('user') }}">
                                        <span>{{ translate('my_order') }}</span>
                                    </li>
                                    <li class="thisIsALinkElement" data-linkpath="{{ route('user-profile') }}">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/user/profile.svg') }}"
                                            alt="{{ translate('user') }}">
                                        <span>{{ translate('my_profile') }}</span>
                                    </li>
                                    <li class="thisIsALinkElement"
                                        data-linkpath="{{ route('customer.auth.logout') }}">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/user/logout.svg') }}"
                                            alt="{{ translate('user') }}">
                                        <span>{{ translate('sign_Out') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="me-2 me-sm-0">
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

    <?php $parent_article_categories = \App\Models\ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])
        ->orderBy('id', 'desc')
        ->take(6)
        ->get(); ?>
    <div class="parenitng-option d-none d-xl-block"
        style="background-image: url('http://localhost/public/images/top-offer-bg.png');">
        <div class="container con">
            @foreach ($parent_article_categories as $category)
                <div class="parenting-drpdown-con">
                    <div class="parenting-drpdown">
                        <a href="{{ route('parenting.article.category', $category->id) }}"
                            class="dropbtn">{{ $category->name }} <i class="bi bi-chevron-down"
                                style="margin-left: 3px;"></i></a>
                        @if ($category->child->count() > 0)
                            <ul class="parenting-drpdown-content">
                                @forelse($category->child as $subcategory)
                                    <li><a
                                            href="{{ route('parenting.article.category', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- 
            <div class="parenting-drpdown-con">
                <div class="parenting-drpdown">
                    <a href="#" class="dropbtn">Tools <i class="bi bi-chevron-down"></i></a>
                    <ul class="parenting-drpdown-content">
                        <li><a href="#">Expert Panel</a></li>
                        <li><a href="#">Discussions</a></li>
                        <li><a href="#">Contest & Winners</a></li>
                        <li><a href="#">Groups</a></li>
                        <li><a href="#">Videos</a></li>
                        <li><a href="#">Memories</a></li>
                        <li><a href="#"> Quiz</a></li>
                        <li><a href="#">Parenting Tools</a></li>
                        <li><a href="#">Pregnancy Tools</a></li>
                    </ul>
                </div>
            </div> --}}

            {{-- <div class="parenting-drpdown-con">
                <div class="parenting-drpdown">
                    <a href="#" class="dropbtn">Baby Names</a>
                </div>
            </div> --}}
            <div class="parenting-drpdown-con">
                <div class="parenting-drpdown">
                    <a href="{{ route('Q&A') }}" class="dropbtn">Q&A</a>
                </div>
            </div>

            <div class="parenting-drpdown-con">
                <div class="parenting-drpdown">
                    <a href="{{ route('vaccination-growth-tracker') }}" class="dropbtn">Child Vaccination & Growth
                        Tracker</a>
                </div>
            </div>
            <div class="parenting-drpdown-con">
                <div class="parenting-drpdown">
                    <a href="{{ route('quiz') }}" class="dropbtn">Quiz</a>
                </div>
            </div>


            <!-- Repeat the above pattern for all other anchors -->

        </div>

    </div>
</header>
@include('theme-views.partials._add-child-mobile')

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-capitalize d-flex flex-column p-0">
        <div>
            <ul class="menu scrollY-60 p-4">
                @if (auth('customer')->check())
                    <div class="d-flex justify-content-center mb-2 pb-3 mt-auto">
                        <a href="{{ route('customer.auth.logout') }}"
                            class="btn btn-base w-100">{{ translate('logout') }}</a>
                    </div>
                @else
                    <div class="d-flex justify-content-center mb-2 pb-3 mt-auto">
                        <a href="javascript:" class="btn btn-base w-100 customer_login_register_modal">
                            {{ translate('login') }} / {{ translate('register') }}
                        </a>
                    </div>
                @endif
                <?php $parent_article_categories = \App\Models\ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])
                    ->orderBy('id', 'desc')
                    ->take(6)
                    ->get(); ?>



                @foreach ($parent_article_categories as $category)
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header text-light fw-bolder" onclick="toggleAccordion(this)">
                                <a class="text-light"
                                    href="{{ route('parenting.article.category', $category->id) }}">
                                    {{ $category->name }}
                                </a>
                                <i class="bi bi-chevron-right accordion-header-icon"></i>
                            </div>

                            <div class="accordion-item-content">
                                @if ($category->child->count() > 0)
                                    @forelse($category->child as $subcategory)
                                        <li><a
                                                href="{{ route('parenting.article.category', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                        </li>
                                    @empty
                                    @endforelse
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach




                <li>
                    <a href="{{ route('Q&A') }}" class="nav-ul_text">{{ translate('Q&A') }}</a>
                </li>
                <li>
                    <a href="{{ route('vaccination-growth-tracker') }}"
                        class="nav-ul_text">{{ translate('Child Vaccination & Growth Tracker') }}</a>
                </li>
                <li>
                    <a href="{{ route('quiz') }}" class="nav-ul_text">{{ translate('Quiz') }}</a>
                </li>
            </ul>
        </div>



    </div>
</div>

<script>
    function toggleAccordion(header) {
        const content = header.nextElementSibling;
        content.classList.toggle('open');
        const icon = header.querySelector('.accordion-header-icon');
        if (content.classList.contains('open')) {
            icon.classList.remove('bi-chevron-right');
            icon.classList.add('bi-chevron-down');
        } else {
            icon.classList.remove('bi-chevron-down');
            icon.classList.add('bi-chevron-right');
        }
    }
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
