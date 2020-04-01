@extends('layouts.app')

@section('title', _('Show Role'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li
		<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ _i('Role Management') }}</a></li>		<li class="breadcrumb-item active" aria-current="page">{{ _i('Show Role') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Show Role') }}
			@can('role-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="{{ route('roles.index') }}"> {{ _i('Back') }}</a>
				</span>
            @endcan
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Name') }}:</strong>
				            {{ $role->name }}
				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Permission') }}:</strong>
				            @if(!empty($rolePermissions))
				                @foreach($rolePermissions as $v)
				                    <label class="label label-success">{{ $v->name }},</label>
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