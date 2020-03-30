@extends('layouts.app')

@section('title', '演題提出者管理')
@section('description', 'The SIS management')
@section('keyword', 'management')

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">演題提出者管理</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			演題提出者管理
			<span class="float-right">
				<a class="btn btn-sm btn-primary" href="{{ route('users.create') }}"> Create New User</a>
			</span>
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
					   <th>Email</th>
					   <th>Roles</th>
					   <th width="280px">Action</th>
					 </tr>
					 @foreach ($data as $key => $user)
					  <tr>
					    <td>{{ ++$i }}</td>
					    <td>{{ $user->name }}</td>
					    <td>{{ $user->email }}</td>
					    <td>
					      @if(!empty($user->getRoleNames()))
					        @foreach($user->getRoleNames() as $v)
					           <label class="badge badge-success">{{ $v }}</label>
					        @endforeach
					      @endif
					    </td>
					    <td>
					       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
					       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
					        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
					            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					        {!! Form::close() !!}
					    </td>
					  </tr>
					 @endforeach
				</table>


					{!! $data->render() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection