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
        border-radius: 4px;
        background: #8F6FC6;
        color: #fff;
        border: 1px solid #8F6FC6;
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
        right: -150px;
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
        margin: 80px 0;

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
</style>
@section('content')
    {{-- <div class="text-center">
        <img src="{{ asset('public/images/parenting.webp') }}" alt="">
        <img src="{{ asset('public/images/p2.webp') }}" alt="">



    </div> --}}
    <section class="parenting-section section1">
        <div class="container d-flex mt-5">
            <div class="col-6 parenting-content position-relative">
                <h1>Qorem ipsum dolor sit amet, conset.</h1>
                <p class="mt-3">Cum et convallis risus placerat aliquam, nunc. Scelerisque aliquet faucibus tincidunt eu
                    adipiscing sociis
                    arcu lorem porttitor.</p>
                <div class="d-flex align-items-center gap-3 mt-4">
                    <button class="download-btn"><i class="bi bi-arrow-down"></i> Download App</button>
                    <button class="border-0 bg-transparent watchvideo-btn d-inline-flex gap-2"><i
                            class="bi bi-play-circle"></i> watch video</button>

                </div>
                <div class="mt-4 addvertisment-img position-relative">
                    <img src="{{ asset('public/images/P-firstLeft.png') }}" alt="" width="90%">
                </div>
            </div>
            <div class="col-6 mt-3 parenting-img position-relative">
                <img src="{{ asset('public/images/P-firstRight.png') }}" alt="" width="100%">
            </div>

        </div>
    </section>
    <section class="parenting-section section2">
        <div class="container d-flex align-items-center">
            <div class="col-6">
                <img src="{{ asset('public/images/P-secondLeft.png') }}" alt="" width="100%">
            </div>
            <div class="col-6">
                <h3 class="features">
                    features
                </h3>
                <h1 class="Porfessionals bg-blurimg ">
                    Parenting by Porfessionals
                </h1>
                <ul class="mt-4">
                    <li>
                        <img src="{{ asset('public/images/question.svg') }}" alt=""> <span
                            class="question">Questions & Answers By Parents</span>
                        <p class="question-para mt-3">Cum et convallis risus placerat aliquam, nunc. Scelerisque aliquet
                            faucibus tincidunt eu adipiscing sociis arcu lorem porttitor.</p>
                    </li>
                    <li>
                        <img src="{{ asset('public/images/Q.svg') }}" alt=""> <span class="question">Quizzes For
                            Childrens</span>
                        <p class="question-para mt-3">Cum et convallis risus placerat aliquam, nunc. Scelerisque aliquet
                            faucibus tincidunt eu adipiscing sociis arcu lorem porttitor.</p>
                    </li>
                    <li>
                        <img src="{{ asset('public/images/V.svg') }}" alt=""> <span class="question">Vaccination &
                            Growth Tracker</span>
                        <p class="question-para mt-3">Cum et convallis risus placerat aliquam, nunc. Scelerisque aliquet
                            faucibus tincidunt eu adipiscing sociis arcu lorem porttitor.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="parenting-section section3">
        <div class="container d-flex align-items-center">
            <div class="col-6">
                <h3 class="advatnages">
                    advatnages
                </h3>
                <h1 class="Porfessionals">
                    why choose Parenting?
                </h1>
                <ul class="mt-4">
                    <li>
                        <div class="d-inline-flex align-items-center">
                            <img src="{{ asset('public/images/bell.svg') }}" alt="">
                            <span class="growth-tracker">Vaccination & Growth Tracker</span>

                        </div>
                        <p class="question-para mt-3">Arcu at dictum sapien, mollis. Vulputate sit id accumsan, ultricies.
                            In ultrices malesuada elit mauris etiam odio. Duis tristique lacus, et blandit viverra nisl
                            velit. Sed mattis rhoncus, diam suspendisse sit nunc, gravida eu. Lectus eget eget ac dolor
                            neque lorem sapien, suspendisse aliquam.</p>
                    </li>

                </ul>
            </div>
            <div class="col-6 why-choose-parenting-img position-relative">
                <img src="{{ asset('public/images/P-thirdRight.png') }}" alt="" width="100%">
            </div>

        </div>
    </section>
    <section class="parenting-section section4">
        <div class="container d-flex align-items-center">
            <div class="col-6 why-choose-parenting-img position-relative">
                <img src="{{ asset('public/images/P-fourthLeft.png') }}" alt="" width="100%">
            </div>
            <div class="col-6">

                <ul class="mt-4">
                    <li>
                        <div class="d-inline-flex align-items-center Quiz-heading position-relative">
                            <img src="{{ asset('public/images/star-orange.svg') }}" alt="">
                            <span class="growth-tracker">Quiz Challenges</span>

                        </div>
                        <p class="question-para mt-3">Arcu at dictum sapien, mollis. Vulputate sit id accumsan, ultricies.
                            In ultrices malesuada elit mauris etiam odio. Duis tristique lacus, et blandit viverra nisl
                            velit. Sed mattis rhoncus, diam suspendisse sit nunc, gravida eu. Lectus eget eget ac dolor
                            neque lorem sapien, suspendisse aliquam.</p>
                    </li>

                </ul>
            </div>


        </div>
    </section>
    <section class="parenting-section section5">
        <div class="container">
            <h1 class="parenting-testimonial">testimonial</h1>
            <h1 class="parenting-about-us">
                what our users say <br> about us?
            </h1>
        </div>
        <div class="container d-flex align-items-center">
            <div class="col-6 testimonials position-relative">
                <img src="{{ asset('public/images/P-fifthRight.png') }}" alt="" width="100%">
            </div>
            <div class="col-6">

                <ul class="mt-4">
                    <li>
                        <div class="d-inline-flex align-items-center Quiz-heading position-relative">

                            <span class="parent-testimonial-heading">the best financial accounting app ever!</span>

                        </div>
                        <p class="question-para mt-4">“Arcu at dictum sapien, mollis. Vulputate sit id accumsan, ultricies.
                            In ultrices malesuada elit mauris etiam odio. Duis tristique lacus, et blandit viverra nisl
                            velit. Sed mattis rhoncus, diam suspendisse sit nunc, gravida eu. Lectus eget eget ac dolor
                            neque lorem sapien, suspendisse aliquam.”</p>
                        <img class="mt-3" src="{{ asset('public/images/testimonial-img.svg') }}" alt="">
                        <p class="testimonial-name mt-3">
                            Samina Ahmed
                        </p>
                    </li>

                </ul>
            </div>


        </div>
    </section>
    <section class="parenting-section section5">
        <div class="container">
            <h1 class="parenting-faq">faq</h1>
            <h1 class="parenting-head">
                Frequently asked <br> questions
            </h1>
        </div>
        <div class="container col-12 d-flex align-items-center justify-content-between mt-4">
            <div class="custom-con">
                <ul class="">
                    <li class="f-Left">
                        <h1 class="parenting-faq-head">Lorem ipsum dolor sit amet,sectetur adipiscing elit.</h1>
                        <p class="parenting-faq-text mt-2">“Arcu at dictum sapien, mollis. Vulputate sit id accumsan,
                            ultricies. In ultrices malesuada elit mauris.</p>
                    </li>
                    <li class="f-Left bg-transparent text-dark">
                        <h1 class="parenting-faq-head text-dark">Lorem ipsum dolor sit amet,sectetur adipiscing elit.</h1>
                        <p class="parenting-faq-text mt-2 text-dark opacity-50">“Arcu at dictum sapien, mollis. Vulputate sit id
                            accumsan, ultricies. In ultrices malesuada elit mauris.</p>
                    </li>
                    <li class="third-Left">
                        <h1 class="parenting-faq-head">Lorem ipsum dolor sit amet,sectetur adipiscing elit.</h1>
                        <p class="parenting-faq-text mt-2">“Arcu at dictum sapien, mollis. Vulputate sit id accumsan,
                            ultricies. In ultrices malesuada elit mauris.</p>
                    </li>
                </ul>
            </div>
            <div class="custom-con">
                <ul class="">
                    <li class="f-Right bg-transparent position-relative">
                        <h1 class="parenting-faq-head text-dark">Lorem ipsum dolor sit amet,sectetur adipiscing elit.</h1>
                        <p class="parenting-faq-text mt-2 text-dark opacity-50">“Arcu at dictum sapien, mollis. Vulputate sit id
                            accumsan, ultricies. In ultrices malesuada elit mauris.</p>
                    </li>
                    <li class="second-Right">
                        <h1 class="parenting-faq-head">Lorem ipsum dolor sit amet,sectetur adipiscing elit.</h1>
                        <p class="parenting-faq-text mt-2">“Arcu at dictum sapien, mollis. Vulputate sit id accumsan,
                            ultricies. In ultrices malesuada elit mauris.</p>
                    </li>
                    <li class="third-Left bg-transparent">
                        <h1 class="parenting-faq-head text-dark">Lorem ipsum dolor sit amet,sectetur adipiscing elit.</h1>
                        <p class="parenting-faq-text mt-2 text-dark opacity-50">“Arcu at dictum sapien, mollis. Vulputate sit id
                            accumsan, ultricies. In ultrices malesuada elit mauris.</p>
                    </li>
                </ul>
            </div>




        </div>
    </section>
    <section class="parenting-section section6">
        <div class="container d-flex col-12 section6 blur-effect position-relative">
            <div class="col-12 d-flex justify-content-between align-items-center pt-4 pb-4 section6 star-bg"
                style="background-image: url('../public/images/P-backgroundLast.png');
                background-repeat: no-repeat;
                background-size: cover;
                ">
                <div class="last-sec-btns">
                    <h1 class="bottom-heading">ready to get started?</h1>
                    <p class="bottom-text mt-3">Risus habitant leo egestas mauris diam eget morbi tempus vulputate.</p>
                    <div class="d-inline-flex gap-4">
                        <button class="border-0 app-btns"> <img src="{{ asset('public/images/apple.svg') }}"
                                alt="">
                            download app</button>
                        <button class="border-0 app-btns"><img src="{{ asset('public/images/play.svg') }}"
                                alt="">download app</button>

                    </div>
                </div>
                <div>
                    <img src="{{ asset('public/images/P-lastFront.png') }}" alt="">
                </div>

            </div>
        </div>
    </section>
@endsection
