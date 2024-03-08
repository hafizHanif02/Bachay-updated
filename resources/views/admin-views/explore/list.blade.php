@extends('layouts.back-end.app')

@section('title', 'Explore Items')

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
                        <form id="ExploreForm" action="{{ route('admin.explore.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label type="text" class="form-label" for="categoryName">Title</label>
                                    <input class="form-control" placeholder="Enter Title" id="title" name="title" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="mx-auto text-center">
                                        <div class="uploadDnD">
                                            <div class="form-group inputDnD input_image" data-title="{{ 'Drag and drop file or Browse file' }}">
                                                <input type="file" name="media" class="form-control-file text--primary font-weight-bold" onchange="readUrl(this)" accept="video/* |image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <label for="name" class="title-color text-capitalize">
                                        Media
                                    </label>
                                    <span class="title-color" id="theme_ratio">( {{ translate('ratio') }} 4:1 )</span>
                                    <p>{{ translate('banner_Image_ratio_is_not_same_for_all_sections_in_website') }}. {{ translate('please_review_the_ratio_before_upload') }}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Tags</label>
                                    <input type="text" class="form-control" placeholder="Enter Tags" id="tags" name="tags" required>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Products</label>
                                    <select name="products" class="form-control" id="productSelect">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <table id="products" class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Product options will be added here -->
                                </tbody>
                            </table>
                            
                            
                            
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
                                <tr class="text-center">
                                    <th>S no.</th>
                                    <th>Title</th>
                                    <th>Media</th>
                                    <th>Status</th>
                                    <th class="text-center">{{translate('action')}} </th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach($explores as $explore)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <span class="d-block">
                                            {{ $explore->title }}
                                        </span>
                                    </td>
                                    <td>
                                        @if (in_array(pathinfo($explore->media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'mkv']))
                                            <video class="min-w-150" width="150" height="150" autoplay preload="auto"  controls>
                                                <source src="{{ asset('public/assets/images/explore/media/' . $explore->media) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img class="min-w-150" width="150" height="150"
                                                src="{{ asset('public/assets/images/explore/media/' . $explore->media) }}" alt="Explore Media">
                                        @endif

                                    </td>
                                    <td>
                                        <form action="{{ route('admin.explore.status') }}" method="post" id="article_category_status{{$explore->id}}_form" class="article_status_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$explore->id}}">
                                            <label class="switcher mx-auto">
                                                <input type="checkbox" class="switcher_input" id="article_status{{$explore->id}}" name="status" value="1" {{ $explore->status == 1 ? 'checked':'' }} onclick="submitStatusForm({{$explore->id}})">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline--primary btn-sm edit square-btn"
                                               title="{{translate('edit')}}"
                                               href="{{ route('admin.explore.edit', $explore->id) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm delete square-btn"
                                               title="{{translate('delete')}}"
                                               href="{{ route('admin.explore.delete', $explore->id) }}">
                                                <i class="tio-delete"></i>
                                            </a>
                                        </div>
                                    </td>  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="pagination justify-content-center">
                            {{ $explores->links() }}
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
            <form id="articleForm" action="{{ route('admin.explore.store') }}" method="POST" enctype="multipart/form-data">
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
    $(document).ready(function() {
        // Initialize select2 for searchable select
        $('#productSelect').select2();

        // When an option is selected
        $('#productSelect').on('select2:select', function(e) {
            var data = e.params.data;
            var productName = data.text;
            var productId = data.id;

            // Append the selected product to the table
            var newRow = `<tr id="productRow_${productId}"><td>${productName}<input type="hidden" name="products[]" value="${productId}"></td><td><button class="btn btn-danger btn-sm remove-product" data-product-id="${productId}">Remove</button></td></tr>`;
            $('#products tbody').append(newRow);
        });

        // When the remove button is clicked
        $(document).on('click', '.remove-product', function() {
            var productId = $(this).data('product-id');
            $('#productRow_' + productId).remove();
        });
    });
</script>




<script>
      function submitStatusForm($id){
        $('#article_category_status'+$id+'_form').submit();
    }
</script>
    {{--ck editor--}}
    <script src="{{asset('/')}}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script>
        function readUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                let inputImage = $('.input_image');
                reader.onload = (e) => {
                    let imageData = e.target.result;
                    input.setAttribute("data-title", "");
                    let img = new Image();
                    img.onload = function () {
                        inputImage.css({
                            "background-image": `url('${imageData}')`,
                            "width": "100%",
                            "height": "auto",
                            backgroundPosition: "center",
                            backgroundSize: "contain",
                            backgroundRepeat: "no-repeat",
                        });
                        inputImage.addClass('hide-before-content')
                    };
                    img.src = imageData;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="{{asset('/')}}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
        $('#editor').ckeditor({
            contentsLangDirection : '{{Session::get('direction')}}',
        });
    </script>
    {{--ck editor--}}
@endpush



