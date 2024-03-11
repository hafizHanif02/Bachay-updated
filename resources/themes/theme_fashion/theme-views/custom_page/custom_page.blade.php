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
    .custom-main-con {
        display: flex;
        flex-wrap: wrap;
    }

</style>

@section('content')
<div class="custom-main-con">
    @foreach ($custom_page->page_data as $page_data)
        <div class="custom-page-banner" style="width: {{ $page_data->width }}%; margin-right: {{ $page_data->margin_right }}px; margin-bottom: {{ $page_data->margin_bottom }}px;">
            <a href="">
                <img src="{{ asset('public/assets/images/customePage/' . $custom_page->id . '/' . $custom_page->resource_id . '/' . $page_data->image) }}"
                    alt="" width="100%">
            </a>
        </div>
    @endforeach
</div>
@endsection
