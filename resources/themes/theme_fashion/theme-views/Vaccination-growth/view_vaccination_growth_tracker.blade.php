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

    .R12_white {
        color: #fff;
    }

    .vc_sub_con {
        background: #f56996;
        padding: 10px;
    }

    .status_overdue {
        display: flex;
    }

    .status_main .status_overdue .overdue_crl p {
        margin-bottom: 0;
        margin-top: 0;
        font-size: 9px;
        font-weight: 500;

    }

    .status_main .status_overdue .overdue_crl {
        font-size: 20px;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 1px solid;
        border-radius: 50%;
        text-align: center;
        color: #fff;
        margin-right: 5px;
        margin-bottom: 6px
    }

    .vacc_main_con {
        padding: 10px;
        /* border: 1px solid #ededed; */
        /* margin: 10px 0 0 0; */
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
{{-- train css --}}
<style>
    .train_main {
        width: 100%;
    }

    .train_main .train_img {
        height: 63px;
        display: inline-block;
        float: left;
    }

    .train_main .train_img .train_eng {
        height: 100%;
        filter: grayscale(100%);
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

    .train_container {
        width: 100%;
        overflow: hidden;
        background: #fff;
    }

    .act {
        background-color: rgb(249, 117, 163);
        border: 1px solid rgb(255, 255, 255) !important;
        color: rgb(255, 255, 255) !important;
    }

    .train_bogi_1 span {
        display: inline-block;
        margin-top: 7px;
    }

    .act span {
        color: #fff;
    }

    .act .sub-act {
        background-color: rgb(249, 117, 163) !important;
        border: 2px solid rgb(255, 255, 255) !important;
    }

    .train_bogi_main .train_bogi_sub .train_bogi_1 {
        width: 110px;
        height: 30px;
        border: 2px solid #9e9e9e;
        float: left;
        position: relative;
        top: 17px;
        left: -4px;
        text-align: center;
        border-radius: 3px;
        margin-bottom: 22px;
        cursor: pointer;
        color: #757575;
    }

    .train_main .train_bogi_main .train_bogi_1 p {
        margin-bottom: 0;
        position: relative;
        top: 19%;
        font-size: 13px;
        font-family: Roboto-Medium;
    }

    .train_bogi_main .train_bogi_1 .train_bogi_tire_1 {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        border: 2px solid #9e9e9e;
        position: relative;
        left: 10%;
        top: -7px;
        background-color: #fff;
    }

    .train_bogi_main .train_bogi_1 .train_bogi_tire_2 {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        border: 2px solid #9e9e9e;
        position: relative;
        top: -21px;
        right: 10%;
        float: right;
        background-color: #fff;
    }

    .train_bogi_main .train_bogi_sub .train_con {
        position: relative;
        float: left;
        top: 33px;
        left: -4px;
    }

    .train_bogi_main .train_bogi_sub .train_bogi_1 .train_noti {
        width: 18px;
        height: 18px;
        border: 1px solid #fff;
        border-radius: 50%;
        position: absolute;
        top: -10px;
        left: 40%;
        color: #fff;
        background-color: #f03e77;
        padding: 1.15px;
    }

    .train_main .train_bogi_main .train_bogi_sub {
        display: block;
    }

    .train_main .train_bogi_main {
        position: relative;
        display: -webkit-box;
    }

    .train_bogi_main .train_bogi_sub .train_bogi_1 .train_noti p {
        margin-bottom: 0;
        top: -3px;
        font-weight: 600;
        font-size: 11px;
    }

    .child_stage_main_chain {
        overflow: hidden;
        overflow-x: scroll;
    }

    .train_main::-webkit-scrollbar {
        height: 10px;
    }

    .train_bogi_main {
        -webkit-animation-name: train_run;
        -webkit-animation-duration: 3s;
        animation-name: train_run;
        animation-duration: 3s;
        transition-timing-function: ease-out;
        -webkit-transition-timing-function: ease-out;
    }

    @-webkit-keyframes train_run {
        from {
            margin-left: 100%;
        }

        to {
            margin-left: 2%;
        }
    }

    @keyframes train_run {
        from {
            margin-left: 100%;
        }

        to {
            margin-left: 2%;
        }
    }
</style>
<style>
    .accordion {
        border: 1px solid #ccc;
        margin-bottom: 10px;
    }

    .accordion-header {
        border: 1px solid #ededed;
        /* margin: 10px 0 0 0; */
        padding: 10px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .accordion-content {
        overflow: hidden;

        max-height: 0;
        transition: max-height 1.5s ease;
    }

    .accordion-content.active {
        max-height: 200px;
    }

    .accordion-icon {
        transition: transform 0.3s ease;
    }

    .vcc_main_acc {
        padding: 10px;
        /* border: 1px solid #ededed; */

    }

    .accordion-heading {
        font-family: 'poppins';
        font-size: 15px;
    }

    .M15_42 {
        font-size: 15px;

    }

    .R12_75 {
        font-size: 12px !important;
        color: #757575 !important;
        font-weight: 400;
    }

    .vc_date {
        margin-bottom: 22px;
    }

    .accordion-content {
        padding: 0 10px;
        margin: 10px 0 0 0;
    }

    .add_gr_det_btn {
        padding: 10px;
    }

    .add_gr_det_btn p {
        font-weight: 600 !important;

    }

    .view-growth-details a {
        color: #f56996;
    }

    .vc_mark_done {
        border: 1px solid #bdbdbd;
        border-radius: 3px;
        padding: 2px 6px;
    }

    .vc_date_in {
        text-transform: uppercase;
        color: #fc88af;
        font-weight: 600;
        font-size: 12px;
    }

    .vc_due {
        font-weight: 600;
    }

    .R13_9e {
        color: #9e9e9e;
    }

    .vaccination__child {
        border: 1px solid #ededed;
        margin: 10px 0 0 0;

    }

    .child__main_vcc_container {
        height: 90vh;
        overflow-y: scroll;
    }
    #select-option{
        width: 100%;
        padding: 10px;
        border: none;
        font-size: 24px;
    font-weight: 600;
    color: #f56996;
    
    }
    #select-option option{
    font-size: 15px;
    font-weight: 400;

    }
</style>
@section('content')
    <div class="container">
        <div class="vaccination-growth-container">

            <h3 class="mt-5">View Vaccination Tracker</h3>
            <hr>
            <div class="vaccination-growth-child-container d-flex">
                <div class="vaccination-mainp">
                    <div class="parent-div">
                        <div class="select-div">
                            <select id="select-option">
                                @forelse($childerens as $child)
                                <a href="{{ route('view-vaccination-growth-tracker', $child->id) }}">
                                    <option value="option{{ $loop->iteration }}">{{ $child->name }}<span>'s Vaccination</span></option>
                                </a>
                                @empty

                                @endforelse 
                            </select>
                        </div>
                    </div>
                    <div class="train_container">
                        <div class="train_main">
                            <div class="child_stage_main_chain">
                                <div class="train_bogi_main" style="z-index: 0">
                                    <div class="train_img">
                                        <img src="//parenting.firstcry.ae/tools/images/tracker/train-270.png"
                                            class="train_eng" />
                                    </div>
                                    <div class="train_bogi_sub">
                                        <div class="train_con">
                                            <svg height="10" width="10">
                                                <line x1="0" y1="0" x2="10" y2="0"
                                                    style="stroke: rgb(158, 158, 158); stroke-width: 4"></line>
                                            </svg>
                                        </div>
                                        <div class="train_bogi_1 act" id="bg_1" rel="1">
                                            <span class="M13_42">Birth</span>
                                            <div class="train_bogi_tire_1 sub-act"></div>
                                            <div class="train_bogi_tire_2 sub-act"></div>
                                        </div>
                                    </div>
                                    <div class="train_bogi_sub">
                                        <div class="train_con">
                                            <svg height="10" width="10">
                                                <line x1="0" y1="0" x2="10" y2="0"
                                                    style="stroke: rgb(158, 158, 158); stroke-width: 4"></line>
                                            </svg>
                                        </div>
                                        <div class="train_bogi_1" id="bg_2" rel="2">
                                            <span class="M13_42">2 Months</span>
                                            <div class="train_bogi_tire_1"></div>
                                            <div class="train_bogi_tire_2"></div>
                                        </div>
                                    </div>
                                    <div class="train_bogi_sub">
                                        <div class="train_con">
                                            <svg height="10" width="10">
                                                <line x1="0" y1="0" x2="10" y2="0"
                                                    style="stroke: rgb(158, 158, 158); stroke-width: 4"></line>
                                            </svg>
                                        </div>
                                        <div class="train_bogi_1" id="bg_3" rel="3">
                                            <span class="M13_42">4 Months</span>
                                            <div class="train_bogi_tire_1"></div>
                                            <div class="train_bogi_tire_2"></div>
                                        </div>
                                    </div>
                                    <div class="train_bogi_sub">
                                        <div class="train_con">
                                            <svg height="10" width="10">
                                                <line x1="0" y1="0" x2="10" y2="0"
                                                    style="stroke: rgb(158, 158, 158); stroke-width: 4"></line>
                                            </svg>
                                        </div>
                                        <div class="train_bogi_1" id="bg_4" rel="4">
                                            <span class="M13_42">6 Months</span>
                                            <div class="train_bogi_tire_1"></div>
                                            <div class="train_bogi_tire_2"></div>
                                        </div>
                                    </div>
                                    <div class="train_bogi_sub">
                                        <div class="train_con">
                                            <svg height="10" width="10">
                                                <line x1="0" y1="0" x2="10" y2="0"
                                                    style="stroke: rgb(158, 158, 158); stroke-width: 4"></line>
                                            </svg>
                                        </div>
                                        <div class="train_bogi_1" id="bg_5" rel="5">
                                            <span class="M13_42">12 Months</span>
                                            <div class="train_bogi_tire_1"></div>
                                            <div class="train_bogi_tire_2"></div>
                                        </div>
                                    </div>
                                    <div class="train_bogi_sub">
                                        <div class="train_con">
                                            <svg height="10" width="10">
                                                <line x1="0" y1="0" x2="10" y2="0"
                                                    style="stroke: rgb(158, 158, 158); stroke-width: 4"></line>
                                            </svg>
                                        </div>
                                        <div class="train_bogi_1" id="bg_6" rel="6">
                                            <span class="M13_42">18 Months</span>
                                            <div class="train_bogi_tire_1"></div>
                                            <div class="train_bogi_tire_2"></div>
                                        </div>
                                    </div>
                                    <div class="train_bogi_sub">
                                        <div class="train_con">
                                            <svg height="10" width="10">
                                                <line x1="0" y1="0" x2="10" y2="0"
                                                    style="stroke: rgb(158, 158, 158); stroke-width: 4"></line>
                                            </svg>
                                        </div>
                                        <div class="train_bogi_1 upcoming-act" id="bg_7" rel="7">
                                            <span class="M13_42">5 to 6 Years</span>
                                            <div class="train_bogi_tire_1"></div>
                                            <div class="train_bogi_tire_2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="child__main_vcc_container">
                        @if(!empty($birth))
                        <div class="vaccination__child">
                            <div class="vacc_main_con">
                                <div class="vc_sub_con d-flex justify-content-between">
                                    <i class="bi bi-activity" style="font-size: 80px; color: #fff;"></i>
                                    <h3 class="text-light d-flex align-items-center font-poppins">Birth</h3>
                                    <div class="status_main">
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #e9514e;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">overdue</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #feb134;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">upcoming</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #8cbc59;">
                                                <p>2</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">done</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vcc_main_acc">
                                @foreach($birth as $vaccine_data)
                                    <div class="accordion-main">
                                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                            <h3 class="accordion-heading">

                                                <div class="vc_name">
                                                    <i class="bi bi-heart-pulse-fill"></i>
                                                    <span class="M15_42">{{ $vaccine_data->vaccination->name }}</span>
                                                </div>
                                            </h3>
                                            <div class="accordion-icon" id="accordion-icon">+</div>
                                        </div>
                                        <div class="accordion-content">
                                            <ul>
                                                <li>
                                                    <div class="vc_date d-flex justify-content-between align-items-center">
                                                        <span class="vc_due left R13_42">Vaccine Date</span>
                                                        <span class="vc_date_in left">{{ \Carbon\Carbon::parse($vaccine_data->vaccination_date)->format('d M Y') }}</span>

                                                        <div class="vc_mark_done">
                                                            <a href="{{ route('vaccination-mark-done', [$vaccine_data->id, $child->id]) }}">
                                                                <span class="R13_9e" id="devviewdetails">Mark As Done</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{ $vaccine_data->vaccination->how }}</p>
                                        </div>  
                                    </div>
                                @endforeach    
                                <div class="add_gr_det_btn">
                                    <p class="view-growth-details text-end">
                                        <a href="#">
                                            View growth details for Birth
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        @endif
                        @if(!empty($twoMonth))
                        <div class="vaccination__child">
                            <div class="vacc_main_con">
                                <div class="vc_sub_con d-flex justify-content-between">
                                    <i class="bi bi-activity" style="font-size: 80px; color: #fff;"></i>
                                    <h3 class="text-light d-flex align-items-center font-poppins">2 MONTHS</h3>
                                    <div class="status_main">
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #e9514e;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">overdue</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #feb134;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">upcoming</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #8cbc59;">
                                                <p>2</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">done</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vcc_main_acc">
                                @foreach($twoMonth as $vaccine_data)
                                    <div class="accordion-main">
                                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                            <h3 class="accordion-heading">

                                                <div class="vc_name">
                                                    <i class="bi bi-heart-pulse-fill"></i>
                                                    <span class="M15_42">{{ $vaccine_data->vaccination->name }}</span>
                                                </div>
                                            </h3>
                                            <div class="accordion-icon" id="accordion-icon">+</div>
                                        </div>
                                        <div class="accordion-content">
                                            <ul>
                                                <li>
                                                    <div class="vc_date d-flex justify-content-between align-items-center">
                                                        <span class="vc_due left R13_42">Vaccine Date</span>
                                                        <span class="vc_date_in left">{{ \Carbon\Carbon::parse($vaccine_data->vaccination_date)->format('d M Y') }}</span>

                                                        <div class="vc_mark_done">
                                                            <a href="{{ route('vaccination-mark-done', [$vaccine_data->id, $child->id]) }}">
                                                                <span class="R13_9e" id="devviewdetails">Mark As Done</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{ $vaccine_data->vaccination->how }}</p>
                                        </div>  
                                    </div>
                                @endforeach    
                                <div class="add_gr_det_btn">
                                    <p class="view-growth-details text-end">
                                        <a href="#">
                                            View growth details for Birth
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        @endif
                        @if(!empty($fourMonth))
                        <div class="vaccination__child">
                            <div class="vacc_main_con">
                                <div class="vc_sub_con d-flex justify-content-between">
                                    <i class="bi bi-activity" style="font-size: 80px; color: #fff;"></i>
                                    <h3 class="text-light d-flex align-items-center font-poppins">4 MONTHS</h3>
                                    <div class="status_main">
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #e9514e;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">overdue</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #feb134;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">upcoming</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #8cbc59;">
                                                <p>2</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">done</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vcc_main_acc">
                                @foreach($fourMonth as $vaccine_data)
                                    <div class="accordion-main">
                                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                            <h3 class="accordion-heading">

                                                <div class="vc_name">
                                                    <i class="bi bi-heart-pulse-fill"></i>
                                                    <span class="M15_42">{{ $vaccine_data->vaccination->name }}</span>
                                                </div>
                                            </h3>
                                            <div class="accordion-icon" id="accordion-icon">+</div>
                                        </div>
                                        <div class="accordion-content">
                                            <ul>
                                                <li>
                                                    <div class="vc_date d-flex justify-content-between align-items-center">
                                                        <span class="vc_due left R13_42">Vaccine Date</span>
                                                        <span class="vc_date_in left">{{ \Carbon\Carbon::parse($vaccine_data->vaccination_date)->format('d M Y') }}</span>

                                                        <div class="vc_mark_done">
                                                            <a href="{{ route('vaccination-mark-done', [$vaccine_data->id, $child->id]) }}">
                                                                <span class="R13_9e" id="devviewdetails">Mark As Done</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{ $vaccine_data->vaccination->how }}</p>
                                        </div>  
                                    </div>
                                @endforeach    
                                <div class="add_gr_det_btn">
                                    <p class="view-growth-details text-end">
                                        <a href="#">
                                            View growth details for Birth
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($sixMonth))
                        <div class="vaccination__child">
                            <div class="vacc_main_con">
                                <div class="vc_sub_con d-flex justify-content-between">
                                    <i class="bi bi-activity" style="font-size: 80px; color: #fff;"></i>
                                    <h3 class="text-light d-flex align-items-center font-poppins">6 MONTHS</h3>
                                    <div class="status_main">
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #e9514e;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">overdue</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #feb134;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">upcoming</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #8cbc59;">
                                                <p>2</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">done</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vcc_main_acc">
                                @foreach($sixMonth as $vaccine_data)
                                    <div class="accordion-main">
                                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                            <h3 class="accordion-heading">

                                                <div class="vc_name">
                                                    <i class="bi bi-heart-pulse-fill"></i>
                                                    <span class="M15_42">{{ $vaccine_data->vaccination->name }}</span>
                                                </div>
                                            </h3>
                                            <div class="accordion-icon" id="accordion-icon">+</div>
                                        </div>
                                        <div class="accordion-content">
                                            <ul>
                                                <li>
                                                    <div class="vc_date d-flex justify-content-between align-items-center">
                                                        <span class="vc_due left R13_42">Vaccine Date</span>
                                                        <span class="vc_date_in left">{{ \Carbon\Carbon::parse($vaccine_data->vaccination_date)->format('d M Y') }}</span>

                                                        <div class="vc_mark_done">
                                                            <a href="{{ route('vaccination-mark-done', [$vaccine_data->id, $child->id]) }}">
                                                                <span class="R13_9e" id="devviewdetails">Mark As Done</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{ $vaccine_data->vaccination->how }}</p>
                                        </div>  
                                    </div>
                                @endforeach    
                                <div class="add_gr_det_btn">
                                    <p class="view-growth-details text-end">
                                        <a href="#">
                                            View growth details for Birth
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        @endif
                        @if(!empty($twelveMonth))
                        <div class="vaccination__child">
                            <div class="vacc_main_con">
                                <div class="vc_sub_con d-flex justify-content-between">
                                    <i class="bi bi-activity" style="font-size: 80px; color: #fff;"></i>
                                    <h3 class="text-light d-flex align-items-center font-poppins">12 MONTHS</h3>
                                    <div class="status_main">
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #e9514e;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">overdue</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #feb134;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">upcoming</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #8cbc59;">
                                                <p>2</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">done</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vcc_main_acc">
                                @foreach($twelveMonth as $vaccine_data)
                                    <div class="accordion-main">
                                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                            <h3 class="accordion-heading">

                                                <div class="vc_name">
                                                    <i class="bi bi-heart-pulse-fill"></i>
                                                    <span class="M15_42">{{ $vaccine_data->vaccination->name }}</span>
                                                </div>
                                            </h3>
                                            <div class="accordion-icon" id="accordion-icon">+</div>
                                        </div>
                                        <div class="accordion-content">
                                            <ul>
                                                <li>
                                                    <div class="vc_date d-flex justify-content-between align-items-center">
                                                        <span class="vc_due left R13_42">Vaccine Date</span>
                                                        <span class="vc_date_in left">{{ \Carbon\Carbon::parse($vaccine_data->vaccination_date)->format('d M Y') }}</span>

                                                        <div class="vc_mark_done">
                                                            <a href="{{ route('vaccination-mark-done', [$vaccine_data->id, $child->id]) }}">
                                                                <span class="R13_9e" id="devviewdetails">Mark As Done</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{ $vaccine_data->vaccination->how }}</p>
                                        </div>  
                                    </div>
                                @endforeach    
                                <div class="add_gr_det_btn">
                                    <p class="view-growth-details text-end">
                                        <a href="#">
                                            View growth details for Birth
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        @endif
                        @if(!empty($eighteenMonth))
                        <div class="vaccination__child">
                            <div class="vacc_main_con">
                                <div class="vc_sub_con d-flex justify-content-between">
                                    <i class="bi bi-activity" style="font-size: 80px; color: #fff;"></i>
                                    <h3 class="text-light d-flex align-items-center font-poppins">18 MONTHS</h3>
                                    <div class="status_main">
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #e9514e;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">overdue</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #feb134;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">upcoming</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #8cbc59;">
                                                <p>2</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">done</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vcc_main_acc">
                                @foreach($eighteenMonth as $vaccine_data)
                                    <div class="accordion-main">
                                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                            <h3 class="accordion-heading">

                                                <div class="vc_name">
                                                    <i class="bi bi-heart-pulse-fill"></i>
                                                    <span class="M15_42">{{ $vaccine_data->vaccination->name }}</span>
                                                </div>
                                            </h3>
                                            <div class="accordion-icon" id="accordion-icon">+</div>
                                        </div>
                                        <div class="accordion-content">
                                            <ul>
                                                <li>
                                                    <div class="vc_date d-flex justify-content-between align-items-center">
                                                        <span class="vc_due left R13_42">Vaccine Date</span>
                                                        <span class="vc_date_in left">{{ \Carbon\Carbon::parse($vaccine_data->vaccination_date)->format('d M Y') }}</span>

                                                        <div class="vc_mark_done">
                                                            <a href="{{ route('vaccination-mark-done', [$vaccine_data->id, $child->id]) }}">
                                                                <span class="R13_9e" id="devviewdetails">Mark As Done</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{ $vaccine_data->vaccination->how }}</p>
                                        </div>  
                                    </div>
                                @endforeach    
                                <div class="add_gr_det_btn">
                                    <p class="view-growth-details text-end">
                                        <a href="#">
                                            View growth details for Birth
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        @endif
                        @if(!empty($fiveYear))
                        <div class="vaccination__child">
                            <div class="vacc_main_con">
                                <div class="vc_sub_con d-flex justify-content-between">
                                    <i class="bi bi-activity" style="font-size: 80px; color: #fff;"></i>
                                    <h3 class="text-light d-flex align-items-center font-poppins">5 TO 6 YEARS</h3>
                                    <div class="status_main">
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #e9514e;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">overdue</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #feb134;">
                                                <p>00</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">upcoming</span>
                                            </div>
                                        </div>
                                        <div class="status_overdue">
                                            <div class="overdue_crl" style="background-color: #8cbc59;">
                                                <p>2</p>
                                            </div>
                                            <div class="overdue_txt">
                                                <span class="R12_white">done</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vcc_main_acc">
                                @foreach($fiveYear as $vaccine_data)
                                    <div class="accordion-main">
                                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                            <h3 class="accordion-heading">

                                                <div class="vc_name">
                                                    <i class="bi bi-heart-pulse-fill"></i>
                                                    <span class="M15_42">{{ $vaccine_data->vaccination->name }}</span>
                                                </div>
                                            </h3>
                                            <div class="accordion-icon" id="accordion-icon">+</div>
                                        </div>
                                        <div class="accordion-content">
                                            <ul>
                                                <li>
                                                    <div class="vc_date d-flex justify-content-between align-items-center">
                                                        <span class="vc_due left R13_42">Vaccine Date</span>
                                                        <span class="vc_date_in left">{{ \Carbon\Carbon::parse($vaccine_data->vaccination_date)->format('d M Y') }}</span>

                                                        <div class="vc_mark_done">
                                                            <a href="{{ route('vaccination-mark-done', [$vaccine_data->id, $child->id]) }}">
                                                                <span class="R13_9e" id="devviewdetails">Mark As Done</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{ $vaccine_data->vaccination->how }}</p>
                                        </div>  
                                    </div>
                                @endforeach    
                                <div class="add_gr_det_btn">
                                    <p class="view-growth-details text-end">
                                        <a href="#">
                                            View growth details for Birth
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>



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
        function toggleAccordion(header) {
            const content = header.nextElementSibling;
            const icon = header.querySelector(".accordion-icon");

            content.classList.toggle("active");
            if (content.classList.contains("active")) {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.textContent = "-";
            } else {
                content.style.maxHeight = null;
                icon.textContent = "+";
            }
        }
    </script>
@endsection
