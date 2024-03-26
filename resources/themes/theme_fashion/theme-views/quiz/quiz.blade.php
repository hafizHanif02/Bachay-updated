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
    .section1 div h1 {
        font-size: 64px;
        color: #000;
        font-family: 'Outfit';
        font-size: 64px;
        font-style: normal;
        font-weight: 700;
        line-height: 64px;
        text-transform: capitalize;
        margin: 150px 0 0 0;
        position: relative;
    }

    .section1 div h1::before {
        content: "";
        position: absolute;
        top: -110px;
        left: 100px;
        width: 400px;
        height: 400px;
        background-image: url('../public/images/background-blur.png');
        background-size: cover;
        z-index: -1;
        opacity: 0.7;
    }

    .parenting-img::before {
        content: "";
        position: absolute;
        top: 0;
        left: 80%;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star.png');
        background-size: cover;
        z-index: -1;
    }

    .parenting-content::before {
        content: "";
        position: absolute;
        top: 7%;
        left: 0;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star2.png');
        background-size: cover;
        z-index: -1;
    }

    .addvertisment-img::before {
        content: "";
        position: absolute;
        top: 15%;
        left: 20%;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star2.png');
        background-size: cover;
        z-index: -1;
    }

    .features::before {
        content: "";
        position: absolute;
        bottom: 100px;
        left: 55%;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star2.png');
        background-size: cover;
        z-index: -1;
    }

    .advatnages::before {
        content: "";
        position: absolute;
        bottom: 120px;
        left: 0;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star2.png');
        background-size: cover;
        z-index: -1;
    }

    .section1 div p {
        color: #000;
        font-family: Outfit;
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        text-transform: capitalize;
        opacity: 0.5;
    }

    .download-btn {
        transition: color 0.3s ease, background 0.3s ease, border 0.3s ease;
        border-radius: 4px;
        background: #8F6FC6;
        color: #fff;
        border: 2px solid #8F6FC6;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        text-transform: capitalize;
        width: 200px;
        height: 50px;
    }

    .watchvideo-btn {
        color: #000;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 28px;
        text-transform: capitalize;
    }

    .bi-play-circle {
        font-size: 29px;
    }

    .features {
        color: #835EC1;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        letter-spacing: 2.88px;
        text-transform: uppercase;

        position: relative;
    }

    .Porfessionals {
        color: #000;
        font-family: 'Outfit';
        font-size: 48px;
        font-style: normal;
        font-weight: 700;
        line-height: 48px;
        text-transform: capitalize;
    }

    .question {
        color: #000;

        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 28px;
        text-transform: capitalize;
        margin: 0 0 0 5px;
    }

    .question-para {
        color: #000;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        text-transform: capitalize;
        opacity: 0.5;
    }

    .advatnages {
        color: #D65CB1;
        font-family: Outfit;
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        letter-spacing: 2.88px;
        text-transform: uppercase;
        position: relative;

    }

    .growth-tracker {
        color: #000;
        font-family: Outfit;
        font-size: 28px;
        font-style: normal;
        font-weight: 600;
        line-height: 28px;
        text-transform: capitalize;
        margin: 0 0 0 15px;
    }

    .testimonials::before {
        content: "";
        position: absolute;
        top: -50px;
        left: 0%;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star.png');
        background-size: cover;
        z-index: -1;
    }

    .why-choose-parenting-img::before {
        content: "";
        position: absolute;
        top: -50px;
        left: 75%;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star.png');
        background-size: cover;
        z-index: -1;
    }

    .Quiz-heading::before {
        content: "";
        position: absolute;
        bottom: 120px;
        left: 100%;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star2.png');
        background-size: cover;
        z-index: -1;
    }

    .parenting-testimonial {
        color: #000;
        text-align: center;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        letter-spacing: 2.88px;
        text-transform: uppercase;
    }

    .parenting-about-us {
        color: #000;
        text-align: center;
        font-family: 'Outfit';
        font-size: 48px;
        font-style: normal;
        font-weight: 700;
        line-height: 48px;
        text-transform: capitalize;

    }

    .parent-testimonial-heading {
        color: #000;
        font-family: 'Outfit';
        font-size: 28px;
        font-style: normal;
        font-weight: 600;
        line-height: 28px;
        text-transform: capitalize;
    }

    .testimonial-name {
        color: #000;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 28px;
        /* 155.556% */
        text-transform: capitalize;
    }

    .bg-blurimg::before {
        content: "";
        position: absolute;
        top: -110px;
        right: 0;
        width: 400px;
        height: 400px;
        background-image: url('../public/images/background-blur.png');
        background-size: cover;
        z-index: -1;
        opacity: 0.4;
    }

    .bg-blurimg {
        position: relative;
    }

    .parenting-faq {
        color: #835EC1;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        letter-spacing: 2.88px;
        text-transform: uppercase;
    }

    .parenting-head {
        color: #000;
        font-family: 'Outfit';
        font-size: 48px;
        font-style: normal;
        font-weight: 700;
        line-height: 48px;
        text-transform: capitalize;
    }

    .parenting-faq-head {
        color: #FFF;
        font-family: 'Outfit';
        font-size: 28px;
        font-style: normal;
        font-weight: 600;
        line-height: 28px;
        /* 100% */
        text-transform: capitalize;
    }

    .f-Left {
        border-radius: 8px;
        background: #835EC1;
        padding: 25px;

    }

    .parenting-faq-text {
        color: #FFF;
        text-align: justify;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        /* 155.556% */
        text-transform: capitalize;
    }

    .third-Left {
        border-radius: 8px;
        background: #FF9670;
        padding: 25px;

    }

    .f-Right {
        padding: 25px;

    }

    .second-Right {
        border-radius: 8px;
        background: #FF6F92;
        padding: 25px;

    }

    .custom-con {
        width: 49%;
    }

    .f-Right::before {
        content: "";
        position: absolute;
        top: -100px;
        left: 3%;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star.png');
        background-size: cover;
        z-index: -1;
    }

    .blur-effect::before {
        content: "";
        position: absolute;
        top: -110px;
        left: -50px;
        width: 400px;
        height: 400px;
        background-image: url('../public/images/background-blur.png');
        background-size: cover;
        z-index: -1;
        opacity: 0.7;
    }

    .section6 {
        border-radius: 8px;
        margin: 10px 0;

    }

    .bottom-heading {
        color: #FFF;
        font-family: 'Outfit';
        font-size: 48px;
        font-style: normal;
        font-weight: 700;
        line-height: 48px;
        text-transform: capitalize;
    }

    .bottom-text {
        color: #FFF;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        text-transform: capitalize;
    }

    .last-sec-btns {
        padding: 100px;
    }

    .app-btns {
        color: #000;
        font-family: 'Outfit';
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        text-transform: capitalize;
        border-radius: 4px;
        background: #FFF;
        padding: 10px;
    }

    .bottom-heading::before {
        content: "";
        position: absolute;
        top: -250px;
        right: -500px;
        width: 50px;
        height: 50px;
        background-image: url('../public/images/star2.png');
        background-size: cover;
        z-index: -1;
    }

    .bottom-heading {
        position: relative;
    }

    .ready-to-start {
        display: flex;
    }

    .btns {
        display: inline-flex;
    }

    .download-btn:hover {
        background: #ff9670;
        border: 2px solid #ff9670;
    }

    .parenting-img::before,
    .parenting-content::before,
    .addvertisment-img::before,
    .features::before,
    .why-choose-parenting-img::before,
    .advatnages::before,
    .Quiz-heading::before,
    .testimonials::before,
    .f-Right::before,
    .bottom-heading::before {

        animation: rotateImage 2s ease-in-out infinite;

    }
    
    @keyframes rotateImage {
        0% {
            transform: rotate(30deg);
        }

        50% {
            transform: rotate(-30deg);
        }

        100% {
            transform: rotate(30deg);
        }
    }

    /* Tablet-specific styles */
    @media (min-width: 768px) and (max-width: 991.98px) {

        .section1 .container,
        .section2 .container,
        .section3 .container,
        .section4 .container,
        .section5 .container,
        .ready-to-start {
            display: flex;
        }

        .bg-blurimg::before {
            right: 0;
        }

        .Quiz-heading::before {
            left: 80%;
        }

        .bottom-heading::before {
            right: -250px;
        }

        .last-sec-btns {
            padding: 20px;
        }

        .btns {
            display: block;

        }

        .app-btns {
            margin: 10px 0 0 0;
        }

        .section1 div h1 {
            font-size: 40px;
            line-height: 45px;
            margin: 110px 0 0 0;

        }
    }
    
    /* Mobile Responsive Styles */
    @media (max-width: 767px) {

        .section1 .container,

        .section3 .container,

        .section5 .container,
        .ready-to-start {
            display: block !important;

        }

        .section2 .container,
        .section4 .container {
            flex-direction: column-reverse;
        }

        .parenting-content div {
            gap: 0.5rem !important;
        }

        .custom-con {
            width: 100%;
        }

        .bottom-heading::before {
            display: none;
        }

        .section1 div h1::before {
            left: 0;
            width: 300px;
            height: 300px;
        }

        .bg-blurimg::before {
            right: 50px;
            width: 300px;
            height: 300px;
        }

        .Quiz-heading::before {
            left: 80%;
        }

        .last-sec-btns {
            padding: 30px;
        }

        .app-btns {
            width: 100%;
            margin: 10px 0 0 0;
            display: flex;
            justify-content: center;
        }

        .btns {
            display: block;
        }

        .section1 div h1 {
            font-size: 36px;
            line-height: 45px;
            margin: 105px 0 0 0;
        }

        .parenting-content::before {
            display: none;
        }

        .download-btn {
            width: 170px;
        }

        .Porfessionals,
        .parenting-about-us,
        .parenting-head {
            font-size: 36px;
            line-height: 45px;
        }

        .advatnages::before {
            display: none;
        }

        .growth-tracker {
            font-size: 18px;
        }

        .parenting-faq-text {
            line-height: 24px;
        }

        .parenting-faq-head {
            font-size: 22px;
        }

        .bottom-heading {
            font-size: 40px;
        }
    }

    @media screen and (max-width: 280px) {

        /* Your styles for Galaxy Fold in portrait mode */
        .section1 div h1::before {
            width: 200px;
            height: 200px;
            top: -50px;
            opacity: 0.6;

        }

        .blur-effect::before {
            width: 200px;
            height: 200px;
            top: -30;
            left: 10px;
        }

        .download-btn {
            width: 100%;
        }

        .watchvideo-btn,
        .download-btn {
            line-height: 20px;
        }
    }
</style>

@section('content')
   
@endsection <section id="parenting-section-last" class="parenting-section section6">
    <div class="container d-flex col-12 section6 blur-effect position-relative">
        <div class="ready-to-start col-12 justify-content-between align-items-center pt-4 pb-4 section6 star-bg"
            style="background-image: url('../public/images/P-backgroundLast.png');
            background-repeat: no-repeat;
            background-size: cover;
            ">
            <div class="last-sec-btns col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h1 class="bottom-heading">ready to get started?</h1>
                <p class="bottom-text mt-3">Risus habitant leo egestas mauris diam eget morbi tempus vulputate.</p>
                <div class="btns gap-4">
                    <button class="border-0 app-btns"> <img src="{{ asset('public/images/apple.svg') }}"
                            alt="">
                        download app</button>
                    <button class="border-0 app-btns"><img src="{{ asset('public/images/play.svg') }}"
                            alt="">download app</button>

                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card_animation">
                    <img src="{{ asset('public/images/P-lastFront.png') }}" alt="" width="100%">
                </div>
            </div>

        </div>
    </div>
</section>
