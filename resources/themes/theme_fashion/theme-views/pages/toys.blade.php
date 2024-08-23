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

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

@section('content')

@include('theme-views.partials._add-child-mobile')

{{-- Middle content start --}}
<div class="container">


    <!-- Carousel Section -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $key => $banner)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    {{-- storage/app/public/banner/2024-08-24-66c8fb459bd74.webp --}}
                    <img src="{{asset('storage/app/public/banner')}}/{{ $banner->photo }}" class="d-block w-100" alt="{{ $banner->title }}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Full Width Banner -->
    @foreach ($brandBanner as $item)
        <div class="full-width-banner">
            <img src="{{asset('storage/app/public/banner')}}/{{ $item->photo }}" alt="{{ $item->title }}">
        </div>
    @endforeach
    
</div>

<!-- Subcategories Section -->
<div class="container subcategory-container text-center">
    <div class="row">
        <div class="col-3">
            <img src="subcategory1.png" alt="Subcategory 1">
            <p>Subcategory 1</p>
        </div>
        <div class="col-3">
            <img src="subcategory2.png" alt="Subcategory 2">
            <p>Subcategory 2</p>
        </div>
        <div class="col-3">
            <img src="subcategory3.png" alt="Subcategory 3">
            <p>Subcategory 3</p>
        </div>
        <div class="col-3">
            <img src="subcategory4.png" alt="Subcategory 4">
            <p>Subcategory 4</p>
        </div>
    </div>
</div>

<!-- Best Selling Products -->
<div class="container best-selling-section">
    <h3>Best Selling Products</h3>
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="product-card">
                <img src="product1.jpg" alt="Product 1">
                <p>Product 1</p>
                <p>$25.00</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="product-card">
                <img src="product2.jpg" alt="Product 2">
                <p>Product 2</p>
                <p>$30.00</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="product-card">
                <img src="product3.jpg" alt="Product 3">
                <p>Product 3</p>
                <p>$20.00</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="product-card">
                <img src="product4.jpg" alt="Product 4">
                <p>Product 4</p>
                <p>$40.00</p>
            </div>
        </div>
    </div>
</div>

<!-- Top Brands -->
<div class="container top-brands-section text-center">
    <h3>Our Favourite Brands</h3>
    <div class="d-flex justify-content-around">
        <img src="brand1.png" alt="Brand 1">
        <img src="brand2.png" alt="Brand 2">
        <img src="brand3.png" alt="Brand 3">
        <img src="brand4.png" alt="Brand 4">
    </div>
</div>



{{-- Middle content end --}}


@include('theme-views.partials._how-to-section')

@endsection

@if ($banners->count() <= 1)
@push('script')
<script src="{{ theme_asset('assets/js/home-blade.js') }}"></script>
@endpush
@endif


<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<style>
    /* Add your custom styles */
    .carousel img {
        height: 300px;
        object-fit: cover;
    }
    .full-width-banner img {
        width: 100%;
        margin: 20px 0;
    }
    .subcategory-container img {
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
    }
    .subcategory-container p {
        font-size: 14px;
        margin: 0;
    }
    .product-card {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px;
        text-align: center;
    }
    .product-card img {
        max-width: 100%;
        height: 150px;
        object-fit: contain;
    }
    .top-brands-section img {
        max-width: 100px;
        margin: 10px;
    }
</style>