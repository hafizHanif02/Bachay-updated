@extends('theme-views.layouts.parenting-header')

@push('css_or_js')
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="og:title" content="Welcome To {{ $web_config['name']->value }} Home" />
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

    <meta property="twitter:card"
        content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="twitter:title" content="Welcome To {{ $web_config['name']->value }} Home" />
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
@endpush
<style>
    .banner-section {
        background: #fff !important;
        margin: 30px 0 0 0;
    }
</style>
<style>
    .scroll-container {
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .scroll-container::-webkit-scrollbar {
        display: none;
    }

    .newCatLanding img {
        width: 122px;
        margin: 10px 0 10px 5px;
        height: 175px;
    }

    .brand-container img {

        width: 250px;
        height: 357px;
        margin: 10px 0 10px 5px;
    }

    .newArrival img {
        width: 248px;
        height: 156px;
        margin: 10px 0 10px 5px;

    }

    .parenting-blogs img {
        width: 251px;
        height: 358px;
        margin: 10px 0 10px 5px;

    }
</style>

@section('content')
<section>
        @if ($main_banner->count() > 0)
            <section class="banner-section">
                <div class="slider owl-theme owl-carousel custom-single-slider">
                    @foreach ($main_banner as $banner)
                        <div class="banner-slide">

                            <img class="banner-slide-img d-none d-lg-block d-xl-block" style="height: 400px;"
                                alt="{{ translate('banner') }}" loading="lazy"
                                src="{{ getValidImage(path: 'storage/app/public/banner/' . $banner['photo'], type: 'product') }}">

                            <img class="banner-slide-img d-lg-none d-xl-none" style="height: 400px;"
                                alt="{{ translate('banner') }}" loading="lazy"
                                src="{{ getValidImage(path: 'storage/app/public/banner/' . $banner['mobile_photo'], type: 'product') }}">

                            <!-- @if ($banner['title'] && $banner['sub_title'])
    <div class="content">
                                            <h1 class="title mb-3">{{ $banner['title'] }} <br><span class="subtxt">{{ $banner['sub_title'] }}</span> </h1>
                                            @if ($banner['button_text'])
    <div class="info">
                                                 <a href="{{ $banner['url'] ?? 'javascript:' }}" class="btn btn-base">{{ $banner['button_text'] }}</a>
                                            </div>
    @endif
                                        </div>
    @endif -->

                            <!-- <svg width="16" height="44" viewBox="0 0 16 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="shapes d-sm-none">
                                        <g filter="url(#filter0_b_3844_38351)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.987292 43.5471C2.37783 38.4513 6.40927 34.0997 10.2104 29.9969C10.7306 29.4354 11.2464 28.8785 11.7506 28.3251C12.3698 27.6454 12.9261 26.9375 13.4285 26.2154C15.7758 22.8419 15.7065 18.2693 13.2818 14.9509C12.1188 13.3593 10.7689 11.9386 9.18884 10.7511C5.58277 8.04099 1.99367 4.63569 0.853516 0.455078L0.987292 43.5471Z" fill="var(--base)"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_b_3844_38351" x="-46.9791" y="-47.3775" width="109.958" height="138.757" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feGaussianBlur in="BackgroundImageFix" stdDeviation="23.9163"/>
                                        <feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_3844_38351"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_3844_38351" result="shape"/>
                                        </filter>
                                        </defs>
                                    </svg> -->
                            @if ($main_banner->count() > 1)
                                <img src="{{ theme_asset('assets/img/arrow-icon.png') }}" class="banner-arrow d-sm-none"
                                    alt="{{ translate('banner') }}" loading="lazy">
                            @endif
                        </div>
                    @endforeach
                </div>

            </section>
        @else
            <section class="promo-page-header">
                <div class="product_blank_banner"></div>
            </section>
        @endif



</section>
    <div class="banner_full_width">
        @foreach($top_banner as $banner)
        <a href="{{ $banner->link }}">
            <img class="mb-1" src="{{ asset('public/assets/images/parent_mobile/'.$banner->image) }}" alt="" width="100%">
        </a>
        @endforeach
    </div>
    <div class="scroll-container newCatLanding ps-2">
        @foreach($scroll_one as $scroll_data)
        <a href="{{ $scroll_data->link }}">
            <img src="{{ asset('public/assets/images/parent_mobile/'.$scroll_data->image) }}" alt="">
        </a>
        @endforeach
    </div>
    <div>
        <img src="{{ asset('public/images/summer.webp') }}" alt="" width="100%">
    </div>
    <div class="scroll-container brand-container ps-2">
        @foreach($scroll_two as $scroll_data)
        <a href="{{ $scroll_data->link }}">
            <img src="{{ asset('public/assets/images/parent_mobile/'.$scroll_data->image) }}" alt="">
        </a>
        @endforeach
    </div>
    <div>
        <img src="{{ asset('public/images/special-summer.webp') }}" alt="" width="100%">
    </div>

    <div class="scroll-container newArrival ps-2">
        @foreach($scroll_three as $scroll_data)
        <a href="{{ $scroll_data->link }}">
            <img src="{{ asset('public/assets/images/parent_mobile/'.$scroll_data->image) }}" alt="">
            <p class="text-center m-0 text-secondary fw-bold"></p>
            <p class="text-center m-0 text-secondary">EXPLORE NOW</p>

        </a>
        @endforeach
    </div>
    @foreach($middle_banner as $banner)
    <div class="mt-2">
        <img src="{{ asset('public/assets/images/parent_mobile/'.$banner->image) }}" alt="" width="100%">
    </div>
    @endforeach
    <div>
        <img src="{{ asset('public/images/parenting-explore.webp') }}" alt="" width="100%">
    </div>
    <div class="scroll-container parenting-blogs ps-2">
        @foreach($scroll_four as $scroll_data)
        <a href="{{ $scroll_data->link }}">
            <img src="{{ asset('public/assets/images/parent_mobile/'.$scroll_data->image) }}" alt="">
        </a>
        @endforeach
    </div>
    @foreach($bottom_banner as $banner)
    <div>
        <img src="{{ asset('public/assets/images/parent_mobile/'.$banner->image) }}" alt="" width="100%">
    </div>
    @endforeach

@endsection
