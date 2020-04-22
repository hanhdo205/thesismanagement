@extends('layouts.guess')

@section('title',  $topic->title  )
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
@php
	$student_name_err = '';
	$student_dob_err = '';
	$student_email_err = '';
	$essay_belong_err = '';
	$essay_major_err = '';
	$essay_title_err = '';
	$essay_file_err = '';
	$readonly = 'readonly';
	$disabled = '';
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ _i('Registration form for essay writing competetion') }}</div>

                <div class="card-body">
                    <div class="card-text">
						<div class="row">
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Title') }}:
						            {{ $topic->title }}</strong>
						        </div>
						    </div>
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Period') }}:
						            @php
						            $from = Carbon\Carbon::createFromDate($topic->start_date)->format('Y年m月d日');
									$to = Carbon\Carbon::createFromDate($topic->end_date)->format('Y年m月d日');
						            @endphp
						            {{ $from . ' ～ ' . $to }} ({{ $status }})</strong>
						        </div>
						    </div>
						</div>
						@if ($message = Session::get('success'))
							<div class="alert alert-success" role="alert">
							   {{ $message }}
							</div>
						@endif
						@if (count($errors) > 0)
							@if($errors->first('student_name'))
							    @php
							    	$student_name_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('student_dob'))
							    @php
							    	$student_dob_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('student_email'))
							    @php
							    	$student_email_err = ' is-invalid';
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
							@if($errors->first('essay_file'))
							    @php
							    	$essay_file_err = ' is-invalid';
							    @endphp
							@endif
				  <div class="alert alert-danger alert-dismissible fade show" role="alert">
				    {{ _i('There were some problems with your input.') }}
				    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				  </div>
						@endif
						{!! Form::open(['id' => 'register_essay','route' => 'register.endai_teisyutu','method'=>'POST', 'enctype'=>'multipart/form-data','novalidate']) !!}
						@if($status != _i(AVAILABLE))
							<fieldset disabled="disabled">
								@php
									$readonly = '';
									$disabled = 'disabled';
								@endphp
						@endif
						{!! Form::hidden('topic_id', $topic->id) !!}
							<fieldset class="form-border">
								<legend class="form-border">{{ _i('Student info') }}</legend>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="row">
									    <div class="col-md-6">
									        <div class="form-group">
									            <strong>{{ _i('Full name') }}</strong>
									            {!! Form::text('student_name', null, ['placeholder' => _i('Full name'),'class' => 'form-control' . $student_name_err]) !!}
									            <span class="invalid-feedback">{{ $errors->first('student_name') }}</span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group">
									            <strong>{{ _i('Gender') }}</strong>
									            <div class="form-group mt-2">
										            {!! Form::radio('student_gender', 'male' , true,  ['id'=>'male']) !!}
													{!! Form::label('male', _i('Male')) !!}
										            {!! Form::radio('student_gender', 'female' , false,  ['id'=>'female']) !!}
			  										{!! Form::label('female', _i('Female')) !!}
										        </div>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group">
									            <strong>{{ _i('Date of birth') }}</strong>
									            {!! Form::text('student_dob', null, ['placeholder' => _i('Date of birth'),'id' => 'dateOfBirth','class' => 'form-control' . $student_dob_err,'autocomplete' => 'off']) !!}
									            <span class="invalid-feedback">{{ $errors->first('student_dob') }}</span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group">
									            <strong>{{ _i('Email address') }}</strong>
									            {!! Form::email('student_email', null, ['placeholder' => _i('Email address'),'id' => 'emailAddress','class' => 'form-control' . $student_email_err,'autocomplete' => 'off']) !!}
									            <span class="invalid-feedback">{{ $errors->first('student_email') }}</span>
									        </div>
									    </div>
								    </div>
							    </div>
						    </fieldset>

				    		<fieldset class="form-border">
								<legend class="form-border">{{ _i('Essay info') }}</legend>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							    	<div class="row">
									    <div class="col-md-6">
									        <div class="form-group">
									            <strong>{{ _i('Belong to') }}</strong>
									            {!! Form::text('essay_belong', null, array('placeholder' => _i('Belong to'),'class' => 'form-control' . $essay_belong_err)) !!}
									            <span class="invalid-feedback">{{ $errors->first('essay_belong') }}</span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group">
									            <strong>{{ _i('Major') }}</strong>
									            {!! Form::text('essay_major', null, ['placeholder' => _i('Major'),'class' => 'form-control' . $essay_major_err]) !!}
									            <span class="invalid-feedback">{{ $errors->first('essay_major') }}</span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group">
									            <strong>{{ _i('Title') }}</strong>
									            {!! Form::text('essay_title', null, ['placeholder' => _i('Title'),'class' => 'form-control' . $essay_title_err]) !!}
									            <span class="invalid-feedback">{{ $errors->first('essay_title') }}</span>
									        </div>
									    </div>
									    <div class="col-md-6">
								            <strong>{{ _i('Upload') }}</strong>
								            <span class="form-group input-group div-select-csv-file">
							                	{!! Form::hidden('essay_file_name_txt',null,['class' => 'essay_file_name_txt input full upload form-control' . $essay_file_err, 'placeholder' => _i('No file chosen'), 'autocomplete' => 'off',$readonly]) !!}
												<span class="input-group">
													<label for="essay_upload_file" class="btn btn-primary" {{ $disabled }}><i class="fa fa-upload" aria-hidden="true"></i> {{ _i('Choose file') }}</label>
												</span>
												<span class="invalid-feedback">{{ $errors->first('essay_file') }}</span>
											</span>

								            {!! Form::file('essay_file', ['id' => 'essay_upload_file','class' => 'form-control', 'style' => 'visibility:hidden;height:0;padding:0;']) !!}
								        </div>
							        </div>
						        </div>
						    </fieldset>
							<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						    	{!! Form::submit(_i('Register Essay'), ['class' => 'btn btn-primary pl-5 pr-5 mt-3']) !!}
						    </div>
						    @if($status != _i(AVAILABLE))
							</fieldset>
							@endif
						{!! Form::close() !!}
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection