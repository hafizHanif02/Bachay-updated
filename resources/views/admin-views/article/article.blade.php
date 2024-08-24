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
                        <form action="{{ route('admin.article.store') }}" method="post" enctype="multipart/form-data">
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
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <div class="d-flex gap-2">
                                            <i class="tio-user-big"></i>
                                            <h4 class="mb-0">
                                                {{ translate('seo_section') }}
                                                <span class="input-label-secondary cursor-pointer" data-toggle="tooltip"
                                                    data-placement="right"
                                                    title="{{ translate('add_meta_titles_descriptions_and_images_for_products').', '.translate('this_will_help_more_people_to_find_them_on_search_engines_and_see_the_right_details_while_sharing_on_other_social_platforms') }}">
                                                    <img src="{{ asset('public/assets/back-end/img/info-circle.svg') }}" alt="">
                                                </span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="title-color">
                                                        {{ translate('meta_Title') }}
                                                        <span class="input-label-secondary cursor-pointer" data-toggle="tooltip"
                                                              data-placement="right"
                                                              title="{{ translate('add_the_products_title_name_taglines_etc_here').' '.translate('this_title_will_be_seen_on_Search_Engine_Results_Pages_and_while_sharing_the_products_link_on_social_platforms') .' [ '. translate('character_Limit') }} : 100 ]">
                                                            <img src="{{ asset('public/assets/back-end/img/info-circle.svg') }}" alt="">
                                                        </span>
                                                    </label>
                                                    <input type="text" name="meta_title" placeholder="{{ translate('meta_Title') }}"
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="title-color">
                                                        {{ translate('meta_Description') }}
                                                        <span class="input-label-secondary cursor-pointer" data-toggle="tooltip"
                                                              data-placement="right"
                                                              title="{{ translate('write_a_short_description_of_the_InHouse_shops_product').' '.translate('this_description_will_be_seen_on_Search_Engine_Results_Pages_and_while_sharing_the_products_link_on_social_platforms') .' [ '. translate('character_Limit') }} : 100 ]">
                                                            <img src="{{ asset('public/assets/back-end/img/info-circle.svg') }}" alt="">
                                                        </span>
                                                    </label>
                                                    <textarea rows="4" type="text" name="meta_description" class="form-control"></textarea>
                                                </div>
                                            </div>
                    
                                            <div class="col-md-4">
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-group w-100">
                                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                                            <div>
                                                                <label class="title-color" for="meta_Image">
                                                                    {{ translate('meta_Image') }}
                                                                </label>
                                                                <span
                                                                    class="badge badge-soft-info">{{ THEME_RATIO[theme_root_path()]['Meta Thumbnail'] }}</span>
                                                                <span class="input-label-secondary cursor-pointer" data-toggle="tooltip"
                                                                      title="{{ translate('add_Meta_Image_in') }} JPG, PNG or JPEG {{ translate('format_within') }} 2MB, {{ translate('which_will_be_shown_in_search_engine_results') }}.">
                                                                    <img src="{{ asset('public/assets/back-end/img/info-circle.svg') }}"
                                                                         alt="">
                                                                </span>
                                                            </div>
                    
                                                        </div>
                    
                                                        <div>
                                                            <div class="custom_upload_input">
                                                                <input type="file" name="meta_image"
                                                                       class="custom-upload-input-file meta-img action-upload-color-image" id=""
                                                                       data-imgpreview="pre_meta_image_viewer"
                                                                       accept=".jpg, .webp, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                    
                                                                <span class="delete_file_input btn btn-outline-danger btn-sm square-btn d--none">
                                                                    <i class="tio-delete"></i>
                                                                </span>
                    
                                                                <div class="img_area_with_preview position-absolute z-index-2">
                                                                    <img id="pre_meta_image_viewer" class="h-auto bg-white onerror-add-class-d-none" alt=""
                                                                         src="{{ asset('public/assets/back-end/img/icons/product-upload-icon.svg-dummy') }}">
                                                                </div>
                                                                <div
                                                                    class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center align-items-center">
                                                                        <img alt="" class="w-75"
                                                                             src="{{ asset('public/assets/back-end/img/icons/product-upload-icon.svg') }}">
                                                                        <h3 class="text-muted">{{ translate('Upload_Image') }}</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
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
                                             src="{{ asset('public/assets/images/articles/thumbnail/' . $article->thumbnail) }}" alt="Article Thumbnail">
                                    </td>
                                    <td>{{ $article->articlecategory->name}}</td>
                                    <td>
                                        <form action="{{ route('admin.article.status') }}" method="post" id="article_status{{$article->id}}_form" class="article_status_form">
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
                                               href="{{ route('admin.article.edit', $article->id) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <form action="{{route('admin.article.delete')}}" method="post">
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
            <form id="articleForm" action="{{ route('admin.article.category.store') }}" method="POST" enctype="multipart/form-data">
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



