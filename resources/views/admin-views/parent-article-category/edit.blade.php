@extends('layouts.back-end.app')

@section('title', 'Parent Articles')

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
                        <form id="articleForm" action="{{ route('admin.parent_article.category.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label type="text" class="form-label" for="categoryName">Name</label>
                                    <input class="form-control" value="{{ $category->name }}" placeholder="Enter Category Name" id="categoryName" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="categoryName">Image</label>
                                    <input type="file" class="form-control" value=" {{ $category->image }}" placeholder="Image" id="Image" name="image" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Tag Line</label>
                                    <input type="text" class="form-control" value="{{ $category->tag_line }}"placeholder="Article Category Tag Line" id="tag_line" name="tag_line" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Parent Category</label>
                                    <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="" disabled>Select Parent Category</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}" {{ $categorie->id == $category->parent_id ? 'selected' : '' }}>{{ $categorie->name }}</option>
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
            <!-- End Table -->
        </div>
    </div>
@endsection

@push('script')
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
