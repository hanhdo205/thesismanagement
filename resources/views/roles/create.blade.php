@extends('layouts.app')

@section('title', _i('Create New Role'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ _i('Role Management') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Create New Role') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Create New Role') }}
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
				{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Role name') }}:</strong>
					            {!! Form::text('name', null, array('placeholder' => _i('Role name'),'class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Permission') }}:</strong>
					            <br/>
					            @php
					            $new_permission = [];
					            @endphp
					            @foreach($permission as $value)
					            	@php
					            	$permission_arr = explode("-", $value->name);
					            	$group_permission = $permission_arr[0];
					            	$new_permission[$group_permission][] = ['id' => $value->id,'name'=>$value->name];
					            	@endphp
					            @endforeach
					            <div class="row">
						            @foreach($new_permission as $key => $group)
						            	<div class="col-md-3">
							            	<strong>{{ _i($key) }} </strong><br/>
							            	@foreach($group as $gr)
						            			<label>{{ Form::checkbox('permission[]', $gr['id'], false, array('class' => 'name')) }}
							                	{{ _i($gr['name']) }}</label>
							            		<br/>
							            	@endforeach
						            	</div>
						            @endforeach
					        	</div>
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