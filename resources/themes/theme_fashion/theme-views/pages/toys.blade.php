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
    <div class="row flex-nowrap overflow-auto">
        @foreach ($subcategories as $subcategory)
            <div class="col d-flex flex-column align-items-center">
                <img src="{{asset('storage/app/public/category')}}/{{ $subcategory->icon }}" alt="{{ $subcategory->name }}" class="img-fluid" style="max-width: 80px;">
                <p>{{ $subcategory->name }}</p>
            </div>
        @endforeach
    </div>
</div>


<!-- Best Selling Products -->
<div class="container best-selling-section">
    <h3>Latest Products</h3>
    <div class="row">
        @foreach($random_product as $product)
            @if($product)
            <div class="col-6 col-md-3">
                @include('theme-views.partials._product-medium-card',['product'=>$product])
            </div>
            @endif
        @endforeach
        
    </div>
</div>

<!-- Top Brands -->
<div class="container top-brands-section text-center">
    <h3>Top Brands</h3>
    <div class="d-flex justify-content-around">
        @foreach($brands as $brand)
        <div class="col-6 col-sm-4 col-md-3 col-xl-brands">
            <a href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','brand_name'=>str_replace(' ', '_', $brand->name),'page'=>1])}}"
               class="brands-item"  title="{{ $brand->name }}">
                <img loading="lazy" src="{{ getValidImage(path: 'storage/app/public/brand/'.$brand->image, type:'brand') }}"
                    class="img-fluid badge-soft-base" alt="{{ $brand->name }}">
            </a>
        </div>
    @endforeach
        
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
    .subcategory-container {
    padding: 20px 0;
}

.subcategory-container .row {
    gap: 10px; /* Adjust the gap between subcategories */
    padding: 10px;
}

.subcategory-container img {
    transition: transform 0.3s ease; /* Add hover effect */
    width: 120px;
    height: auto;
    object-fit: contain;
    object-position: center;
    padding: 5px;
}

.subcategory-container img:hover {
    transform: scale(1.1);
}

.subcategory-container p {
    margin-top: 10px;
    font-size: 14px;
    color: #333;
}

</style>