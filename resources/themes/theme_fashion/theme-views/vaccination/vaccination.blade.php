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

    .downloadApp-right {
        width: 30%;
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 16px 10px 20px 10px;
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

    .view_sample_cart {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        font-size: 11px;
        border-radius: 3px;
        text-align: center;
        padding: 2px 8px 0 8px;
        color: #000;
    }

    .Add_child_gr tr td select {
        border: none;
    }

    .gr_features table tbody tr td i {
        color: #9e9e9e;
    }

    .gr_features table tbody tr {
        margin-bottom: 10px;
        display: block;
    }
    .R14_42{
        font-size: 14px;
        color: #424242;
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
    .downloadApp-right h6{
        font-size: 14px;
    font-weight: 600;
    color: #424242;
    text-align: center;
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

            <h3 class="mt-4">Child Immunization & Baby Growth Tracker</h3>
            <hr>
            <div class="vaccination-growth-child-container d-flex">
                <div class="vaccination-mainp">
                    <div class="vaccine_main">
                        <div class="vacci-growthB">
                            <div class="vaccine_child">
                                <div class="child-profile d-flex align-items-center gap-4">
                                    <img class="rounded-pill" src="{{ asset('public/images/vacci.png') }}" alt=""
                                        width="102px" height="102px">
                                    <div>
                                        <h6>Hannan</h6>
                                        <p class="m-0">2 yr 9 m old Boy</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="vaccination_tr">
                                    <div class="vc_title">
                                        <h6>
                                            vaccination tracker
                                        </h6>
                                    </div>
                                    <div class="up_vc_title">
                                        <div class="up_vc_child">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Upcoming vaccinations

                                            </p>
                                            <ul class="mt-4">
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="up_vc_child mt-4">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Vaccinations summary

                                            </p>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="#">
                                                    <div class="overdue">
                                                        <div
                                                            class="overdue-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Overdue</p>
                                                </a>

                                                <a href="#">

                                                    <div class="vc_upcoming">
                                                        <div
                                                            class="vc_upcoming-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Upcoming</p>

                                                </a>

                                                <a href="#">
                                                    <div class="vc_comppleted">
                                                        <div
                                                            class="vc_comppleted-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Done</p>

                                                </a>

                                            </div>
                                            <div class="view_vc_tr text-center mt-4 mb-4">
                                                <a href="#">view vaccination tracker</a>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            </div>
                            <div class="p-3 pt-0">
                                <div class="vaccination_tr">
                                    <div class="vc_title">
                                        <h6>
                                            Growth tracker
                                        </h6>
                                    </div>
                                    <div class="up_vc_title">
                                        <div
                                            class="gr_trc_measr_top d-flex justify-content-between align-items-center ps-4 pe-4">
                                            <span><i class="bi bi-stopwatch"
                                                    style="font-size: 15px; margin-right: 2px;"></i>
                                                Updated on 26th Oct 2023</span>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="Add_growth_child border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Add Growth Details
                                            </button>

                                            <!-- Add Growth Details Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Growth
                                                                Details
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="w-100">
                                                                <tbody class="Add_child_gr">
                                                                    <tr>
                                                                        <td>Date</td>
                                                                        <td>
                                                                            <input type="date" name="markdate"
                                                                                id="markdate" value="2024-03-22">
                                                                        </td>
                                                                        <td>
                                                                            <button class="calendar_icon"
                                                                                id="markdatedatepicker"
                                                                                aria-label="Pick a Date"></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <span id="dobErrMsg"
                                                                                class="error_message"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Weight</td>
                                                                        <td>
                                                                            <input type="text" name="weight"
                                                                                id="weight" maxlength="5">
                                                                        </td>
                                                                        <td>
                                                                            <span>kg</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <span id="errmsgweight"
                                                                                class="error_message"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Height</td>
                                                                        <td>
                                                                            <input type="text" name="height"
                                                                                id="height" maxlength="5">
                                                                        </td>
                                                                        <td>
                                                                            <select name="htut" id="htut">
                                                                                <option value="cm">CM</option>
                                                                                <option value="inc">In.</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <span id="errmsgheight"
                                                                                class="error_message"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Head Circ.</td>
                                                                        <td>
                                                                            <input type="text" name="hc"
                                                                                id="hc" maxlength="5">
                                                                        </td>
                                                                        <td>
                                                                            <select name="hcut" id="hcut">
                                                                                <option value="cm">CM</option>
                                                                                <option value="inc">In.</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <span id="errmsgheightcirc"
                                                                                class="error_message"></span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="border-0 bg-transparent"
                                                                data-bs-dismiss="modal">CANCEL</button>
                                                            <button type="button" class="Add_growth_child border-0">SAVE
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="ps-4 pe-4">
                                            <table class="w-100 mt-3" style="line-height: 40px;">
                                                <thead>
                                                    <tr>
                                                        <th>Measurements</th>
                                                        <th>Ali Info</th>
                                                        <th>Ideal Range</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="vaccination-table-growth">
                                                    <tr>
                                                        <td>Weight</td>
                                                        <td>12 kg</td>
                                                        <td>7.3 - 11.6 kg</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Height</td>
                                                        <td>----</td>
                                                        <td>----</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Head Circumference</td>
                                                        <td>25 cm</td>
                                                        <td>42.6 - 47.7 cm</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="view_gr_tr text-center mt-4 mb-4">
                                            <a href="#">view growth chart</a>
                                        </div>


                                    </div>



                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="vaccine_main">
                        <div class="vacci-growthB">
                            <div class="vaccine_child">
                                <div class="child-profile d-flex align-items-center gap-4">
                                    <img class="rounded-pill" src="{{ asset('public/images/vacci.png') }}"
                                        alt="" width="102px" height="102px">
                                    <div>
                                        <h6>Hannan</h6>
                                        <p class="m-0">2 yr 9 m old Boy</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="vaccination_tr">
                                    <div class="vc_title">
                                        <h6>
                                            vaccination tracker
                                        </h6>
                                    </div>
                                    <div class="up_vc_title">
                                        <div class="up_vc_child">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Upcoming vaccinations

                                            </p>
                                            <ul class="mt-4">
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="up_vc_child mt-4">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Vaccinations summary

                                            </p>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="#">
                                                    <div class="overdue">
                                                        <div
                                                            class="overdue-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Overdue</p>
                                                </a>

                                                <a href="#">

                                                    <div class="vc_upcoming">
                                                        <div
                                                            class="vc_upcoming-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Upcoming</p>

                                                </a>

                                                <a href="#">
                                                    <div class="vc_comppleted">
                                                        <div
                                                            class="vc_comppleted-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Done</p>

                                                </a>

                                            </div>
                                            <div class="view_vc_tr text-center mt-4 mb-4">
                                                <a href="#">view vaccination tracker</a>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            </div>
                            <div class="p-3 pt-0">
                                <div class="vaccination_tr">
                                    <div class="vc_title">
                                        <h6>
                                            Growth tracker
                                        </h6>
                                    </div>
                                    <div class="up_vc_title">
                                        <div
                                            class="gr_trc_measr_top d-flex justify-content-between align-items-center ps-4 pe-4">
                                            <span><i class="bi bi-stopwatch"
                                                    style="font-size: 15px; margin-right: 2px;"></i>
                                                Updated on 26th Oct 2023</span>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="Add_growth_child border-0"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Add Growth Details
                                            </button>

                                            <!-- Add Growth Details Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                title
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="ps-4 pe-4">
                                            <table class="w-100 mt-3" style="line-height: 40px;">
                                                <thead>
                                                    <tr>
                                                        <th>Measurements</th>
                                                        <th>Ali Info</th>
                                                        <th>Ideal Range</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="vaccination-table-growth">
                                                    <tr>
                                                        <td>Weight</td>
                                                        <td>12 kg</td>
                                                        <td>7.3 - 11.6 kg</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Height</td>
                                                        <td>----</td>
                                                        <td>----</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Head Circumference</td>
                                                        <td>25 cm</td>
                                                        <td>42.6 - 47.7 cm</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="view_gr_tr text-center mt-4 mb-4">
                                            <a href="#">view growth chart</a>
                                        </div>


                                    </div>



                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="vaccine_main">
                        <div class="vacci-growthB">
                            <div class="vaccine_child">
                                <div class="child-profile d-flex align-items-center gap-4">
                                    <img class="rounded-pill" src="{{ asset('public/images/vacci.png') }}"
                                        alt="" width="102px" height="102px">
                                    <div>
                                        <h6>Hannan</h6>
                                        <p class="m-0">2 yr 9 m old Boy</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="vaccination_tr">
                                    <div class="vc_title">
                                        <h6>
                                            vaccination tracker
                                        </h6>
                                    </div>
                                    <div class="up_vc_title">
                                        <div class="up_vc_child">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Upcoming vaccinations

                                            </p>
                                            <ul class="mt-4">
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="up_vc_child mt-4">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Vaccinations summary

                                            </p>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="#">
                                                    <div class="overdue">
                                                        <div
                                                            class="overdue-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Overdue</p>
                                                </a>

                                                <a href="#">

                                                    <div class="vc_upcoming">
                                                        <div
                                                            class="vc_upcoming-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Upcoming</p>

                                                </a>

                                                <a href="#">
                                                    <div class="vc_comppleted">
                                                        <div
                                                            class="vc_comppleted-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Done</p>

                                                </a>

                                            </div>
                                            <div class="view_vc_tr text-center mt-4 mb-4">
                                                <a href="#">view vaccination tracker</a>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            </div>
                            <div class="p-3 pt-0">
                                <div class="vaccination_tr">
                                    <div class="vc_title d-flex justify-content-between align-items-center">
                                        <h6>
                                            Growth tracker
                                        </h6>
                                        <a class="view_sample_cart" href="{{ route('view-sample-cart') }}">
                                            View Sample Chart
                                        </a>
                                    </div>
                                    <div class="up_vc_title">
                                        <p class="ms-4 pb-3" style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                            Use our growth tracker to measure your child's growth over time &

                                        </p>



                                    </div>
                                    <div class="gr_features ms-4">
                                        <table class="w-100">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-journal-text" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Get age/gender wise growth chart
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-journal-check" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Compare with WHO standards</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-bell" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Get reminders at regular intervals
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-journals" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Maintain Digital Records</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn_clr mb-3 mt-3"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Add Growth Details
                                    </button>
     
                                    <!-- Add Growth Details Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                        title
                                                    </h1>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </div>






                                </div>



                            </div>

                        </div>
                    </div>
                    <div class="vaccine_main">
                        <div class="vacci-growthB">
                            <div class="vaccine_child">
                                <div class="child-profile d-flex align-items-center gap-4">
                                    <img class="rounded-pill" src="{{ asset('public/images/vacci.png') }}"
                                        alt="" width="102px" height="102px">
                                    <div>
                                        <h6>Hannan</h6>
                                        <p class="m-0">2 yr 9 m old Boy</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="vaccination_tr">
                                    <div class="vc_title">
                                        <h6>
                                            vaccination tracker
                                        </h6>
                                    </div>
                                    <div class="up_vc_title">
                                        <div class="up_vc_child">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Upcoming vaccinations

                                            </p>
                                            <ul class="mt-4">
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>
                                                <li class="d-flex justify-content-between ps-5 pe-5 mb-4">
                                                    <div class="up_vcs_nam gap-3">
                                                        <span class="me-4">

                                                            <i class="bi bi-heart-pulse-fill"></i>

                                                        </span>
                                                        <span class="custom-dt-clr">4/4</span>

                                                    </div>
                                                    <div class="vc_dt_main">
                                                        <span class="custom-dt-clr">24 Mar 2024</span>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="up_vc_child mt-4">
                                            <p class="ms-4 pb-3"
                                                style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                                Vaccinations summary

                                            </p>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="#">
                                                    <div class="overdue">
                                                        <div
                                                            class="overdue-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Overdue</p>
                                                </a>

                                                <a href="#">

                                                    <div class="vc_upcoming">
                                                        <div
                                                            class="vc_upcoming-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Upcoming</p>

                                                </a>

                                                <a href="#">
                                                    <div class="vc_comppleted">
                                                        <div
                                                            class="vc_comppleted-child d-flex justify-content-center align-items-center">
                                                            <p class="m-0 text-light vc_num_count">6</p>
                                                        </div>
                                                    </div>
                                                    <p class="text-center custom-dt-clr mt-2">Done</p>

                                                </a>

                                            </div>
                                            <div class="view_vc_tr text-center mt-4 mb-4">
                                                <a href="#">view vaccination tracker</a>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            </div>
                            <div class="p-3 pt-0">
                                <div class="vaccination_tr">
                                    <div class="vc_title d-flex justify-content-between align-items-center">
                                        <h6>
                                            Growth tracker
                                        </h6>
                                        <a class="view_sample_cart" href="{{ route('view-sample-cart') }}">
                                            View Sample Chart
                                        </a>
                                    </div>
                                    <div class="up_vc_title">
                                        <p class="ms-4 pb-3" style="font-size: 16px;  border-bottom: 1px solid #ededed;">
                                            Use our growth tracker to measure your child's growth over time &

                                        </p>



                                    </div>
                                    <div class="gr_features ms-4">
                                        <table class="w-100">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-journal-text" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Get age/gender wise growth chart
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-journal-check" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Compare with WHO standards</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-bell" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Get reminders at regular intervals
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 35px;">
                                                        <i class="bi bi-journals" style="font-size: 25px;"></i>
                                                    </td>
                                                    <td valign="bottom" class="R14_42">Maintain Digital Records</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn_clr mb-3 mt-3"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Add Growth Details
                                    </button>
     
                                    <!-- Add Growth Details Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                        title
                                                    </h1>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </div>






                                </div>



                            </div>

                        </div>
                    </div>
                </div>
                <div class="downloadApp-right">
                    
                    <h6 class="font-poppins text-center mt-4">
                        Join the largest community of parents and see parenting in a new way
                    </h6>
                    <h5 class="text-center mt-3 mb-3">Download our App</h5>
                    <div class="d-flex gap-3">
                        <button class="btn_clr w-50 p-2">
                            <i class="bi bi-apple"></i>  Get for iOS
                        </button>
                        <button class="btn_clr w-50 p-2">
                            <i class="bi bi-google-play"></i>  Get for Android
                        </button>
                    </div>
                    <div class="mt-3">
                        <img src="{{ asset('public/images/mobile-parenting.png') }}" alt="" width="100%">
                    </div>
                </div>
            </div>
            
        </div>





    </div>

    </div>
@endsection
