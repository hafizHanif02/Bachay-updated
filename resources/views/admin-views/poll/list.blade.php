@extends('layouts.back-end.app')

@section('title', 'Poll')

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
                        <form id="pollForm" action="{{ route('admin.poll.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label class="form-label" for="categoryName">Question</label>
                                    <input type="text" class="form-control" placeholder="Enter Question" id="question" name="question" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="categoryName">Start Date</label>
                                    <input type="date" class="form-control" placeholder="Enter Start Date" id="start_date" name="start_date" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label class="form-label" for="categoryName">End Date</label>
                                    <input type="date" class="form-control" placeholder="Enter End Date" id="end_date" name="end_date" required>
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
                                    <th>Question</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th class="text-center">{{translate('action')}} </th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach($polls as $poll)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <span class="d-block">
                                            {{ $poll->question }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-block">
                                            {{ $poll->start_date }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-block">
                                            {{ $poll->end_date }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.poll.status') }}" method="post" id="article_category_status{{$poll->id}}_form" class="article_status_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$poll->id}}">
                                            <label class="switcher mx-auto">
                                                <input type="checkbox" class="switcher_input" id="article_status{{$poll->id}}" name="status" value="1" {{ $poll->status == 1 ? 'checked':'' }} onclick="submitStatusForm({{$poll->id}})">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline--primary btn-sm edit square-btn"
                                               title="{{translate('edit')}}"
                                               href="{{ route('admin.poll.edit', $poll->id) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm delete square-btn"
                                               title="{{translate('delete')}}"
                                               href="{{ route('admin.poll.delete', $poll->id) }}">
                                                <i class="tio-delete"></i>
                                            </a>
                                        </div>
                                    </td>  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="pagination justify-content-center">
                            {{ $polls->links() }}
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
            <form id="articleForm" action="{{ route('admin.poll.store') }}" method="POST" enctype="multipart/form-data">
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
        var rowCount = 0;
        $('#option').click(function() {
            rowCount++;
            var newRow = `<tr id="optionRow_${rowCount}"><td><input type="text" class="form-control" name="option[]" placeholder="Enter Option"></td><td><button class="btn btn-danger btn-sm remove-product" data-product-id="${rowCount}">Remove</button></td></tr>`;
            $('#option_table').append(newRow);
        });
        $(document).on('click', '.remove-product', function() {
            var productId = $(this).data('product-id');
            $('#optionRow_' + productId).remove();
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



