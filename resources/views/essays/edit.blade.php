@extends('layouts.app')

@section('title', _i('Essay result detail'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Select2 styles-->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
@php
	$review_comment_err = $student_name_err = $essay_belong_err = $essay_major_err = $essay_title_err = '';
@endphp
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Essay result detail') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					{{ _i('Essay result detail') }}
				</div>
				<div class="card-body">
						@if (count($errors) > 0)
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							    {{ _i('There were some problems with your input.') }}
							    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
						 	@if($errors->first('review_comment'))
							    @php
							    	$review_comment_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('student_name'))
							    @php
							    	$student_name_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('essay_belong'))
							    @php
							    	$essay_belong_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('essay_major'))
							    @php
							    	$essay_major_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('essay_title'))
							    @php
							    	$essay_title_err = ' is-invalid';
							    @endphp
							@endif
						@endif
						@if ($message = Session::get('success'))
							<script>
								toastr.success('{{ $message }}');
							</script>
						@endif
					{!! Form::model($rows, ['method' => 'PATCH','route' => ['essays.update', $rows->id]]) !!}
						<div class="form-group row">
							<label for="student_name" class="col-sm-3 col-form-label">{{ _i('Student name') }}</label>
							<div class="col-sm-9">
								{!! Form::text('student_name', null, ['id' => 'student_name','class' => 'form-control' . $student_name_err]) !!}
								<span class="text-danger">{{ $errors->first('student_name') }}</span>
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_belong" class="col-sm-3 col-form-label">{{ _i('Belong to') }}</label>
							<div class="col-sm-9">
								{!! Form::text('essay_belong', null, ['id' => 'essay_belong','class' => 'form-control' . $essay_belong_err]) !!}
								<span class="text-danger">{{ $errors->first('essay_belong') }}</span>
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_major" class="col-sm-3 col-form-label">{{ _i('Major') }}</label>
							<div class="col-sm-9">
								{!! Form::text('essay_major', null, ['id' => 'essay_major','class' => 'form-control' . $essay_major_err]) !!}
								<span class="text-danger">{{ $errors->first('essay_major') }}</span>
							</div>
						</div>
						<div class="form-group row mb-3">
							<label for="essay_title" class="col-sm-3 col-form-label">{{ _i('Title') }}</label>
							<div class="col-sm-9">
								{!! Form::text('essay_title', null, ['id' => 'essay_title','class' => 'form-control' .$essay_title_err]) !!}
								<span class="text-danger">{{ $errors->first('essay_title') }}</span>
							</div>
						</div>
						<div class="form-group row">
							<label for="review_status" class="col-sm-3 col-form-label">{{ _i('Status') }}</label>
							<div class="col-sm-9">
								{!! Form::select('review_status', ['pending' => _i('pending'),'reviewing' => _i('reviewing'),'reviewed' => _i('reviewed')], $rows->review_status, ['class' => 'form-control select2','data-minimum-results-for-search'=>'Infinity']) !!}
							</div>
						</div>
						<div class="form-group row">
							<label for="reviewer" class="col-sm-3 col-form-label">{{ _i('Reviewer') }}</label>
							<div class="col-sm-9">
								{!! Form::select('reviewer_id', [$rows->reviewer_id => $rows->reviewer], $rows->reviewer_id, ['class' => 'form-control select2','data-minimum-results-for-search'=>'Infinity']) !!}
								{!! Form::hidden('review_result', null, array()) !!}
							</div>
						</div>
						<div class="form-group row">
							<label for="result" class="col-sm-3 col-form-label">{{ _i('Review result') }}</label>
							<div class="col-sm-9">
								<div class="text-success">{{ _i($rows->review_result) }}</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="file_download" class="col-sm-4 col-form-label">{{ _i('Link to download') }}</label>
							<div class="col-sm-8">
								<a href="{{ Storage::url($rows->essay_file) }}">{{ _i('Download') }}</a>
							</div>
						</div>
						<div class="form-group">
							<label for="comment">{{ _i('Comments') }}</label>
							{!! Form::textarea('review_comment', null, ['id' => 'comment','class' => 'form-control' . $review_comment_err,'rows' => '3']) !!}
							<span class="text-danger">{{ $errors->first('review_comment') }}</span>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4">{{ _i('Save changes') }}</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection

@push('foot')
<!-- Select2 script -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endpush