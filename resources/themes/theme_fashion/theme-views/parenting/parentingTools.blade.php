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
        transition: color 0.3s ease, background 0.3s ease, border 0.3s ease ;
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

    .ready-to-start {
        display: flex;
    }

    .btns {
        display: inline-flex;
    }
    .download-btn:hover{
        background: #ff9670 ;
        border: 2px solid #ff9670;
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
        .section2 .container , .section4 .container{
            flex-direction: column-reverse;
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
</style>
@section('content')
    <section class="parenting-section section1">
        <div class="container d-flex mt-5">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 parenting-content position-relative">
                <h1>Bachay.com</h1>
                <p class="mt-3">Your one-stop Solution to Happy Parenting and Magical Childhood.</p>
                <div class="d-flex align-items-center gap-3 mt-4">
                    <a href="#parenting-section-last">
                        <button class="download-btn"><i class="bi bi-arrow-down"></i> Download App</button>

                    </a>
                    <button class="border-0 bg-transparent watchvideo-btn d-inline-flex gap-2"><i
                            class="bi bi-play-circle"></i> watch video</button>

                </div>
                <div class="mt-4 addvertisment-img position-relative">
                    <div class="card_animation">
                        <img src="{{ asset('public/images/P-firstLeft.png') }}" alt="" width="90%">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3 parenting-img position-relative">
                <div class="card_animation">
                    <img src="{{ asset('public/images/P-firstRight.png') }}" alt="" width="100%">
                </div>
            </div>


        </div>
    </section>

    <section class="parenting-section section2">
        <div class="container d-flex align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card_animation">
                    <img src="{{ asset('public/images/P-secondLeft.png') }}" alt="" width="100%">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h3 class="features">
                    features
                </h3>
                <h1 class="Porfessionals bg-blurimg ">
                    Parenting by Porfessionals
                </h1>
                <ul class="mt-4">
                    <li>
                        <img src="{{ asset('public/images/question.svg') }}" alt=""> <span
                            class="question">Questions & Answers By Parents:</span>
                        <p class="question-para mt-3">Get expert advice! Real parents ask, and child specialists answer. You
                            will find all the support and solutions for your parenting journey at this destination!</p>
                    </li>
                    <li>
                        <img src="{{ asset('public/images/Q.svg') }}" alt=""> <span class="question">Quizzes For
                            Children:</span>
                        <p class="question-para mt-3">Make learning fun and delightful! Interactive quizzes spark curiosity,
                            test intelligence, and make an enjoyable experience across various age groups.</p>
                    </li>
                    <li>
                        <img src="{{ asset('public/images/V.svg') }}" alt=""> <span class="question">Vaccination
                            and Growth Tracker:</span>
                        <p class="question-para mt-3">Stay informed and on the right track! Monitoring your child's
                            immunizations has never been so easy before! Follow growth milestones conveniently with our
                            easy-to-use tracker.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="parenting-section section3">
        <div class="container d-flex align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                        <p class="question-para mt-3">Dump messy notes and spreadsheets! Your child’s vaccinations and
                            growth can now be managed smoothly with our user-friendly tracker. Get personalized reminders,
                            get access to expert insights, and guarantee your child stays on track for optimal health and
                            development. It's a state of peacefulness and convenience at your fingertips.
                        </p>
                    </li>

                </ul>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 why-choose-parenting-img position-relative">
                <div class="card_animation">
                    <img src="{{ asset('public/images/P-thirdRight.png') }}" alt="" width="100%">
                </div>
            </div>

        </div>
    </section>
    <section class="parenting-section section4">
        <div class="container d-flex align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 why-choose-parenting-img position-relative">
                <div class="card_animation">
                    <img src="{{ asset('public/images/P-fourthLeft.png') }}" alt="" width="100%">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                <ul class="mt-4">
                    <li>
                        <div class="d-inline-flex align-items-center Quiz-heading position-relative">
                            <img src="{{ asset('public/images/star-orange.svg') }}" alt="">
                            <span class="growth-tracker">Quiz Challenges</span>

                        </div>
                        <p class="question-para mt-3">Go beyond rote learning and empower young minds with our interactive
                            quiz challenges! Tailored to various age groups and interests. These quizzes are customized to
                            different age groups that test intelligence and increase curiosity enjoyably and engagingly.
                            This keeps the children entertained as they learn new things. Watch their confidence flourish as
                            they tackle challenges and make new and exciting discoveries.</p>
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
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 testimonials position-relative">
                <div class="card_animation">
                    <img src="{{ asset('public/images/P-fifthRight.png') }}" alt="" width="100%">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                <ul class="mt-4">
                    <li>
                        <div class="d-inline-flex align-items-center Quiz-heading position-relative">

                            <span class="parent-testimonial-heading">An Amazing Experience!</span>

                        </div>
                        <p class="question-para mt-4">“I used to dread shopping for kid's clothes and toys. So many
                            choices,
                            and never enough time! Bachay.com changed everything. Their structured selection saves me hours,
                            and the quality is amazing. Plus, the vaccination tracker keeps me organized, and the quizzes
                            are perfect for bonding time with my kids. This app is a lifesaver!”</p>
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
                        <h1 class="parenting-faq-head">How do I place an order on your website?</h1>
                        <p class="parenting-faq-text mt-2">“You can place an order by browsing our website, and adding
                            items to your
                            cart, and follow the checkout steps”</p>
                    </li>
                    <li class="f-Left bg-transparent text-dark">
                        <h1 class="parenting-faq-head text-dark">“What payment methods do you accept?</h1>
                        <p class="parenting-faq-text mt-2 text-dark opacity-50">“We accept payment by credit card, debit
                            card, online banking as well as COD”</p>
                    </li>
                    <li class="third-Left">
                        <h1 class="parenting-faq-head">Can I cancel or modify my order after I place it?</h1>
                        <p class="parenting-faq-text mt-2">“Yes, you can cancel or modify your order within 24 hours of
                            placing it. Please contact customer service for assistance”</p>
                    </li>
                </ul>
            </div>
            <div class="custom-con">
                <ul class="">
                    <li class="f-Right bg-transparent position-relative">
                        <h1 class="parenting-faq-head text-dark">What are the sizes and materials of your clothes?</h1>
                        <p class="parenting-faq-text mt-2 text-dark opacity-50">“You can find the size and material
                            information for each product on its product page”</p>
                    </li>
                    <li class="second-Right">
                        <h1 class="parenting-faq-head">What is your return policy?</h1>
                        <p class="parenting-faq-text mt-2">“You can return or exchange any item within 30 days of purchase,
                            as long as it is in its original condition with tags attached”</p>
                    </li>
                    <li class="third-Left bg-transparent">
                        <h1 class="parenting-faq-head text-dark">How long does it take to ship my order?</h1>
                        <p class="parenting-faq-text mt-2 text-dark">“Standard shipping typically takes 3-5 business days.
                            We also offer expedited shipping options for an additional fee”</p>
                    </li>
                </ul>
            </div>




        </div>
    </section>
    <section id="parenting-section-last" class="parenting-section section6">
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
@endsection
