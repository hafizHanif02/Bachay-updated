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
					<form action="{{ route('admin.customer.qna.answer.update') }}" method="post" enctype="multipart/form-data">
						@csrf
                        <input type="hidden" name="id" value="{{ $answer->id }}">
						<div class="row g-3">
                            <div class="col-md-12">
								<div class="form-group">
									<label class="title-color text-capitalize"
										   for="exampleFormControlInput1">Select Question </label>
                                           <select name="question_id" class="form-control" id="">
                                            <option value="" selected disabled>Select question </option>
                                            @foreach($questions as $question)
                                                <option {{ ($question->id == $answer->question_id)? 'selected' :'' }} value="{{$question->id}}">{{$question->question}}</option>
                                            @endforeach
                                           </select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="title-color text-capitalize"
										   for="exampleFormControlInput1">Answers </label>
									<input type="text" name="answer" value="{{$answer->answer}}" placeholder="Enter Answer"  class="form-control" required>
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
                                            <option value="0" {{ ($answer->user_id == 0)? 'selected' :'' }}>Admin</option>
                                            @foreach($users as $user)
                                                <option  {{ ($user->id == $answer->user_id)? 'selected' :'' }} value="{{$user->id}}">{{$user->f_name}} {{$user->l_name}}</option>
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



