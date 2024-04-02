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

<head>
    <style>
        *,
        html {
            scroll-behavior: smooth;
        }

        *,
        :root {
            /* --white: #fff; */
            --white: #f9f9f9;
            --black: #000;
            --dark: #2a2a2e;
            --purple: #835ec1;
            --darkpurple: #ED956F;
            --red: #fe3e30;
            --darkred: #f72729;
            --blue: #2588cf;
            --darkblue: #026dbe;
            --defaultfont: "Poppins", sans-serif;
            --titlefont: "Roboto", sans-serif;
        }

        /********************************
            DEFAULT
        *********************************/
        body {
            margin: 0;
            overflow-x: hidden !important;
            /* font-family: var(--defaultfont); */
            font-family: var(--Aristotelica);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a,
        button,
        input,
        select,
        p {
            outline: none !important;
            transition: 0.5s;
        }

        em {
            font-style: normal;
            color: var(--primary);
        }

        /* img {
            max-width: 100%;
        } */

        figure {
            margin: 0;
            padding: 0;
        }

        .field {
            width: 100%;
            border: 0;
            padding: 0;
            margin: 0;
        }

        .title {
            /* font-family: var(--titlefont); */
            font-family: var(--Aristotelica);
        }

        .btn1,
        .btn2 {
            padding: 1rem 2rem;
            border-radius: 10px;
            text-align: center;
            border: 0;
        }

        .btn1 {
            background-color: var(--purple);
            color: var(--white);
        }

        .btn1:hover {
            background-color: var(--darkpurple);
        }

        .btn2 {
            background-color: var(--red);
            color: var(--white);
        }

        .btn2:hover {
            background-color: var(--darkred);
        }

        /********************************
            HEADER
        *********************************/
        .articleHeader {
            width: 100%;
            /* display: flex; */
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .articleHeader section {
            width: auto;
            padding: 8rem 1rem;
            position: relative;
            color: var(--white);
        }

        .articleHeader section:after {
            content: "";
            position: absolute;
            /* background-color: var(--purple); */
            background: linear-gradient(90.27deg, #845dc2 -27.96%, #f99327 -27.94%, #d55fad 28.41%, #845dc2 82.13%, #845dc2 130.57%);
            height: 4px;
            /* width: 100px; */
            width: 185px;
            left: 50%;
            transform: translate(-50%, 0);
        }

        .articleHeader .title {
            font-size: 3em;
            font-family: 'Aristotelica';
            padding: 2rem;
            padding-bottom: 5px;
            background: linear-gradient(90.27deg, #845dc2 -27.96%, #f99327 -27.94%, #d55fad 28.41%, #845dc2 82.13%, #845dc2 130.57%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        .btnWidth {
            width: 100%;
        }

        .articleHeader section span {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translate(-50%, 0);
            background-color: var(--purple);
            /* background: linear-gradient( 90.27deg, #845dc2 -27.96%, #f99327 -27.94%, #d55fad 28.41%, #845dc2 82.13%, #845dc2 130.57% ); */
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
            white-space: nowrap;
        }

        .articleHeader a:hover {
            color: var(--dark);
        }


        .articleHeader .active {
            color: var(--dark);
            pointer-events: none;
        }

        @media (max-width: 1000px) {
            .articleHeader section .title {
                font-size: 1.5em;
                line-height: 0.8;
            }
        }

        /********************************
          BLOG CONTAINER
        *********************************/
        .blog_container {
            width: 100%;
            display: flex;
            align-items: top;
            /* background-color: #f1f1f1; */
            background-color: #fff;

        }

        /*BLOG LEFT CONTENT*/
        .blog_content {
            padding: 2rem;
            width: 100%;
            padding-top: 10px;
        }

        .blog_content .load-btn {
            display: block;
            width: 150px;
            margin: 5vh auto;
        }

        .left_content {
            display: flex;
            align-items: top;
            justify-content: space-between;
            flex-wrap: wrap;
            column-count: 2;
            gap: 20px 10px;
            flex: 0 0 70%;
        }

        .right_content {
            flex: 0 0 30%;
        }

        .blog_card {
            width: 100%;
            flex: 0 0 48.5%;
            overflow: hidden;
            background-color: var(--white);
            border-radius: 10px;
        }

        .blog_card:nth-child(1) {
            flex: 0 0 100%;
        }

        .blog_card .figure {
            display: block;
            width: 100%;
            height: 200px;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .blog_card:nth-child(1) .figure {
            height: 300px;
        }

        .blog_card .figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .blog_card .tag {
            padding: 5px 10px;
            background-color: var(--purple);
            color: var(--white);
            position: absolute;
            right: 1%;
            top: 3%;
            font-size: 12px;
            border-radius: 10px;
        }

        .blog_card section {
            padding: 1rem;
            position: relative;
            background-color: var(--white);
        }

        .blog_card section .title {
            font-weight: 600;
            font-size: 18px;
            color: var(--dark);
            width: auto;
        }

        .blog_card section a:hover {
            color: var(--purple);
        }

        .blog_card:hover>.figure img {
            transform: scale(1.1);
        }

        .share_icon {
            position: absolute;
            bottom: -30px;
            left: 10px;
            background-color: var(--red);
            color: var(--white);
            display: flex;
            align-items: center;
            padding-right: 5px;
            font-size: 13px;
            cursor: pointer;
            transition: 0.5s;
        }

        .share_icon .fa {
            padding: 5px;
            background-color: var(--darkred);
            margin-right: 10px;
        }

        .blog_card section img {
            width: 30%;
            margin-right: 20px;
            object-fit: cover;
            border: 5px solid rgba(1, 1, 1, 0.1);
        }

        .blog_card section img:nth-child(even) {
            float: left;
        }

        .blog_card section img:nth-child(odd) {
            float: right;
        }

        /*BLOG RIGHT CONTENT*/
        .columns {
            display: block;
            margin-bottom: 4vh;
            background-color: var(--white);
            border-radius: 10px;
        }

        .columns section {
            padding: 1rem;
        }

        .columns .title {
            /* background-color: var(--purple); */
            background: linear-gradient(90.27deg, #845dc2 -27.96%, #f99327 -27.94%, #d55fad 28.41%, #845dc2 82.13%, #845dc2 130.57%);
            /* color: var(--white); */
            color: #fff;
            padding: 1rem;
            text-align: left;
            width: 100%;
            display: block;
            transition: 0.2s;
            border-left: 0px solid var(--dark);
            border-radius: 10px;
        }

        .columns:hover>.title {
            /* border-left: 5px solid var(--dark); */
            border-left: 5px solid #835ec1;
        }

        .columns .title a {
            float: right;
        }

        .columns .title a:hover {
            color: var(--dark);
        }

        .search form {
            margin: 0;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .search .field:nth-child(2) {
            width: 20%;
        }

        .search form input {
            border: 1px solid rgba(1, 1, 1, 0.1);
            padding: 0.75rem;
            width: 100%;
            font-weight: 600;
            color: rgba(1, 1, 1, 0.5);
        }

        .search .btn1 {
            border: 1px solid var(--purple);
            border-radius: 0;
        }

        /*BOOKS*/
        .books .cards {
            position: relative;
            width: 100%;
            height: 46vh;
            overflow: hidden;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .books .cards::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            z-index: 900;
            display: block;
            width: 100%;
            height: 100%;
        }

        .books .card_part {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 7;
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            background-size: 100% 100%;
            background-position: center;
            transform: translateX(700px);
            background-repeat: no-repeat;
            animation: opaqTransition 28s cubic-bezier(0, 0, 0, 0.97) infinite;
            background-color: #f9f9f9;
        }

        .books .card_part.card_part-2 {
            z-index: 6;
            animation-delay: 7s;
            background-repeat: no-repeat;
        }

        .books .card_part.card_part-3 {
            z-index: 5;
            animation-delay: 14s;
            background-repeat: no-repeat;
        }

        .books .card_part.card_part-4 {
            z-index: 4;
            animation-delay: 21s;
            background-repeat: no-repeat;
        }

        @keyframes opaqTransition {
            3% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(0);
            }

            28% {
                transform: translateX(-700px);
            }

            100% {
                transform: translateX(-700px);
            }
        }

        /*CATEGORIES*/
        .categories a {
            display: inline-block;
            padding: 0.2rem 1rem;
            border-radius: 40px;
            background-color: rgba(1, 1, 1, 0.3);
            margin: 5px 3px;
            font-size: 12px;
            white-space: nowrap;
            color: var(--white);
        }

        .categories a:hover {
            /* background-color: var(--dark); */
            background-color: #835ec1;
        }

        /*POSTS*/
        .posts a {
            display: flex;
            align-items: center;
            margin: 0.4rem 0;
        }

        .posts a img {
            width: 100px;
            margin-right: 10px;
        }

        .posts a:hover>p {
            /* color: var(--black); */
            color: #835ec1;

        }

        /*COMMENTS*/
        .comments {
            position: relative;
            overflow: hidden;
            max-height: 60vh;
            border-radius: 10px;
        }

        .marquee2 {
            position: relative;
            overflow: hidden;
            line-height: 1.6em;
        }

        .marquee2 p {
            border-bottom: 1px solid rgba(1, 1, 1, 0.1);
            position: relative;
            padding: 0.4rem 0;
        }

        .marquee2 p:before {
            content: "\f10d";
            /* font-family: "FontAwesome"; */
            font-family: "Aristotelica";
            margin-right: 5px;
            position: relative;
            top: -5px;
        }

        @keyframes marquee1 {
            0% {
                top: 10%;
            }

            100% {
                top: -100%;
            }
        }

        /*SOCIAL MEDIA*/
        .social_icons {
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 15px;
            background-color: transparent;
        }

        .social_icons .fa {
            padding: 7px 13px;
            background-color: #f9f9f9;
            color: var(--white);
            transition: 0.2s;
            border-radius: 10px;
        }

        .social_icons a:hover>.fa {
            transform: scale(1.1);
        }

        .social_icons .fa-facebook {
            background-color: #3b5998;
        }

        .social_icons .fa-instagram {
            background-color: #fb3958;
        }

        .social_icons .fa-youtube {
            background-color: #c4302b;
        }

        .social_icons .fa-whatsapp {
            background-color: #25d366;
        }

        .social_icons .fa-telegram {
            background-color: #3399ff;
        }

        @media (max-width: 1000px) {
            .blog_container {
                flex-wrap: wrap;
            }

            .blog_content {
                padding: 0;
                /* order: 2; */
            }

            .left_content {
                flex: 0 0 100%;
                order: 2;
                padding: 1rem;
            }

            .right_content {
                flex: 0 0 100%;
                order: 1;
                padding: 1rem;
            }

            .books,
            .posts,
            .comments,
            .categories {
                display: inline-block;
                width: 47%;
                margin: 1.3%;
                margin-bottom: 0;
                vertical-align: top;
                height: 63vh;
            }

            .posts {
                overflow-y: auto;
            }

            .right_content {
                flex: 0 0 100%;
            }
        }

        @media (max-width: 740px) {
            .blog_card {
                flex: 0 0 100%;
            }

            .posts,
            .comments,
            .books,
            .categories {
                width: 100%;
                margin: 0;
                height: auto;
                margin-bottom: 4vh;
            }
        }

        /*REMOVE THIS*/
        .credits {
            position: fixed;
            right: 0;
            bottom: 2%;
            background-color: #1e1e1e;
            padding: 0.5rem;
            font-size: 12px;
            z-index: 999;
            color: rgba(255, 255, 255, 0.7);
        }

        .credits a {
            color: rgba(255, 255, 255, 0.7);
        }

        .credits a:hover {
            color: white;
        }

        .credits .btn0 {
            background-color: white;
            color: #000;
            padding: 5px;
            border-radius: 5px;
            border: 0;
            display: block;
            margin: 1vh auto;
            width: 100px;
            text-align: Center;
        }

        .credits .btn0:hover {
            color: black;
            background-color: #b8bca7;
        }

        .custom {
            width: 80%;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

@section('content')
    <body>
        {{-- <div class="articleHeader container-xxl">
            <h1 class="title">
                @if (count($categories) > 0)
                    Category: {{ $categories[0]->name }}
                @else
                    Articles
                @endif
            </h1>
        </div> --}}
        <div class="articleHeader container-xxl">
            <h1 class="title">
                @if (count($categories) > 0)
                    Category: {{ $categories[0]->name }}
                @endif
            </h1>
        </div>
        

        <!--BLOG SECTION-->
        <div class="blog_container container-xxl">
            <div class="blog_content">
                <div class="left_content">
                    <!--MAIN CARD BEGINING-->
                    <div class="blog_card">
                        <a href="{{ route('article', $article_category->id) }}" class="figure">
                            <img src="{{ asset('public/assets/images/articles/category/thumbnail/' . $article_category->image) }}"
                                alt="" loading="lazy" />
                            <span class="tag">{{ date_format($article_category->created_at, 'd-M-Y h:i:s A') }}</span>
                        </a>
                        <section>
                            <a href="{{ route('article', $article_category->id) }}" class="title">{{ $article_category->name }}</a>
                            <p>
                                {{ mb_strimwidth($article_category->tag_line, 0, 300, "...") }}
                                <a href="{{ route('article', $article_category->id) }}">Read more</a>
                            </p> 
                        </section>
                    </div>
                    <!--CARD ENDS-->
                    @foreach ($article_category->articles as $article)
                        <!--CARD BEGINING-->
                    <div class="blog_card{{ $loop->index >= 6 ? ' additional-card hidden' : '' }}">
                        <a href="{{ route('article', $article->id) }}" class="figure">
                            <img src="{{ asset('public/assets/images/articles/thumbnail/' . $article->thumbnail) }}" alt="" loading="lazy" />
                            <span class="tag">{{ date_format($article->created_at,'d-M-Y h:i:s A') }}</span>
                        </a>
                        <section>
                            <a href="{{ route('article', $article->id) }}" class="title">{{ $article->title }}</a>
                            <p>
                                {{-- @php
                                    $text = $article->text;
                                    $wordCount = str_word_count($text);
                                    $limitedText = implode(' ', array_slice(str_word_count($text, 1), 0, 34));
                                    echo $limitedText . ($wordCount > 34 ? "..." : "");
                                @endphp --}}
                                @php
                                    $words = str_word_count($article->text, 1);
                                    $limitedText = implode(' ', array_slice($words, 0, 34));
                                    echo $limitedText . (count($words) > 34 ? '...' : '') . ' <a href="' . route('article', $article->id) . '">Read more</a>';
                                @endphp  
                            </p>
                        </section>
                    </div>                    
                        <!--CARD ENDS-->
                    @endforeach
                </div>
                <button class="btn1 load-btn">Load more</button>
            </div>

            <div class="blog_content right_content">
                <!--SEARCH COLUMN BEGINING-->
                <div class="columns search_column">
                    <section class="search">
                        <form>
                            <div class="field custom">
                                <input type="text" name="search" placeholder="Search..." maxlength="100"
                                    required="" />
                            </div>
                            <div class="field">
                                <button type="submit" class="btn1 btnWidth">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
                <!--SEARCH COLUMN ENDS-->
                <!--BOOKS COLUMN BEGINING-->
                <div class="columns books">
                    <span class="title">New Books
                        <a href="#" title="Explore More"><i class="fa fa-share"></i></a></span>
                    <section>
                        @foreach ($article_category->articles as $article)
                            <div class="cards">
                                <div class="card_part card_part-{{ $loop->iteration }}"
                                    style="background-image: url({{ asset('public/assets/images/articles/thumbnail/' . $article->thumbnail) }});">
                                </div>
                        @endforeach
                </div>
                </section>
            </div>
            <!--BOOKS COLUMN ENDS-->
            <!--CATEGORIES COLUMN BEGINING-->
            <div class="columns categories">
                <span class="title">Categories</span>
                <section>
                    @foreach ($categories as $category)
                        <a href="{{ route('articles.category', $category->id) }}">{{ $category->name }}</a>
                    @endforeach
                </section>
            </div>
            <!--CATEGORIES COLUMN ENDS-->
            <!--POSTS COLUMN BEGINING-->
            <div class="columns posts">
                <span class="title">Recent Posts
                    <a href="#" title="Explore More"><i class="fa fa-share"></i></a></span>
                <section>
                    @foreach ($article_category->articles as $article)
                        <a href="#"><img
                                src="{{ asset('public/assets/images/articles/thumbnail/' . $article->thumbnail) }}"
                                alt="" loading="lazy" />
                            <p>{{ $article->title }}</p>
                        </a>
                    @endforeach

                </section>
            </div>
            <!--POSTS COLUMN ENDS-->
            <!--COMMENTS COLUMN BEGINING-->
            <div class="columns comments">
                <span class="title">
                    Recent Comments
                    <a href="#" title="Explore More"><i class="fa fa-share"></i></a></span>
                <section>
                    <marquee direction="up" scrollamount="4" onMouseOver="this.stop()" onMouseOut="this.start()"
                        class="marquee2">
                        <p>
                            <span class="bi bi-chat-right-dots me-2"></span>
                            Remember, torn clothes should not be left at home. Dispose of
                            them out. Buying new clothes like towels.
                        </p>
                        <p>
                            <span class="bi bi-chat-right-dots me-2"></span>
                            wearing clothes, bedsheets are like inviting good luck to the
                            home.
                        </p>
                        <p>
                            <span class="bi bi-chat-right-dots me-2"></span>
                            Arrange doormats before every door and please change the
                            doormats once in 6/8 months or maximum within 1 year. For More
                            Daily
                        </p>
                    </marquee>
                </section>
            </div>
            <!--COMMENTS COLUMN ENDS-->
            <!--SOCIAL MEDIA ICONS BEGINING-->
            <div class="columns social_icons">
                <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
                <a href="#" title="Youtube"><i class="fa fa-youtube"></i></a>
                <a href="#" title="Whatsapp"><i class="fa fa-whatsapp"></i></a>
                <a href="#" title="Telegram"><i class="fa fa-telegram"></i></a>
            </div>
            <!--SOCIAL MEDIA ICONS ENDS-->
        </div>
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadBtn = document.querySelector('.load-btn');
            const hiddenCards = document.querySelectorAll('.additional-card');
            let currentIndex = 0; // Keep track of the index of the first hidden card to show

            loadBtn.addEventListener('click', function() {
                // Show the next 6 hidden cards or less if there are fewer than 6 remaining
                for (let i = currentIndex; i < currentIndex + 6 && i < hiddenCards.length; i++) {
                    hiddenCards[i].classList.remove('hidden');
                }
                // Update the current index for the next batch of cards
                currentIndex += 6;

                // Hide the button if all cards are displayed
                if (currentIndex >= hiddenCards.length) {
                    loadBtn.style.display = 'none';
                }
            });
        });
    </script>
@endsection
