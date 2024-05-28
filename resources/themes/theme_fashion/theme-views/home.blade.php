@extends('theme-views.layouts.app')

@section('title', $web_config['name']->value.' '.translate('online_shopping').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@push('css_or_js')
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins' />
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
@endpush

@section('content')

{{-- @include('theme-views.layouts.partials._polls') --}}
@include('theme-views.partials._add-child-mobile')
@include('theme-views.partials._custom-page')

    @include('theme-views.partials._banner-section')

    <div class="container d-none d-xl-block">
        @include('theme-views.layouts.partials._search-form-partials')
    </div>

    @if ($categories->count() > 0)
        @include('theme-views.partials._categories')
    @endif

    @if ($promo_banner_middle_top)
        <div class="container d-sm-none mt-3">
            <a href="{{ $promo_banner_middle_top['url'] }}" target="_blank" class="img1 promo-1">
                <img loading="lazy" class="img-fluid" alt="{{ translate('banner') }}" src="{{ getValidImage(path: 'storage/app/public/banner/'.($promo_banner_middle_top['photo']), type: 'banner') }}">
            </a>
        </div>
    @endif

    @if ($web_config['flash_deals'])
        @include('theme-views.partials._flash-deals')
    @endif

    @if ($promo_banner_left)
        <div class="container d-sm-none overflow-hidden pt-4">
            <a href="{{ $promo_banner_left['url'] }}" target="_blank" class="img3 img-fluid">
                <img loading="lazy" src="{{ getValidImage(path: 'storage/app/public/banner/'.($promo_banner_left['photo']), type:'banner') }}"
                class="img-fluid" alt="{{ translate('banner') }}">
            </a>
        </div>
    @endif



    @if ($promo_banner_bottom)
        <div class="container mt-2">
            <div class="row">
        @foreach ($promo_banner_bottom as $key => $item)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4" style="padding-top: 0.5rem; padding-bottom: 0.5rem">
                <a href="{{ $item->url }}" target="_blank" class="d-block promotional-banner" style="border-radius:0.42rem;">
                    <img loading="lazy" class="w-100" alt="{{ translate('banner') }}"
                         src="{{ getValidImage(path: 'storage/app/public/banner/'.$item['photo'], type:'banner') }}">
                </a>
            </div>
        @endforeach
        </div>
        </div>
    @endif

    
    @include('theme-views.partials._recommended-product')

    @if ($promo_banner_left && $promo_banner_middle_top && $promo_banner_middle_bottom && $promo_banner_right)
        @include('theme-views.partials._promo-banner')
    @endif

    @include('theme-views.partials._deal-of-the-day')

    @if ($promo_banner_middle_bottom)
        <div class="container d-sm-none overflow-hidden pt-4">
            <a href="{{ $promo_banner_middle_bottom['url'] }}" target="_blank" class="img2">
                <img loading="lazy" src="{{ getValidImage(path: 'storage/app/public/banner/'.($promo_banner_middle_bottom['photo']), type:'banner') }}"
                class="img-fluid" alt="{{ translate('banner') }}">
            </a>
        </div>
    @endif

    @include('theme-views.partials.__featured-product')

    <!-- @include('theme-views.partials._all-products-home') -->

    @include('theme-views.partials._signature-product')

    @if ($web_config['business_mode'] == 'multi' && count($top_sellers) > 0)
        @include('theme-views.partials._top-stores')
    @endif

    @if ($promo_banner_right)
        <div class="container overflow-hidden pt-4">
            <a href="{{ $promo_banner_right['url'] }}" target="_blank" class="d-block promotional-banner">
                <img loading="lazy" src="{{ getValidImage(path: 'storage/app/public/banner/'.$promo_banner_right['photo'], type:'banner') }}"
                class="w-100 img-fluid" alt="{{ translate('banner') }}">
            </a>
        </div>
    @endif

    @include('theme-views.partials._most-demanded-product')

    @if ($web_config['business_mode'] == 'multi' && \App\Utils\get_customer() != 'offline' && count($recent_order_shops)>0)
        @include('theme-views.partials._recent-ordered-shops')
    @endif


    @if ($web_config['business_mode'] == 'multi')
        @include('theme-views.partials._other-stores')
    @endif

    @include('theme-views.partials._how-to-section')

@endsection

@if ($main_banner->count() <= 1)
@push('script')
    <script src="{{ theme_asset('assets/js/home-blade.js') }}"></script>
@endpush
@endif
