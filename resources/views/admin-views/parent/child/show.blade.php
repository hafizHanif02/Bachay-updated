@extends('layouts.back-end.app')

@section('title', translate('Child_list'))

@section('content')
    <div class="content container-fluid">
        <div class="d-print-none pb-2">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="mb-3">
                        <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                            <img width="20"
                                src="{{ asset('/public/assets/images/customers/child/' . $child->profile_picture) }}"
                                alt="">
                            {{ $child->name }}
                        </h2>
                    </div>
                    <div class="d-sm-flex align-items-sm-center">
                        <h3 class="page-header-title">DOB: {{ $child->dob }}</h3>
                        <span class="{{ Session::get('direction') === 'rtl' ? 'mr-2 mr-sm-3' : 'ml-2 ml-sm-3' }}">
                            <i class="tio-date-range">
                            </i> {{ translate('created_at') . ':' . date('d M Y H:i:s', strtotime($child['created_at'])) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr class="text-center">
                                    <th colspan="4">VACCINATION DETAIL</th>
                                </tr>
                            </thead>
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ translate('sl') }}</th>
                                    <th>{{ translate('Vaccine') }}</th>
                                    <th>{{ translate('Vaccine_Date') }}</th>
                                    <th>{{ translate('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($child->vaccination_submission as $vaccine_sub)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vaccine_sub->vaccination->name }}</td>
                                        <td>{{ $vaccine_sub->vaccination_date }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline--primary btn-sm edit square-btn"
                                                    title="{{ translate('edit') }}"
                                                    href="{{ route('admin.customer.parent.child.edit', $child->id) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a title="{{ translate('view') }}"
                                                        class="btn btn-outline-info btn-sm square-btn"
                                                        href="{{ route('admin.customer.parent.child.show', $child->id) }}">
                                                        <i class="tio-invisible"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="card-footer">
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
