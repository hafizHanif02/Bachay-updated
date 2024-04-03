@extends('theme-views.layouts.parenting-header')

@push('css_or_js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        margin: 0 70px 100px 70px;
    }

    .vaccination-mainp {
        width: 70%;
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 0 10px 10px 10px;
    }

    .vaccine_main {
        margin: 10px 0 0 0;
    }

    .btn_clr {
        background: #f56996;
        border: none;
        color: #fff;
        border: 1px solid #f56996;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .btn_clr:hover {
        background: #fff;
        border: 1px solid #f56996;
        color: #f56996;
    }

    .downloadApp-right {
        width: 30%;
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 16px 10px 20px 10px;
    }

    .downloadApp-right {
        padding-bottom: 0;
        background-image: url(https://cdn.cdnparenting.com/brainbees/community/preact/public/media/Personalization_BG.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-origin: content-box;
        background-position: bottom;
        height: 98vh;
        overflow-y: auto;
        position: sticky;
        top: 5px;
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

    .Add_child_gr tr td input {
        border-bottom: 1px solid #000;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .Add_child_gr tr td input:focus-visible {
        border-bottom: 1px solid #000;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .Add_child_gr tr td input:focus {
        border-bottom: 1px solid #000;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .downloadApp-right h6 {
        font-size: 14px;
        font-weight: 600;
        color: #424242;
        text-align: center;
    }

    .Add_child_gr tr td select {
        border: none;
    }

    @media only screen and (max-width: 768px) {
        .vaccination-growth-container {
            margin: 0 0 100px 0;
        }

        .vaccination-mainp {
            width: 100%;
        }

        .downloadApp-right {
            display: none;
        }

        .view_vc_tr a,
        .view_gr_tr a {
            width: fit-content;
        }
    }
</style>
@section('content')
    <div class="container">
        <div class="vaccination-growth-container">

            <h3 class="mt-4">Ali Growth Tracker</h3>
            <hr>
            <div class="vaccination-growth-child-container d-flex">
                <div class="vaccination-mainp">

{{-- 
                    <div style="width: 700px; margin: 0 auto;">
                        <canvas id="weightChart"></canvas>
                        <canvas id="heightChart"></canvas>
                        <canvas id="headAreaChart"></canvas>
                    </div> --}}














                </div>






                <div class="downloadApp-right">

                    <h6 class="font-poppins text-center mt-4">
                        Join the largest community of parents and see parenting in a new way
                    </h6>
                    <h5 class="text-center mt-3 mb-3">Download our App</h5>
                    <div class="d-flex gap-3">
                        <button class="btn_clr w-50 p-2">
                            <i class="bi bi-apple"></i> Get for iOS
                        </button>
                        <button class="btn_clr w-50 p-2">
                            <i class="bi bi-google-play"></i> Get for Android
                        </button>
                    </div>
                    <div class="mt-3">
                        <img src="{{ asset('public/images/mobile-parenting.png') }}" alt="" width="100%">
                    </div>
                </div>
            </div>





        </div>

    </div>



    <script>
        // Sample data
        const ageData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        const weightData = [10, 12, 14, 16, 18, 20, 22, 24, 26, 28];
        const heightData = [70, 75, 80, 85, 90, 95, 100, 105, 110, 115];
        const headAreaData = [30, 32, 34, 36, 38, 40, 42, 44, 46, 48];
        const idealWeightRange = [14, 24];
        const idealHeightRange = [80, 100];
        const idealHeadAreaRange = [32, 44];

        // Chart configuration
        const config = {
            type: 'line',
            data: {
                labels: ageData,
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Age'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Metric'
                        }
                    }
                }
            }
        };

        // Weight Chart
        const weightChartConfig = {
            ...config,
            data: {
                ...config.data,
                datasets: [{
                    label: 'Weight',
                    data: weightData,
                    borderColor: 'blue',
                    fill: false
                }, {
                    label: 'Ideal Range',
                    data: Array(ageData.length).fill(idealWeightRange),
                    borderColor: 'green',
                    borderWidth: 1,
                    borderDash: [5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                ...config.options,
                scales: {
                    ...config.options.scales,
                    y: {
                        ...config.options.scales.y,
                        suggestedMin: 0
                    }
                }
            }
        };

        // Height Chart
        const heightChartConfig = {
            ...config,
            data: {
                ...config.data,
                datasets: [{
                    label: 'Height',
                    data: heightData,
                    borderColor: 'red',
                    fill: false
                }, {
                    label: 'Ideal Range',
                    data: Array(ageData.length).fill(idealHeightRange),
                    borderColor: 'green',
                    borderWidth: 1,
                    borderDash: [5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                ...config.options,
                scales: {
                    ...config.options.scales,
                    y: {
                        ...config.options.scales.y,
                        suggestedMin: 0
                    }
                }
            }
        };

        // Head Area Chart
        const headAreaChartConfig = {
            ...config,
            data: {
                ...config.data,
                datasets: [{
                    label: 'Head Area',
                    data: headAreaData,
                    borderColor: 'purple',
                    fill: false
                }, {
                    label: 'Ideal Range',
                    data: Array(ageData.length).fill(idealHeadAreaRange),
                    borderColor: 'green',
                    borderWidth: 1,
                    borderDash: [5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                ...config.options,
                scales: {
                    ...config.options.scales,
                    y: {
                        ...config.options.scales.y,
                        suggestedMin: 0
                    }
                }
            }
        };

        // Render charts
        new Chart(document.getElementById('weightChart'), weightChartConfig);
        new Chart(document.getElementById('heightChart'), heightChartConfig);
        new Chart(document.getElementById('headAreaChart'), headAreaChartConfig);
    </script>
@endsection
