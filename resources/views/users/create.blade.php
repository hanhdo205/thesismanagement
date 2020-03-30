@extends('layouts.app')

@section('title', 'Create New User')
@section('description', 'The SIS management')
@section('keyword', 'management')

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('users.index') }}">演題提出者管理</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create New User</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			Create New User
			<span class="float-right">
				<a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
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
				{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Name:</strong>
					            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Email:</strong>
					            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Password:</strong>
					            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Confirm Password:</strong>
					            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Role:</strong>
					            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
					        <button type="submit" class="btn btn-primary">Submit</button>
					    </div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection