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
    iframe {
        border-radius: 20px;
    }

    .video-container {
        padding: 30px 20px;
        border-radius: 20px;
        border: 1px solid #ebeaea;
        width: 60%;
    }

    .child-container {
        width: 38%;
        border: 1px solid #ebeaea;
        border-radius: 20px;
        padding: 10px 30px;
        padding-bottom: 0;
        background-image: url(https://cdn.cdnparenting.com/brainbees/community/preact/public/media/Personalization_BG.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-origin: content-box;
        background-position: bottom;
        height: 90vh;
        overflow-y: auto;
        position: sticky;
        top: 30px;
    }

    /* scroll color for parenting child */
    .child-container::-webkit-scrollbar-track {
        visibility: hidden;
    }

    .child-container::-webkit-scrollbar-thumb {
        background: #ebebeb;
    }

    .video_heading,
    .child-heading,
    .child-heading {
        font-family: 'poppins';
    }

    .baby_circle_child {
        width: 70px;
        height: 70px;
        float: left;
        border: 2px solid #fff;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .child-img {
        max-width: 100%;
    }

    @media screen and (min-width: 1024px) and (max-width: 1199px) {

        /* Styles for larger tablets, laptops, and desktops */
        .video-container {
            width: 100%;
        }

    }

    @media screen and (min-width: 768px) and (max-width: 1023px) {

        /* Styles for tablets and small laptops */
        .video-container {
            width: 100%;
            padding: 0;

        }
    }

    @media screen and (min-width: 320px) and (max-width: 767px) {

        /* Styles for phones and small tablets */
        .video-container {
            width: 100%;
            padding: 0;
            border: none;
        }

        iframe {
            height: 280px;
        }
    }
</style>

@section('content')
    <section>
        @if ($main_banner->count() > 0)
        <section class="banner-section ">
            <div class="slider owl-theme owl-carousel custom-single-slider">
                @foreach($main_banner as $banner)
               
                <div class="banner-slide" style="background: {{ $banner['background_color'] }};">
        
                    <img class="banner-slide-img d-none d-lg-block d-xl-block" style="height: 400px;" alt="{{ translate('banner') }}" loading="lazy"
                         src="{{ getValidImage(path: 'storage/app/public/banner/'.$banner['photo'], type:'product') }}">
        
                    <img class="banner-slide-img d-lg-none d-xl-none" style="height: 400px;" alt="{{ translate('banner') }}" loading="lazy"
                         src="{{ getValidImage(path: 'storage/app/public/banner/'.$banner['mobile_photo'], type:'product') }}">
        
                    <!-- @if($banner['title'] && $banner['sub_title'])
                        <div class="content">
                            <h1 class="title mb-3">{{ $banner['title'] }} <br><span class="subtxt">{{ $banner['sub_title'] }}</span> </h1>
                            @if($banner['button_text'])
                            <div class="info">
                                <a href="{{ $banner['url'] ?? "javascript:"}}" class="btn btn-base">{{ $banner['button_text'] }}</a>
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
                    <img src="{{theme_asset('assets/img/arrow-icon.png')}}" class="banner-arrow d-sm-none" alt="{{ translate('banner') }}" loading="lazy">
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

    <div class="container mt-5 d-flex justify-content-between pb-5">

        <div class="video-container">
            <h3 class="mb-4 video_heading">Videos you might be interested in</h3>
            <iframe width="100%" height="400" src="https://www.youtube.com/embed/tgbNymZ7vqY">
            </iframe>
            <h3 class="mb-4 mt-4 video_heading">Videos you might be interested in</h3>
            <iframe width="100%" height="400" src="https://www.youtube.com/embed/tgbNymZ7vqY">
            </iframe>
            <h3 class="mb-4 mt-4 video_heading">Videos you might be interested in</h3>

            <iframe width="100%" height="400" src="https://www.youtube.com/embed/tgbNymZ7vqY">
            </iframe>
            <h3 class="mb-4 mt-4 video_heading">Videos you might be interested in</h3>

            <iframe width="100%" height="400" src="https://www.youtube.com/embed/tgbNymZ7vqY">
            </iframe>
            <h3 class="mb-4 mt-4 video_heading">Videos you might be interested in</h3>

            <iframe width="100%" height="400" src="https://www.youtube.com/embed/tgbNymZ7vqY">
            </iframe>
        </div>
        <div class="child-container d-none d-xl-block">
            <h3 class="text-center child-heading">
                Tell us more about yourself get More Personalized
            </h3>
            <div class="d-flex align-items-center gap-3 mt-4 mb-4">
                <div class="baby_circle_child">
                    <img class="child-img" src="{{ asset('public/images/01-Infant.jpg') }}" alt="">

                </div>
                <div>
                    <h3 class="child-heading">
                        Infant
                    </h3>
                    <p class="m-0">
                        0 to 6 Months
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="baby_circle_child">
                    <img class="child-img" src="{{ asset('public/images/02-Baby.jpg') }}" alt="">

                </div>
                <div>
                    <h3 class="child-heading">
                        Baby
                    </h3>
                    <p class="m-0">
                        6 Months to 2 Yrs
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="baby_circle_child">
                    <img class="child-img" src="{{ asset('public/images/03-Toddler.jpg') }}" alt="">

                </div>
                <div>
                    <h3 class="child-heading">
                        Toddler
                    </h3>
                    <p class="m-0">
                        2 to 4 yrs
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="baby_circle_child">
                    <img class="child-img" src="{{ asset('public/images/04-Kids.jpg') }}" alt="">

                </div>
                <div>
                    <h3 class="child-heading">
                        Kids
                    </h3>
                    <p class="m-0">
                        4-6 yrs
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="baby_circle_child">
                    <img class="child-img" src="{{ asset('public/images/05-Big-Kids.jpg') }}" alt="">

                </div>
                <div>
                    <h3 class="child-heading">
                        Big Kids
                    </h3>
                    <p class="m-0">
                        6+ yrs
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="baby_circle_child">
                    <img class="child-img" src="{{ asset('public/images/06-Expecting.jpg') }}" alt="">

                </div>
                <div>
                    <h3 class="child-heading">
                        Expecting
                    </h3>
                    <p class="m-0">
                        {{-- 0 to 6 Months --}}
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="baby_circle_child">
                    <img class="child-img" src="{{ asset('public/images/07-Trying-to-concieve.jpg') }}" alt="">

                </div>
                <div>
                    <h3 class="child-heading">
                        Trying to Conceive
                    </h3>
                    <p class="m-0">
                        {{-- 0 to 6 Months --}}
                    </p>
                </div>
            </div>
        </div>


    </div>

@endsection
