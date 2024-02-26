@extends('layouts.back-end.app')

@section('title', 'Articles')


@push('css_or_js')
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('/public/assets/back-end/img/Pages.png') }}" alt="">
                {{ translate('pages') }}
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
                        <form action="{{ route('admin.article.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $article->id }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="title-color text-capitalize" for="exampleFormControlInput1">Title
                                        </label>
                                        <input type="text" value="{{ $article->title }}" name="title"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="title-color text-capitalize" for="exampleFormControlInput1">Article
                                            Category </label>
                                        <select class="form-control" name="article_category_id">
                                            <option value="" disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $article->article_category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="title-color text-capitalize">Thumbnail</label>
                                        <span class="text-info"></span>
                                        <div class="custom-file text-left">
                                            <input type="file" value="{{ $article->thumbnail }}" name="thumbnail"
                                                class="custom-file-input">
                                            <label class="custom-file-label" for="customFileEg1">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group pt-4">
                                        <label class="title-color">Text
                                        </label>
                                        <textarea name="text[]" value="{{ $article->text }}" class="textarea editor-textarea">{{ $article->text }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="mt-5 btn btn-primary" onclick="openModal()">Add
                                            Article Category</button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn btn-secondary">Reset </button>
                                <button type="submit" class="btn btn--primary">Update </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>
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
    {{-- ck editor --}}
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
        $('#editor').ckeditor({
            contentsLangDirection: '{{ Session::get('direction') }}',
        });
    </script>
    {{-- ck editor --}}
@endpush
