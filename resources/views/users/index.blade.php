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
					<script>
						toastr.success('{{ $message }}');
					</script>
				@endif
				<div class="table-scroll">
					<table class="table table-bordered">
						 <tr>
						   <th>{{ _i('No.') }}</th>
						   <th>{{ _i('Name') }}</th>
						   <th>{{ _i('Email') }}</th>
						   <th>{{ _i('Roles') }}</th>
						   <th>{{ _i('Action') }}</th>
						 </tr>
						 @foreach ($data as $key => $user)
						  <tr>
						    <td>{{ ++$i }}</td>
						    <td>{{ $user->name }}</td>
						    <td>{{ $user->email }}</td>
						    <td>
						      @if(!empty($user->getRoleNames()))
						        @foreach($user->getRoleNames() as $v)
						           <label class="badge badge-success">{{ _i($v) }}</label>
						        @endforeach
						      @endif
						    </td>
						    <td nowrap>
						       <a class="btn btn-sm btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'id' => 'formDelete_'.$user->id,'style'=>'display:inline']) !!}
						            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['id' => 'btn-delete','class' => 'btnDel btn-sm btn btn-danger','data-toggle' => 'modal','data-target' => '#confirm']) !!}
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
</div>
<!-- /. PAGE INNER  -->
@endsection