@extends('layouts.back-end.app')

@section('title', 'Parent Articles')

@push('css_or_js')
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">
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
                        <form action="{{ route('admin.parent_article.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="title-color text-capitalize"
                                               for="exampleFormControlInput1">Title </label>
                                        <input type="text" name="title" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="title-color text-capitalize"
                                               for="exampleFormControlInput1">Article Category </label>
                                        <select class="form-control" name="article_category_id">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                        class="title-color text-capitalize">Thumbnail</label>
                                        <span class="text-info"></span>
                                        <div class="custom-file text-left">
                                            <input type="file" name="thumbnail" class="custom-file-input" >
                                            <label class="custom-file-label" for="customFileEg1">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group pt-4">
                                        <label class="title-color"
                                               >Text
                                            </label>
                                        <textarea name="text"
                                                  class="textarea editor-textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="mt-5 btn btn-primary" onclick="openModal()">Add Article Category</button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn btn-secondary">Reset </button>
                                <button type="submit" class="btn btn--primary">Save </button>
                            </div>
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
                                    <th>S no. </th>
                                    <th>Title</th>
                                    {{-- <th>Description</th> --}}
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th class="text-center">{{translate('action')}} </th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach($articles as $article)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <span class="d-block">
                                            {{($article->title)}}
                                        </span>
                                    </td>
                                    {{-- <td>
                                        {{($article->text)}}
                                    </td> --}}
                                    <td>
                                        <img class="min-w-75" width="75" height="75"
                                             src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail) }}" alt="Article Thumbnail">
                                    </td>
                                    <td>{{ $article->articlecategory->name}}</td>
                                    <td>
                                        <form action="{{ route('admin.parent_article.status') }}" method="post" id="article_status{{$article->id}}_form" class="article_status_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$article->id}}">
                                            <label class="switcher mx-auto">
                                                <input type="checkbox" class="switcher_input" id="article_status{{$article->id}}" name="status" value="1" {{ $article->status == 1 ? 'checked':'' }} onclick="submitStatusForm({{$article->id}})">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    {{-- <td>
                                        <a href="javascript:void(0)" class="btn btn-outline-success square-btn btn-sm"
                                           onclick="resendarticle(this)" data-id="{{ $article->id }}">
                                            <i class="tio-refresh"></i>
                                        </a>
                                    </td> --}}
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline--primary btn-sm edit square-btn"
                                               title="{{translate('edit')}}"
                                               href="{{ route('admin.parent_article.edit', $article->id) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <form action="{{route('admin.parent_article.delete')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$article->id}}">
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete"
                                                        title="{{translate('delete')}}"
                                                        href="javascript:"
                                                        id="{{$article->id}}')">
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
                            {{ $articles->links() }}
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
    <script src="{{ asset('public/assets/back-end/js/tags-input.min.js') }}"></script>
    <script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script src="{{ asset('/vendor/ckeditor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/ckeditor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('public/assets/back-end/js/admin/product-add-update.js') }}"></script>
    <script src="{{ asset('public/assets/back-end/js/admin/product-add-colors-img.js') }}"></script>
@endpush

@push('script')
<script>
    function submitStatusForm($id){
        $('#article_status'+$id+'_form').submit();
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



