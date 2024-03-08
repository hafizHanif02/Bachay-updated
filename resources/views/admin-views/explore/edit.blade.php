@extends('layouts.back-end.app')

@section('title', 'Explore Items')

@push('css_or_js')
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
                        <form id="ExploreForm" action="{{ route('admin.explore.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label type="text" class="form-label" for="categoryName">Title</label>
                                    <input class="form-control" placeholder="Enter Title" id="title" name="title"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <div class="mx-auto text-center">
                                        <div class="uploadDnD">
                                            <div class="form-group inputDnD input_image"
                                                data-title="{{ 'Drag and drop file or Browse file' }}">
                                                <input type="file" name="media"
                                                    class="form-control-file text--primary font-weight-bold"
                                                    onchange="readUrl(this)" accept="video/* |image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <label for="name" class="title-color text-capitalize">
                                        Media
                                    </label>
                                    <span class="title-color" id="theme_ratio">( {{ translate('ratio') }} 4:1 )</span>
                                    <p>{{ translate('banner_Image_ratio_is_not_same_for_all_sections_in_website') }}.
                                        {{ translate('please_review_the_ratio_before_upload') }}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">Tags</label>
                                    <input type="text" class="form-control" placeholder="Enter Tags" id="tags"
                                        name="tags" required>
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

                            <table id="products" class="table mt-5">
                                <thead><h3>Products</h3></thead>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($explore->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td><a href="{{ route('admin.explore.item.delete', $item->id) }}"><button type="button" class="btn-danger">Remove</button></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <br>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
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
                function submitStatusForm($id) {
                    $('#article_category_status' + $id + '_form').submit();
                }
            </script>
            {{-- ck editor --}}
            <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
            <script>
                function readUrl(input) {
                    if (input.files && input.files[0]) {
                        let reader = new FileReader();
                        let inputImage = $('.input_image');
                        reader.onload = (e) => {
                            let imageData = e.target.result;
                            input.setAttribute("data-title", "");
                            let img = new Image();
                            img.onload = function() {
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
            <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
            <script>
                $('#editor').ckeditor({
                    contentsLangDirection: '{{ Session::get('direction') }}',
                });
            </script>
            {{-- ck editor --}}
        @endpush
