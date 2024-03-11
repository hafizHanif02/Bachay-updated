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
    .custom-main-container {
    display: flex;
    flex-wrap: wrap;
  }

  .column {
    flex: 0 0 33.33%; 
  }

  .column a {
    display: block;
    text-align: center;
    text-decoration: none;
    color: #333;
  }

  .column img {
    max-width: 100%;
    height: auto;
    margin-bottom: 5px;
  }

 
</style>

@section('content')
 <div class="custom-page-banner">
    <a href="">
        <img src="{{ asset('public/images/cp1.gif') }}" alt="" width="100%">
        <img src="{{ asset('public/images/cp2.webp') }}" alt="" width="100%">   

    </a>

 </div>
<div class="mt-3 mb-3">
<a href="">
    <img src="{{ asset('public/images/cp3.webp') }}" alt="" width="100%">

</a>

</div>
<div class="container">
    <div class="custom-main-container mt-2 mb-2 d-md-none d-lg-none d-xl-none ">
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/cp4.webp') }}" alt="Image 1">

            {{-- <h3>Heading 1</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/cp5.webp') }}" alt="Image 1">

    
            {{-- <h3>Heading 2</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/cp6.webp') }}" alt="Image 1">

    
            {{-- <h3>Heading 3</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/cp7.webp') }}" alt="Image 1">

    
            {{-- <h3>Heading 4</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/cp8.webp') }}" alt="Image 1">

    
            {{-- <h3>Heading 5</h3> --}}
          </a>
        </div>
        <div class="column">
            <a href="#">
              <img src="{{ asset('public/images/cp9.webp') }}" alt="Image 1">
  
      
              {{-- <h3>Heading 5</h3> --}}
            </a>
          </div>
       

    </div>
</div>
<div class="custom-page-banner" style="margin-bottom: 120px;">
    <a href="">

        <img src="{{ asset('public/images/p2.webp') }}" alt="" width="100%">

    </a>
    

 </div>

@endsection
