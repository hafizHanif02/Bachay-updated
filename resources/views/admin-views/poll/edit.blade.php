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
                        <form id="pollForm" action="{{ route('admin.poll.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $poll->id }}">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label class="form-label" for="categoryName">Question</label>
                                    <input type="text" class="form-control" value="{{ $poll->question }}" placeholder="Enter Question" id="question" name="question" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="categoryName">Start Date</label>
                                    <input type="date" class="form-control" value="{{ $poll->start_date }}" placeholder="Enter Start Date" id="start_date" name="start_date" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">End Date</label>
                                    <input type="date" class="form-control" value="{{ $poll->end_date }}" placeholder="Enter End Date" id="end_date" name="end_date" required>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5">
                                <div class="col-md-12">
                                    <div class="btn btn-success" id="option">Add Option</div>
                                </div>
                            </div>
                            
                            <table id="option_table" class="table">
                                <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($poll->poll_option as $option)
                                    <tr id="optionRow_{{ $loop->iteration }}">
                                        <td>
                                            <input type="text" class="form-control" name="option[{{ $loop->iteration }}]" placeholder="Enter Option" value="{{ $option->option }}">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.poll.option.delete', $option->id) }}"><button type="button" class="btn-danger">Remove</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <button class="btn btn-primary" type="submit">Submit</button>
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
                $('#option').click(function() {
                    var rowCount = $('#option_table tbody tr').length + 1;
                    var newRow = `<tr id="optionRow_${rowCount}">
                                    <td>
                                        <input type="text" class="form-control option-input" name="option[]" placeholder="Enter Option">
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm remove-product">Remove</button>
                                    </td>
                                </tr>`;
                    $('#option_table tbody').append(newRow);
                });
            $(document).on('click', '.remove-product', function() {
                    $(this).closest('tr').remove();
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
