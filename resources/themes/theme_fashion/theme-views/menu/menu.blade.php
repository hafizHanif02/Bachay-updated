@extends('theme-views.layouts.app')

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
    .acc-wrap{
        padding: 30px 10px;
    }
    .acc-header {
        display: flex;
        justify-content: space-between;
    }

    .img-box {
        width: 32% !important;
        background-color: #fff;
        box-shadow: 2px 2px 7px 1px #ccc;
        border-radius: 4px;
    }

    .acc-images img {
        max-width: 100%;
    }

    .img-label {
        text-align: center;
        font-size: 12px;
        color: #424242;
        margin: 6px 0;
    }

    .acc-header {
        margin-bottom: 15px;
    }

    .scroll-container {
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .scroll-container::-webkit-scrollbar {
        display: none;
    }

    .scroll-container img {
        margin: 5px;
    }
</style>

@section('content')
    <div class="acc-wrap">
        <div class="acc-header">
            <div class="img-box" id="img00">
                <div class="acc-images">
                    <a href="{{ route('categories') }}"><img src="{{ asset('public/images/f.jpg') }}" alt="Category" title="Category" /></a>
                </div>
                <p class="img-label">Category</p>
            </div>

            <div class="img-box" id="img01">
                <div class="acc-images">
                    <a href="{{ route('vendors') }}"><img src="{{ asset('public/images/s.jpg') }}" alt="Shops" title="Shops" /></a>
                </div>
                <p class="img-label">Shops</p>
            </div>

            <div class="img-box" id="img02">
                <div class="acc-images">
                    <a href="{{ route('parenting') }}"><img src="{{ asset('public/images/t.jpg') }}" alt="Parenting" title="Parenting" /></a>
                </div>
                <p class="img-label">Parenting</p>
            </div>
        </div>

        <div class="acc-body-first" id="menulevel200" style="display: none">
            <div class="scroll-container">
                <img src="{{ asset('public/images/1brand.png') }}" alt="" width="80" height="30">
                <img src="{{ asset('public/images/2brand.jpg') }}" alt="" width="80" height="30">
                <img src="{{ asset('public/images/3brand.jpg') }}" alt="" width="80" height="30">
                <img src="{{ asset('public/images/4brand.jpg') }}" alt="" width="80" height="30">
                <img src="{{ asset('public/images/5brand.jpg') }}" alt="" width="80" height="30">
                <img src="{{ asset('public/images/6brand.png') }}" alt="" width="80" height="30">

            </div>
        </div>
        <div class="acc-header">
            <div class="img-box" id="img00">
                <div class="acc-images">
                    <a href="https://bachay.com/products"><img src="{{ asset('public/images/preschool.jpg') }}" alt="Product"
                        title="Product" /></a>
                </div>
                <p class="img-label">Product</p>
            </div>

            <div class="img-box" id="img01">
                <div class="acc-images">
                    <a href="{{ route('products', ['data_from' => 'category', 'id' => 3, 'page' => 1]) }}"><img src="{{ asset('public/images/OfferZone.jpg') }}" alt="Offers" title="Offers" /></a>
                </div>
                <p class="img-label">Offers</p>
            </div>

            <div class="img-box" id="img02">
                <div class="acc-images">
                    <a href="{{ route('articles') }}"><img src="{{ asset('public/images/sellwithus.jpg') }}" alt="Articles" title="Articles" /></a>
                </div>
                <p class="img-label">Articles</p>
            </div>
        </div>
        <div class="acc-header">
            <div class="img-box" id="img00">
                <div class="acc-images">
                    <a href="{{ route('categories.detail', 'Boys%20Fashion') }}"><img src="{{ asset('storage/app/public/category/2024-03-06-65e8660377e7a.webp') }}" alt="Boy Fashion"
                        title="Boy Fashion" /></a>
                </div>
                <p class="img-label">Boy Fashion</p>
            </div>

            <div class="img-box" id="img01">
                <div class="acc-images">
                    <a href="{{ route('categories.detail', 'Girls%20Fashion') }}"><img src="{{ asset('storage/app/public/category/2024-03-06-65e866fc061fe.webp') }}" alt="Girls Fashion" title="Girls Fashion" /></a>
                </div>
                <p class="img-label">Girls Fashion</p>
            </div>

            <div class="img-box" id="img02">
                <div class="acc-images">
                    <a href="{{ route('categories.detail', 'Baby%20Care') }}"><img src="{{ asset('storage/app/public/category/2024-03-06-65e867c367979.webp') }}" alt="Baby Care" title="Baby Care" /></a>
                </div>
                <p class="img-label">Baby Care</p>
            </div>
        </div>
        <div class="acc-header">
            <div class="img-box" id="img00">
                <div class="acc-images">
                    <a href="{{ route('brands') }}"><img src="{{ asset('storage/app/public/brand/2024-02-04-65be977148ab5.webp') }}" alt="Brands"
                        title="Shop By Category" /></a>
                </div>
                <p class="img-label">Brands</p>
            </div>

            <div class="img-box" id="img01">
                <div class="acc-images">
                    <a href="{{ route('explore_page') }}"><img src="{{ asset('public/images/explore1.webp') }}" alt="Explore" title="Explore" /></a>
                </div>
                <p class="img-label">Explore</p>
            </div>

            <div class="img-box" id="img02">
                <div class="acc-images">
                    <a href="{{ route('categories.detail', 'Toys') }}"><img src="{{ asset('storage/app/public/category/2024-03-06-65e8632f7eb7d.webp') }}" alt="Toys" title="Toys" /></a>
                </div>
                <p class="img-label">Toys</p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("img00").addEventListener("click", function() {
            var menu = document.getElementById("menulevel200");
            if (menu.style.display === "none") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        });
    </script>
@endsection

