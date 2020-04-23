@extends('layouts.app')

@section('title', _i('Create New User'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Select2 styles-->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
@php
	$name_err = $mail_err = $password_err = $confirm_password_err = $roles_err = '';
@endphp
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ _i('User management') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Create New User') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					{{ _i('Create New User') }}
				</div>
				<div class="card-body">
					<div class="card-text">
						@if (count($errors) > 0)
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							    {{ _i('There were some problems with your input.') }}
							    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						  	</div>
						  	@if($errors->first('name'))
							    @php
							    	$name_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('mail'))
							    @php
							    	$mail_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('password'))
							    @php
							    	$password_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('password-confirm'))
							    @php
							    	$confirm_password_err = ' is-invalid';
							    @endphp
							@endif
							@if($errors->first('roles'))
							    @php
							    	$roles_err = ' is-invalid';
							    @endphp
							@endif

						@endif
						@if ($message = Session::get('success'))
							<script>
								toastr.success('{{ $message }}');
							</script>
						@endif
						{!! Form::open(['route' => 'users.store','method'=>'POST','novalidate']) !!}
							<div class="row">
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Name') }}:</strong>
							            {!! Form::text('name', null, ['placeholder' => _i('Name'),'class' => 'form-control' . $name_err]) !!}
							            <span class="text-danger">{{ $errors->first('name') }}</span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Email') }}</strong>
							            {!! Form::text('email', null, ['placeholder' => _i('Email'),'class' => 'form-control' . $mail_err]) !!}
							            <span class="text-danger">{{ $errors->first('email') }}</span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('New password') }}</strong>
							            {!! Form::password('password', ['placeholder' => _i('New password'),'class' => 'form-control' . $password_err]) !!}
							            <span class="text-danger">{{ $errors->first('password') }}</span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Confirm Password') }}</strong>
							            {!! Form::password('confirm-password', ['placeholder' => _i('Confirm Password'),'class' => 'form-control' . $confirm_password_err]) !!}
							            <span class="text-danger">{{ $errors->first('confirm-password') }}</span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Role') }}</strong>
							            {!! Form::select('roles[]', $roles,[], ['class' => 'form-control select2' . $roles_err,'multiple']) !!}
							            <span class="text-danger">{{ $errors->first('roles') }}</span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
							    	{!! Form::submit(_i('Submit'), ['class' => 'btn btn-primary']) !!}
							    </div>
							</div>
						{!! Form::close() !!}
					</div>
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