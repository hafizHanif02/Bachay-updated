@extends('layouts.back-end.app')

@section('title', 'Parent Mobile Data')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{asset('/public/assets/back-end/img/Pages.png')}}" alt="">
                {{translate('pages')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.business-settings.pages-inline-menu')
        <!-- End Inlile Menu -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form id="pollForm" action="{{ route('admin.parent_mobile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label class="form-label" for="categoryName">Image</label>
                                    <input type="file" class="form-control" placeholder="Enter Image" id="image" name="image" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="link">Link</label>
                                    <input type="text" class="form-control" placeholder="Enter Link" id="link" name="link" required>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="top_banner">Top Banner</option>
                                        <option value="scroll_one">Scroll One</option>
                                        <option value="scroll_two">Scroll Two</option>
                                        <option value="scroll_three">Scroll Three</option>
                                        <option value="middle_banner">Middle Banner</option>
                                        <option value="scroll_four">Scroll Four</option>
                                        <option value="bottom_banner">Bottom Banner</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label class="form-label" for="width">Width</label>
                                    <input type="text" class="form-control" placeholder="Enter Width" id="width" name="width">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="margin_bottom">Margin Bottom</label>
                                    <input type="text" class="form-control" placeholder="Enter Margin Bottom" id="margin_bottom" name="margin_bottom">
                                </div>
                            </div>
                            
                            <br>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2">
                                    Parent Mobile Data
                                    <span
                                        class="badge badge-soft-dark radius-50 fz-12 ml-1"></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-merge input-group-custom">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{translate('search_by_Title')}}"
                                               aria-label="Search orders" value="" required>
                                        <button type="submit"
                                                class="btn btn--primary">{{translate('search')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr class="text-center">
                                    <th>S no.</th>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th class="text-center">{{translate('action')}} </th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach($parent_mobile_data as $data)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <span class="d-block">
                                            <img src="{{ asset('public/assets/images/parent_mobile/'.$data->image) }}" style="width: {{ $data->width }};" alt="">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-block">
                                            {{ $data->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-block">
                                            {{ $data->link }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.parent_mobile.status') }}" method="post" id="article_category_status{{$data->id}}_form" class="article_status_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <label class="switcher mx-auto">
                                                <input type="checkbox" class="switcher_input" id="article_status{{$data->id}}" name="status" value="1" {{ $data->status == 1 ? 'checked':'' }} onclick="submitStatusForm({{$data->id}})">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline--primary btn-sm edit square-btn"
                                               title="{{translate('edit')}}"
                                               href="{{ route('admin.parent_mobile.edit', $data->id) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm delete square-btn"
                                               title="{{translate('delete')}}"
                                               href="{{ route('admin.parent_mobile.delete', $data->id) }}">
                                                <i class="tio-delete"></i>
                                            </a>
                                        </div>
                                    </td>  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="pagination justify-content-center">
                            {{ $parent_mobile_data->links() }}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
    <script>
        function submitStatusForm($id){
          $('#article_category_status'+$id+'_form').submit();
      }
  </script>
@endsection



