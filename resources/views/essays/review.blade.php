@extends('layouts.guess')

@section('title', _i('Essay review form'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Select2 styles-->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ _i('Essay review form') }}</div>
				<div class="card-body">
						@if (count($errors) > 0)
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							    {{ _i('There were some problems with your input.') }}
							    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
						@endif
						@if ($message = Session::get('success'))
							<div class="alert alert-success" role="alert">
							   {{ $message }}
							</div>
						@endif
					{!! Form::model($rows, ['method' => 'PATCH','route' => ['essays.update', $rows->id]]) !!}
						<div class="row">
						    <div class="review-form col-lg-6 col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<label for="student_name">{{ _i('Student name') }}</label>
									<div class="alert alert-secondary" role="alert">
									  	{{ $rows->student_name}}
									</div>
										{!! Form::hidden('student_name', null, array('id' => 'student_name','class' => 'form-control')) !!}
								</div>
								<div class="form-group">
									<label for="essay_belong">{{ _i('Belong to') }}</label>
									<div class="alert alert-secondary" role="alert">
									  	{{ $rows->essay_belong}}
									</div>
										{!! Form::hidden('essay_belong', null, ['id' => 'essay_belong','class' => 'form-control']) !!}
								</div>
								<div class="form-group">
									<label for="essay_major">{{ _i('Major') }}</label>
									<div class="alert alert-secondary" role="alert">
									  	{{ $rows->essay_major}}
									</div>
										{!! Form::hidden('essay_major', null, ['id' => 'essay_major','class' => 'form-control']) !!}
								</div>
								<div class="form-group mb-3">
									<label for="essay_title">{{ _i('Title') }}</label>
									<div class="alert alert-secondary" role="alert">
									  	{{ $rows->essay_title}}
									</div>
										{!! Form::hidden('essay_title', null, ['id' => 'essay_title','class' => 'form-control']) !!}
								</div>
								<div class="form-group mb-3">
									<label for="essay_title">{{ _i('Link to download') }}</label>
									<a  href="{{ Storage::url($rows->essay_file) }}" class="btn btn-warning btn-lg btn-block"><i class="fa fa-download" aria-hidden="true"></i> {{ _i('Download') }}</a>
								</div>
							</div>

						    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<label for="reviewer">{{ _i('Reviewer') }}</label>
										{!! Form::select('reviewer_id', [$rows->reviewer_id => $rows->reviewer], $rows->reviewer_id, ['class' => 'form-control select2','data-minimum-results-for-search'=>'Infinity']) !!}
								</div>
								<div class="form-group">
									<label for="review_status">{{ _i('Review result') }}</label>
										{!! Form::select('review_result', ['good' => _i(RESULT_GOOD),'bad' => _i(RESULT_BAD)], $rows->review_result, ['class' => 'form-control select2', 'placeholder' => _i(RESULT_NONE) ,'data-minimum-results-for-search'=>'Infinity']) !!}
										<span class="text-danger">{{ $errors->first('review_result') }}</span>
								</div>
								<div class="form-group">
									<label for="comment">{{ _i('Comments') }}</label>
									{!! Form::textarea('review_comment', null, ['id' => 'comment','class' => 'form-control','rows' => '5']) !!}
									<span class="text-danger">{{ $errors->first('review_comment') }}</span>
								</div>
								<div class="d-flex justify-content-end">
									<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4 mt-3">{{ _i('Save changes') }}</button>
								</div>
							</div>
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