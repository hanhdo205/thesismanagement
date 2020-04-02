@extends('layouts.app')

@section('title', _i('Edit User'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ _i('User management') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Edit User') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Edit User') }}
			<span class="float-right">
				<a class="btn btn-sm btn-primary" href="{{ route('users.index') }}"> {{ _i('Back') }}</a>
			</span>
		</div>
		<div class="card-body">
			<div class="card-text">
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
				{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Name') }}:</strong>
					            {!! Form::text('name', null, array('placeholder' => _i('Name'),'class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Email') }}:</strong>
					            {!! Form::text('email', null, array('placeholder' => _i('Email'),'class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Password') }}:</strong>
					            {!! Form::password('password', array('placeholder' => _i('Password'),'class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Confirm Password') }}:</strong>
					            {!! Form::password('confirm-password', array('placeholder' => _i('Confirm Password'),'class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Role') }}:</strong>
					            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control select2','multiple')) !!}
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
<!-- /. PAGE INNER  -->
@endsection