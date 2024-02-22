@extends('layouts.back-end.app')

@section('title', translate('vaccination_submission_edit'))

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
                            </i> {{ translate('created_at') . ':' . date('d M Y H:i:s', strtotime($vaccination_submission->child['created_at'])) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="row  mt-3">
                        <div class="col-md-6">
                            <label class="h1 m-5 mb-0 text-capitalize d-flex gap-2" for="" class="form-label">Vaccination: {{ $vaccination_submission->vaccination->name }}</label>
                        </div>
                    </div>
                    <form action="{{ route('admin.customer.parent.child.vaccine_submission.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $vaccination_submission->id }}" name="id">
                        <input type="hidden" value="{{ $vaccination_submission->child->id }}" name="child_id">
                        <div class="m-5">
                            <div class="row mb-2 mt-2">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Vaccine Image</label>
                                    <input required type="file" value="{{ $vaccination_submission->picture }}" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2 mt-2">
                                <div class="col-md-6">
                                    <label for="" class="col-form-label">Head Circle</label>
                                    <input required type="text" value="{{ $growth->head_circle }}" step="any" name="head_circle" placeholder="Enter Head Circle" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="col-form-label">Submission Date</label>
                                    <input required type="date" value="{{ $vaccination_submission->submission_date }}" name="submission_date" placeholder="Enter Submission Date" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2 mt-2">
                                <div class="col-md-6">
                                    <label for="" class="col-form-label">Height</label>
                                    <input required type="text" value="{{ $growth->height }}" step="any" name="height" placeholder="Enter Height" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="col-form-label">Weight</label>
                                    <input required type="text" value="{{ $growth->weight }}" step="any" name="weight" placeholder="Enter Weight" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4 mt-4">
                                <div class="col-md-12 ml-4">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
