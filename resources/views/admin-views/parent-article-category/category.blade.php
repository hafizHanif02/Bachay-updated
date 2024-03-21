@extends('layouts.back-end.app')

@section('title', 'Parent Article Category')

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
                        <form id="articleForm" action="{{ route('admin.parent_article.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label type="text" class="form-label" for="categoryName">Name</label>
                                    <input class="form-control" placeholder="Enter Category Name" id="categoryName" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="categoryName">Image</label>
                                    <input type="file" class="form-control" placeholder="Image" id="Image" name="image" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Tag Line</label>
                                    <input type="text" class="form-control" placeholder="Article Category Tag Line" id="tag_line" name="tag_line" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Parent Category</label>
                                    <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="">Select Parent Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
            
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
                                    Article
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
                                <tr>
                                    <th>S no.</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th class="text-center">{{translate('action')}} </th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <span class="d-block">
                                            {{ $category->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <img class="min-w-75" width="75" height="75"
                                        src="{{ asset('public/assets/images/parent_articles/category/thumbnail/' . $category->image) }}" alt="Article Category Thumbnail">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.parent_article.category.status') }}" method="post" id="article_category_status{{$category->id}}_form" class="article_status_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$category->id}}">
                                            <label class="switcher mx-auto">
                                                <input type="checkbox" class="switcher_input" id="article_status{{$category->id}}" name="status" value="1" {{ $category->status == 1 ? 'checked':'' }} onclick="submitStatusForm({{$category->id}})">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline--primary btn-sm edit square-btn"
                                               title="{{translate('edit')}}"
                                               href="{{ route('admin.parent_article.category.edit', $category->id) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <form action="{{route('admin.parent_article.category.delete')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$category->id}}">
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete"
                                                        title="{{translate('delete')}}"
                                                        href="javascript:"
                                                        id="{{$category->id}}')">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="pagination justify-content-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close text-end" onclick="closeModal()">&times;</span>
            <h2>Add Article Category</h2>
            <form id="articleForm" action="{{ route('admin.parent_article.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-5">
                    <div class="col-md-6">
                        <label type="text" class="form-label" for="categoryName">Name</label>
                        <input class="form-control" placeholder="Enter Category Name" id="categoryName" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="categoryName">Image</label>
                        <input type="file" class="form-control" placeholder="Image" id="Image" name="image" required>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <label class="form-label" for="categoryName">Tag Line</label>
                        <input type="text" class="form-control" placeholder="Article Category Tag Line" id="tag_line" name="tag_line" required>
                    </div>
                </div>
                <div class="row mt-5">

                </div>
                <br>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
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
    function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    
</script>
@endsection

@push('script')
<script>
      function submitStatusForm($id){
        $('#article_category_status'+$id+'_form').submit();
    }
</script>
    {{--ck editor--}}
    <script src="{{asset('/')}}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="{{asset('/')}}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
        $('#editor').ckeditor({
            contentsLangDirection : '{{Session::get('direction')}}',
        });
    </script>
    {{--ck editor--}}
@endpush



