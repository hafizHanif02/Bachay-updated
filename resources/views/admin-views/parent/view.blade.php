@extends('layouts.back-end.app')

@section('title', translate('Child_list'))

@section('content')
    <div class="content container-fluid">
        <div class="d-print-none pb-2">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="mb-3">
                        <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                            <img width="20" src="{{asset('/public/assets/back-end/img/customer.png')}}" alt="">
                            {{translate('customer_details')}}
                        </h2>
                    </div>
                    <div class="d-sm-flex align-items-sm-center">
                        <h3 class="page-header-title">{{translate('customer_ID')}} #{{$customer['id']}}</h3>
                        <span class="{{Session::get('direction') === "rtl" ? 'mr-2 mr-sm-3' : 'ml-2 ml-sm-3'}}">
                        <i class="tio-date-range">
                        </i> {{translate('joined_At').':'.date('d M Y H:i:s',strtotime($customer['created_at']))}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="p-3">
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-merge input-group-custom">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="searchValue"
                                               class="form-control"
                                               placeholder="{{translate('search_orders')}}" aria-label="Search orders"
                                               value="{{ request('searchValue') }}"
                                               required>
                                        <button type="submit" class="btn btn--primary">{{translate('search')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{translate('sl')}}</th>
                                <th>{{translate('avatar')}}</th>
                                <th>{{translate('child_name')}}</th>
                                <th>{{translate('gender')}}</th>
                                <th>{{translate('date_of_birth')}}</th>
                                {{-- <th class="text-center">{{translate('action')}}</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer->childs as $child)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img class="avatar avatar-xxl" width="75" style="border-radius: 50%" src="{{asset('public/assets/images/customers/child/'.$child->profile_picture)}}" alt="avatar">
                                    </td>
                                    <td>{{$child->name}}</td>
                                    <td>{{($child->gender == 1) ? 'Male' : 'Female'}}</td>
                                    <td>{{$child->dob}}</td>
                                    {{-- <td>
                                        <a href="{{route('admin.orders.details',['id'=>$order['id']])}}"
                                           class="title-color hover-c1">{{$order['id']}}</a>
                                    </td>
                                    <td> {{setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order['order_amount']))}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-10">
                                            <a class="btn btn-outline--primary btn-sm edit square-btn"
                                               title="{{translate('view')}}"
                                               href="{{route('admin.orders.details',['id'=>$order['id']])}}"><i
                                                    class="tio-invisible"></i> </a>
                                            <a class="btn btn-outline-info btn-sm square-btn"
                                               title="{{translate('invoice')}}"
                                               target="_blank"
                                               href="{{route('admin.orders.generate-invoice',[$order['id']])}}"><i
                                                    class="tio-download"></i> </a>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($customer->childs)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 w-160"
                                     src="{{asset('public/assets/back-end/svg/illustrations/sorry.svg')}}"
                                     alt="{{translate('image_description')}}">
                                <p class="mb-0">{{ translate('no_data_to_show')}}</p>
                            </div>
                        @endif
                        <div class="card-footer">
                            {{-- {!! $orders->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    @if($customer)
                        <div class="card-body">
                            <h4 class="mb-4 d-flex align-items-center gap-2">
                                <img src="{{asset('/public/assets/back-end/img/vendor-information.png')}}" alt="">
                                {{translate('customer')}}
                            </h4>

                            <div class="media">
                                <div class="mr-3">
                                    <img class="avatar rounded-circle avatar-70" src="{{ getValidImage(path: 'storage/app/public/profile/'. $customer['image'] , type: 'backend-profile') }}"
                                        alt="{{translate('image')}}">
                                </div>
                                <div class="media-body d-flex flex-column gap-1">
                                    <span class="title-color hover-c1"><strong>{{$customer['f_name'].' '.$customer['l_name']}}</strong></span>
                                    <span class="title-color">
                                        <strong>{{count($customer->childs)}} </strong>{{translate('childerens')}}
                                    </span>
                                    <span class="title-color"><strong>{{$customer['phone']}}</strong></span>
                                    <span class="title-color">{{$customer['email']}}</span>
                                </div>
                                <div class="media-body text-right">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add Child
                          </button>
                    @endif

                    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Child</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.customer.parent.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $customer->id }}">
            <div class="col-md-12 row mt-3">
                <label for="" class="form-label">Name</label>
                <input required type="text" name="name" placeholder="Enter Name" class="form-control" required>
            </div>
            <div class="col-md-12 row mt-3">
                <label for="" class="form-label">Relation Type</label>
                <input required type="text" name="relation_type" placeholder="Enter Relation Type" class="form-control" required>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Profile Picture</label>
                    <input required type="file" name="profile_picture" placeholder="Enter Image" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Date Of Birth</label>
                    <input required type="date" name="dob" class="form-control">
                </div>
            </div>
            <div class="col-md-12 row mt-3">
                <label for="" class="form-label">Gender</label>
                <select class="form-control" name="gender" id="">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
