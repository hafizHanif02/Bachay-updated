@php use Illuminate\Support\Str; @endphp
@extends('layouts.back-end.app')

@section('title', translate('customer_List'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{asset('/public/assets/back-end/img/customer.png')}}" alt="">
                {{translate('customer_list')}}
                <span class="badge badge-soft-dark radius-50">{{count($customers)}}</span>
            </h2>
        </div>
        <div class="card">
            <div class="px-3 py-4">
                <div class="row gy-2 align-items-center">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="input-group input-group-merge input-group-custom">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="searchValue" class="form-control"
                                       placeholder="{{translate('search_by_Name_or_Email_or_Phone')}}"
                                       aria-label="Search orders" value="{{ request('searchValue') }}">
                                <button type="submit" class="btn btn--primary">{{translate('search')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                        <div class="d-flex justify-content-sm-end">
                            <button type="button" class="btn btn-outline--primary" data-toggle="dropdown">
                                <i class="tio-download-to"></i>
                                {{translate('export')}}
                                <i class="tio-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a class="dropdown-item"
                                       href="{{route('admin.customer.export',['searchValue'=>request('searchValue')])}}">
                                        <img width="14" src="{{asset('/public/assets/back-end/img/excel.png')}}" alt="">
                                        {{translate('excel')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive datatable-custom">
                <table
                    style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                    <thead class="thead-light thead-50 text-capitalize">
                    <tr>
                        <th>{{translate('SL')}}</th>
                        <th>{{translate('customer_name')}}</th>
                        <th>{{translate('contact_info')}}</th>
                        <th>{{translate('Total_child')}} </th>
                        <th class="text-center">{{translate('action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $key=>$customer)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                <a href="{{route('admin.customer.view',[$customer['id']])}}"
                                   class="title-color hover-c1 d-flex align-items-center gap-10">
                                    <img src="{{getValidImage(path: 'storage/app/public/profile/'.$customer->image,type:'backend-profile')}}"
                                         class="avatar rounded-circle " alt="" width="40">
                                    {{Str::limit($customer['f_name']." ".$customer['l_name'],20)}}
                                </a>
                            </td>
                            <td>
                                <div class="mb-1">
                                    <strong><a class="title-color hover-c1"
                                               href="mailto:{{$customer->email}}">{{$customer->email}}</a></strong>

                                </div>
                                <a class="title-color hover-c1" href="tel:{{$customer->phone}}">{{$customer->phone}}</a>

                            </td>
                            <td>
                                <label class="btn text-info bg-soft-info font-weight-bold px-3 py-1 mb-0 fz-12">
                                    {{count($customer->childs)}}
                                </label>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a title="{{translate('view')}}"
                                       class="btn btn-outline-info btn-sm square-btn"
                                       href="{{route('admin.customer.parent.view',[$customer['id']])}}">
                                        <i class="tio-invisible"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive mt-4">
                <div class="px-4 d-flex justify-content-lg-end">
                </div>
            </div>
            @if(count($customers)==0)
                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('public/assets/back-end/svg/illustrations/sorry.svg')}}"
                         alt="Image Description">
                    <p class="mb-0">{{translate('no_data_to_show')}}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
