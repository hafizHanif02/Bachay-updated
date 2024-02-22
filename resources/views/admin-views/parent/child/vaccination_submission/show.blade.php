@extends('layouts.back-end.app')

@section('title', translate('vaccination_Detail'))

@section('content')
    <div class="content container-fluid">
        <div class="d-print-none pb-2">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="mb-3">
                        <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                            <img width="20"
                                src="{{ asset('/public/assets/images/customers/child/' . $vaccination_submission->child->profile_picture) }}"
                                alt="">
                            {{ $vaccination_submission->child->name }}
                        </h2>
                    </div>
                    <div class="d-sm-flex align-items-sm-center">
                        <h3 class="page-header-title">DOB: {{ $vaccination_submission->child->dob }}</h3>
                        <span class="{{ Session::get('direction') === 'rtl' ? 'mr-2 mr-sm-3' : 'ml-2 ml-sm-3' }}">
                            <i class="tio-date-range">
                            </i>
                            {{ translate('created_at') . ':' . date('d M Y H:i:s', strtotime($vaccination_submission->child['created_at'])) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="row  mt-3">
                        <div class="col-md-12">
                            <label class="h1 m-5 mb-0 text-capitalize d-flex gap-2" for=""
                                class="form-label">Vaccination: {{ $vaccination_submission->vaccination->name }}</label>
                                <label class="h5 m-5 mt-1 mb-0 text-capitalize d-flex gap-2" for=""
                                    class="form-label">Submitted on: {{ ($vaccination_submission->submission_date == null)?'Not Submtted':(date('d M Y', strtotime($vaccination_submission->submission_date))) }}</label>
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="col-md-12 mt-4 mb-4">
                            <h5 class="h4 mt-2 text-capitalize">Submission Image</h5>
                            <img src="{{ asset('/public/assets/images/vaccine/submission/' . $vaccination_submission->picture) }}"
                                alt="Vaccine Image" width="30%">
                        </div>

                        <div class="col-md-12 mt-6 mb-4">
                            <h5 class="h4 mt-2 text-capitalize">Disease</h5>
                            <p>{{ $vaccination_submission->vaccination->disease }}</p>
                        </div>

                        <div class="col-md-12 mt-4 mb-4">
                            <h5 class="h4 mt-2 text-capitalize">Protest Against</h5>
                            <p>{{ $vaccination_submission->vaccination->protest_against }}</p>
                        </div>

                        <div class="col-md-12 mt-4 mb-4">
                            <h5 class="h4 mt-2 text-capitalize">To Be Given</h5>
                            <p>{{ $vaccination_submission->vaccination->to_be_give }}</p>
                        </div>

                        <div class="col-md-12 mt-4 mb-4">
                            <h5 class="h4 mt-2 text-capitalize">How</h5>
                            <p>{{ $vaccination_submission->vaccination->how }}</p>
                        </div>
                        <table class=" mb-4 m-3 mt-3 table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="3"><h2 class="h2 mb-4 m-3  mt-3 text-capitalize">Growth Chart</h2></th>
                                </tr>
                                <tr>
                                    <th>Head Circle</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $growth->head_circle }}</td>
                                    <td>{{ $growth->weight }}</td>
                                    <td>{{ $growth->height }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
