@extends('layouts.back-end.app')

@section('title', 'QNA Answers')

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
					<form action="{{ route('admin.customer.qna.answer.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row g-3">
                            <div class="col-md-12">
								<div class="form-group">
									<label class="title-color text-capitalize"
										   for="exampleFormControlInput1">Select Question </label>
                                           <select name="user_id" class="form-control" id="">
                                            <option value="" selected disabled>Select question </option>
                                            @foreach($questions as $question)
                                                <option value="{{$question->id}}">{{$question->question}}</option>
                                            @endforeach
                                           </select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="title-color text-capitalize"
										   for="exampleFormControlInput1">Answers </label>
									<input type="text" name="answer" placeholder="Enter Answer"  class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row g-3">
							<div class="col-md-12">
								<div class="form-group">
									<label class="title-color text-capitalize"
										   for="exampleFormControlInput1">Select Answerer</label>
                                           <select name="user_id" class="form-control" id="">
                                            <option value="" selected disabled>Select Answerer </option>
                                            <option value="0">Admin</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->f_name}} {{$user->l_name}}</option>
                                            @endforeach
                                           </select>
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
								Answers
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
										   placeholder="{{translate('search_by_title')}}"
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
							<th>Question</th>
							<th>Answers</th>
							<th>Answerer Name</th>
							<th class="text-center">{{translate('action')}} </th>
						</tr>

						</thead>

						<tbody>
						@foreach($answers as $answer)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$answer->question->question}}</td>
							<td>{{$answer->answer}}</td>
							<td>{{$answer->user_id == 0 ? 'Admin':($answer->user->f_name.' '.$answer->user->l_name)}}</td>
							<td class="text-center">
								<div class="d-flex justify-content-center gap-2">
									<a class="btn btn-outline--primary btn-sm edit square-btn"
									   title="{{translate('edit')}}"
									   href="{{ route('admin.customer.qna.answer.edit', $answer->id) }}">
										<i class="tio-edit"></i>
									</a>
									<form action="{{route('admin.customer.qna.answer.delete')}}" method="post">
									@csrf
									<input type="hidden" name="id" value="{{$answer->id}}">
									<button type="submit" class="btn btn-outline-danger btn-sm delete"
									   title="{{translate('delete')}}"
									   href="javascript:"
									   id="{{$answer->id}}')">
										<i class="tio-delete"></i>
									</button>
									</form>
								</div>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>

					<table class="mt-4">
						<tfoot>
						{{-- {!! $vaccines->links() !!} --}}
						</tfoot>
					</table>
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



