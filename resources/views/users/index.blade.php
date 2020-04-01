@extends('layouts.app')

@section('title', _i('User management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('User management') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('User management') }}
			<span class="float-right">
				<a class="btn btn-sm btn-primary" href="{{ route('users.create') }}"> {{ _i('Create New User') }}</a>
			</span>
		</div>
		<div class="card-body">
			<div class="card-text">
				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
					  	{{ $message }}
					</div>
				@endif
				<table class="table table-bordered">
					 <tr>
					   <th>{{ _i('No.') }}</th>
					   <th>{{ _i('Name') }}</th>
					   <th>{{ _i('Email') }}</th>
					   <th>{{ _i('Roles') }}</th>
					   <th width="280px">{{ _i('Action') }}</th>
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
					       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">{{ _i('Show') }}</a>
					       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">{{ _i('Edit') }}</a>
					        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
					            {!! Form::submit(_i('Delete'), ['class' => 'btn btn-danger']) !!}
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