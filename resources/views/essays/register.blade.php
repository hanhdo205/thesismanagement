@extends('layouts.guess')

@section('title',  $topic->title  )
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ _i('Registration form for essay writing competetion') }}</div>

                <div class="card-body">
                    <div class="card-text">
                    	@if ($message = Session::get('success'))
							<div class="alert alert-success" role="alert">
							   {{ $message }}
							</div>
						@endif
						@if (count($errors) > 0)
						    <div class="alert alert-danger">
						        <strong>Whoops!</strong> There were some problems with your input.<br><br>
						        <ul>
						        @foreach ($errors->all() as $error)
						            <li>{{ $error }}</li>
						        @endforeach
						        </ul>
						    </div>
						@endif
						<div class="row">
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Title') }}</strong>
						            {{ $topic->title }}
						        </div>
						    </div>
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Registration date') }}</strong>
						            {{ $topic->start_date . ' ~ ' . $topic->end_date }}
						        </div>
						    </div>
						</div>
						{!! Form::open(array('route' => 'register.endai_teisyutu','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
						{!! Form::hidden('topic_id', $topic->id) !!}
							<div class="row">
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Full name') }}</strong>
							            {!! Form::text('student_name', null, array('placeholder' => _i('Full name'),'class' => 'form-control')) !!}
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Gender') }}</strong>
							            <div class="form-group mt-3">
								            {!! Form::radio('student_gender', 'male' , true,  array('id'=>'male')) !!}
											{!! Form::label('male', _i('Male')) !!}
								            {!! Form::radio('student_gender', 'female' , false,  array('id'=>'female')) !!}
	  										{!! Form::label('female', _i('Female')) !!}
								        </div>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Date of birth') }}:</strong>
							            {!! Form::text('student_dob', null, array('placeholder' => _i('Date of birth'),'id' => 'dateOfBirth','class' => 'form-control','autocomplete' => 'off')) !!}
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Email address') }}:</strong>
							            {!! Form::email('student_email', null, array('placeholder' => _i('Email address'),'id' => 'emailAddress','class' => 'form-control','autocomplete' => 'off')) !!}
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Title') }}</strong>
							            {!! Form::text('essay_title', null, array('placeholder' => _i('Title'),'class' => 'form-control')) !!}
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _I('Upload') }}</strong>
							            <span class="input-group div-select-csv-file">
						                	{!! Form::text('essay_file_name_txt',null,array('class' => 'essay_file_name_txt input full upload form-control', 'placeholder' => _i('No file chosen'), 'autocomplete' => 'off')) !!}
											<span class="input-group-append">
												<label for="essay_upload_file" class="btn btn-primary">{{ _i('Choose file') }}</label></span>
											</span>
										</span>
							            {!! Form::file('essay_file', array('id' => 'essay_upload_file','class' => 'form-control', 'style' => 'visibility:hidden;height:0;padding:0;')) !!}
							        </div>
							    </div>

							    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
							    	{!! Form::submit(_i('Submit'), array('class' => 'btn btn-primary')) !!}
							    </div>
							</div>
						{!! Form::close() !!}
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection