@extends('layouts.app')

@section('title', 'Role Management')
@section('description', 'The SIS management')
@section('keyword', 'management')

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Role Management</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			Role Management
			@can('role-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="{{ route('roles.create') }}"> Create New Role</a>
				</span>
            @endcan
		</div>
		<div class="card-body">
			<div class="card-text">
				@if ($message = Session::get('success'))
				    <div class="alert alert-success">
				        <p>{{ $message }}</p>
				    </div>
				@endif
				<table class="table table-bordered">
				  <tr>
				     <th>No</th>
				     <th>Name</th>
				     <th width="280px">Action</th>
				  </tr>
				    @foreach ($roles as $key => $role)
				    <tr>
				        <td>{{ ++$i }}</td>
				        <td>{{ $role->name }}</td>
				        <td>
				            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
				            @can('role-edit')
				                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
				            @endcan
				            @can('role-delete')
				                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
				                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
				                {!! Form::close() !!}
				            @endcan
				        </td>
				    </tr>
				    @endforeach
				</table>
				{!! $roles->render() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection