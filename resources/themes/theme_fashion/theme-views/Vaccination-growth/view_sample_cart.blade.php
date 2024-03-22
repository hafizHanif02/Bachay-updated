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
    .breadcrumb li:not(:last-child)::after {
        content: '' !important;
        margin: 0 !important;
    }

    .vaccination-growth-container {
        margin: 0 100px 100px 100px;
    }

    .vaccination-mainp {
        width: 70%;
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 0 10px 10px 10px;
    }
    .vaccine_main{
        margin: 10px 0 0 0;
    }
    .downloadApp-right {
        width: 30%;
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 16px 20px 20px 19px;
    }

    .child-profile {
        width: 100%;
        background-color: #f5f5f5;
        border: 1px solid #ededed;
        padding: 24px 24px 19px 44px;
        overflow: hidden;
    }

    .child-profile img {
        border: 5px solid #fff;
    }

    .vc_title {
        background-color: #f5f5f5;
        text-transform: capitalize;
        height: initial;
        margin-bottom: 16px;
        padding: 10px;
        border-bottom: 1px solid #eee;
        background: #eee;
        border-radius: 3px;

    }

    .vacci-growthB,
    .vaccination_tr {
        border: 1px solid #ededed;

    }

    .custom-dt-clr {
        font-weight: 500;
        color: #616161;
        font-size: 16px;
    }

    .vc_upcoming {
        border: 2px solid #feb134;
        border-radius: 50%;
        padding: 2px;
    }

    .vc_upcoming-child {
        width: 80px;
        height: 80px;
        background: #feb134;
        border-radius: 50%;
    }

    .overdue {
        border: 2px solid #ea514e;
        border-radius: 50%;
        padding: 2px;
    }

    .overdue-child {
        width: 80px;
        height: 80px;
        background: #ea514e;
        border-radius: 50%;
    }

    .vc_comppleted {
        border: 2px solid #8cbc59;
        border-radius: 50%;
        padding: 2px;
    }

    .vc_comppleted-child {
        width: 80px;
        height: 80px;
        background: #8cbc59;
        border-radius: 50%;
    }

    .vc_num_count {
        font-size: 22px;
        font-weight: 500;
        line-height: 33px;
    }

    .view_gr_tr a {
        text-align: center;
        text-transform: uppercase;
        border-radius: 3px;
        border: 1px solid #ededed;
        padding: 5px 40px;
        width: 400px;
        color: #424242;
        font-size: 15px;
        line-height: 21px;
    }

    .view_vc_tr a {
        width: 400px;
        background: #f56996;
        text-align: center;
        text-transform: uppercase;
        border-radius: 3px;
        color: #424242;
        font-size: 16px;
        line-height: 21px;
        padding: 10px 40px;
    }

    .Add_growth_child {
        color: #f56996;
        background: none;
        text-transform: capitalize;
        font-size: 17px;
        font-weight: 600;
        line-height: 24px;
        font-family: 'poppins'

    }

    .vaccination-table-growth tr td {
        font-size: 14px;
        color: #757575;
        font-family: 'poppins';
        font-weight: 400;
    }
    .Add_child_gr tr td input{
        border-bottom: 1px solid #000;
        border-top: none; border-left: none; border-right: none;
    }
    .Add_child_gr tr td input:focus-visible{
        border-bottom: 1px solid #000;
        border-top: none; border-left: none; border-right: none;
    }
    .Add_child_gr tr td input:focus {
    border-bottom: 1px solid #000;
    border-top: none;
    border-left: none;
    border-right: none;
}

    .Add_child_gr tr td select{
        border: none;
    }
    @media only screen and (max-width: 768px) {
        .vaccination-growth-container {
            margin: 0 0 100px 0;
        }
        .vaccination-mainp{
            width: 100%;
        }
        .downloadApp-right{
            display: none;
        }
        .view_vc_tr a , .view_gr_tr a{
            width: fit-content;
        }
    }
</style>
@section('content')
    <div class="container">
        <div class="vaccination-growth-container">
            
            <h3 class="mt-4">Sample Chart | Vaccination</h3>
            <hr>
            <div class="vaccination-growth-child-container d-flex">
                <div class="vaccination-mainp">
                    <img src="{{ asset('public/images/growth-chart-image.png') }}" alt="" width="100%">
                </div>
                <div class="downloadApp-right">

                </div>
            </div>





        </div>

    </div>
@endsection
