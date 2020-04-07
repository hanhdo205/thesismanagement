@extends('layouts.app')

@section('title', _i('Show User'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ _i('User management') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Show User') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Show User') }}
			@can('role-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="{{ route('users.index') }}"> {{ _i('Back') }}</a>
				</span>
            @endcan
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Name') }}:</strong>
				            {{ $user->name }}
				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Email') }}:</strong>
				            {{ $user->email }}
				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Roles') }}:</strong>
				            @if(!empty($user->getRoleNames()))
				                @foreach($user->getRoleNames() as $v)
				                    <label class="badge badge-success">{{ _i($v) }}</label>
				                @endforeach
				            @endif
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection