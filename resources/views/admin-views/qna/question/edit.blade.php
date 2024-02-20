@extends('layouts.back-end.app')

@section('title', 'QNA Questions')

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
					<form action="{{ route('admin.customer.qna.question.update') }}" method="post" enctype="multipart/form-data">
						@csrf
                        <input type="hidden" name="id" value="{{ $question->id }}">
						<div class="row g-3">
							<div class="col-md-12">
								<div class="form-group">
									<label class="title-color text-capitalize"
										   for="exampleFormControlInput1">Question </label>
									<input type="text" value="{{ $question->question }}" name="question" placeholder="Enter Question"  class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row g-3">
							<div class="col-md-12">
								<div class="form-group">
									<label class="title-color text-capitalize"
										   for="exampleFormControlInput1">Select User</label>
                                           <select name="user_id" class="form-control" id="">
                                            <option value="" selected disabled>Select Questioner </option>
                                            <option value="0" {{ ($question->user_id == 0)? 'selected':'' }}  >Admin</option>
                                            @foreach($users as $user)
                                                <option {{ ($question->user_id == $user->id)? 'selected' :'' }}  value="{{$user->id}}">{{$user->f_name}} {{$user->l_name}}</option>
                                            @endforeach
                                           </select>
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



