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
    <div>
        <img src="{{ asset('public/images/explore1.webp') }}" alt="" width="100%">
    </div>

    <div class="scroll-container newCatLanding ps-2">
        <a href="">
            <img src="{{ asset('public/images/explore-fashion.webp') }}" alt="">

        </a>
        <a href="">

            <img src="{{ asset('public/images/explore-partywear.webp') }}" alt="">

        </a>
        <a href="">

            <img src="{{ asset('public/images/explore-beautycare.webp') }}" alt="">
        </a>
        <a href="">

            <img src="{{ asset('public/images/explore-toys.webp') }}" alt="">
        </a>

    </div>
    <div>
        <img src="{{ asset('public/images/summer.webp') }}" alt="" width="100%">
    </div>
    <div class="scroll-container brand-container ps-2">
        <a href="">
            <img src="{{ asset('public/images/1girl.webp') }}" alt="">

        </a>
        <a href="">

            <img src="{{ asset('public/images/2boy.webp') }}" alt="">

        </a>
        <a href="">

            <img src="{{ asset('public/images/3-child.webp') }}" alt="">
        </a>
        <a href="">

            <img src="{{ asset('public/images/4-boy.webp') }}" alt="">
        </a>
        <a href="">

            <img src="{{ asset('public/images/5-girl.webp') }}" alt="">
        </a>
    </div>
    <div>
        <img src="{{ asset('public/images/special-summer.webp') }}" alt="" width="100%">
    </div>

    <div class="scroll-container newArrival ps-2">
        <a href="">
            <img src="{{ asset('public/images/sum1.webp') }}" alt="">
            <p class="text-center m-0 text-secondary fw-bold">SUNNY DAY OUTFITS</p>
            <p class="text-center m-0 text-secondary">SHOP NOW</p>

        </a>
        <a href="">

            <img src="{{ asset('public/images/sum2.webp') }}" alt="">
            <p class="text-center m-0 text-secondary fw-bold">MUST HAVE LOOKS</p>
            <p class="text-center m-0 text-secondary">SHOP NOW</p>


        </a>
        <a href="">

            <img src="{{ asset('public/images/3sum.webp') }}" alt="">
            <p class="text-center m-0 text-secondary fw-bold">TINY EXPLORERS</p>
            <p class="text-center m-0 text-secondary">SHOP NOW</p>


        </a>
        <a href="">

            <img src="{{ asset('public/images/4sum.webp') }}" alt="">
            <p class="text-center m-0 text-secondary fw-bold">OUTDOOR ADVENTURES</p>
            <p class="text-center m-0 text-secondary">SHOP NOW</p>

        </a>

    </div>
    <div class="mt-2">
        <img src="{{ asset('public/images/change-ming.webp') }}" alt="" width="100%">
    </div>
    <div>
        <img src="{{ asset('public/images/parenting-explore.webp') }}" alt="" width="100%">
    </div>
    <div class="scroll-container parenting-blogs ps-2">
        <a href="">
            <img src="{{ asset('public/images/parenting-blog1.webp') }}" alt="">

        </a>
        <a href="">

            <img src="{{ asset('public/images/parenting-blog2.webp') }}" alt="">

        </a>
        <a href="">

            <img src="{{ asset('public/images/parenting-blog3.webp') }}" alt="">
        </a>
        <a href="">

            <img src="{{ asset('public/images/parenting-blog4.webp') }}" alt="">
        </a>
        <a href="">

            <img src="{{ asset('public/images/parenting-blog5.webp') }}" alt="">
        </a>
        <a href="">

            <img src="{{ asset('public/images/parenting-blog6.webp') }}" alt="">
        </a>
        <a href="">

            <img src="{{ asset('public/images/parenting-blog7.webp') }}" alt="">
        </a>
    </div>
    <div>
        <img src="{{ asset('public/images/ex-footer.webp') }}" alt="" width="100%">
    </div>
@endsection
