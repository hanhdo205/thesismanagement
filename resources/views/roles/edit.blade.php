@extends('layouts.app')

@section('title', _i('Edit Role'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ _i('Role Management') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Edit Role') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Edit Role') }}
			<span class="float-right">
				<a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ _i('Back') }}</a>
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
				{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Name') }}:</strong>
					            {!! Form::text('name', null, array('placeholder' => _i('Name'),'class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Permission') }}:</strong>
					            <br/>
					            @foreach($permission as $value)
					                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
					                {{ $value->name }}</label>
					            <br/>
					            @endforeach
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
					        <button type="submit" class="btn btn-primary">{{ _i('Submit') }}</button>
					    </div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection