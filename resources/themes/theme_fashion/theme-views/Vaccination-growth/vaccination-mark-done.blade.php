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
        margin: 0 0px 100px 0px;
    }

    .vaccination-mainp {
        width: 70%;
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 10px;
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

    .vaccine_name {
        background-color: #f56996;
        
        padding: 10px;
    }

    .date_area {
        width: 55%;
        border: none;
        color: #f56996;
        font-size: 14px;

    }

    .R15_21 {
        color: #424242;
    }

    .tag_txt {
        font-weight: 400;
        font-size: 13px;
        line-height: 18px;
        color: #9e9e9e;
    }
    .R14_75{
        font-size: 14px;
        padding: 20px 10px;
        margin: 10px 0 0 0 ;
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

            <h3 class="mt-5">Update Details</h3>
            <hr>
            <form id="vaccination_form" action="{{ route('vaccination-mark-done-submit', $vaccination_submission->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="vaccination_id" value="{{ $vaccination_submission->id }}">
                <div class="vaccination-growth-child-container gap-4 d-flex">               
                    <div class="vaccination-mainp rounded-5">
                        <div class="upd_dt">
                            <div class="vaccine_name rounded-5">
                                <h6 class="font-poppins text-light text-center fw-bold">{{ $vaccination_submission->vaccination->name }}</h6>
                            </div>
                            <div class="taken_on d-flex justify-content-between align-items-center mt-4">
                                <span class="R15_21">Taken On</span>
                                <input class="date_area" name="submission_date" value="{{ ($vaccination_submission->submission_date != null) ? date('Y-m-d', strtotime($vaccination_submission->submission_date)) : date('Y-m-d') }}" type="date">
                            </div>
                            <hr>
                            <div class="vc_tag_cnt d-flex mt-5">
                                <div class="vc_tag_cnt_container">
                                    <h4 class="tag_title mb-2">
                                        Save vaccination tag
                                    </h4>
                                    <p class="m-0 tag_txt">Vaccination tag can be found on the vaccination chart shared by your
                                        Pediatrician, take snap of the tag</p>
    
                                </div>
                                <div>
                                    <input type="file" accept="image/*" value="{{ ($vaccination_submission->picture != null) ? $vaccination_submission->picture : '' }}" name="image" capture="camera">
                                </div>
                            </div>
                            <div class="add_growth_det d-flex justify-content-between align-items-center mt-5">
                                <h6>Growth Details
                                </h6>
    
    
                                <!-- Button trigger modal -->
                                <button type="button" class="bg-transparent border-0" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="bi bi-pencil" style="border-bottom: 1px solid;"></i>
                                </button>
                            </div>
                            <hr>
                            <div class="gr_fields ms-5 me-5">
                                @if(!empty($growth_data))
                                <table class="w-100">
                                    <tbody style="line-height: 30px; font-size: 14px;">
                                        <tr>
                                            <td class="mesr R14_42">Weight</td>
                                            <td class="mesr_ipt"></td>
                                            <td class="pqr text-end">{{ ($growth_data->weight ?? 'N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="mesr">Height</td>
                                            <td class="mesr_ipt"></td>
                                            <td class="pqr text-end">{{ ($growth_data->height ?? 'N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="mes R14_42">Head Circ.</td>
                                            <td class="mesr_ipt"></td>
                                            <td class="pqr text-end">{{ ($growth_data->head_circle ?? 'N/A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <textarea class="add_comment R14_75 rounded-5" id="add_comment" maxlength="250" placeholder="Add your comments about the vaccine or mention details of the pediatrician here for future reference in 250 characters"></textarea>
                            <button type="button" onclick="SubmitForm()" class="btn_clr mt-4 ps-5 pe-5 pt-2 pb-2 fw-bold">
                                SAVE
                            </button>
                        </div>
                    </form>
                        <!-- Growth deatils Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form  action="{{ route('growth-submit', $child->id) }}" method="POST">
                                        @csrf
                                        <div class="row mb-3 mt-3">
                                            <label for="weight" class="form-label">Weight</label>
                                            <input type="text" class="form-control" name="weight" placeholder="Enter Weight">
                                        </div>
                                        <div class="row mb-3 mt-3">
                                            <label for="height" class="form-label">Height</label>
                                            <input type="text" class="form-control" name="height" placeholder="Enter Height">
                                        </div>
                                        <div class="row mb-3 mt-3">
                                            <label for="head_circle" class="form-label">Head Circle</label>
                                            <input type="text" class="form-control" name="head_circle" placeholder="Enter Head Circle">
                                        </div>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                            <button type="submit"  class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
    
    
    
    
    
    
    
    
                    <div class="downloadApp-right rounded-5">
    
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
            {{-- </form> --}}





        </div>

    </div>

    <script>
        function SubmitForm(){
            document.getElementById("vaccination_form").submit();
        }
        function growthForm(){
            cosnole.log("hello");
            // document.getElementById("growth_data_form").submit();
        }
    </script>
@endsection
