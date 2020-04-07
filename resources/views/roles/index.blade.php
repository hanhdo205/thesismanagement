@extends('layouts.app')

@section('title', _i('Role Management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Role Management') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Role Management') }}
			@can('role-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="{{ route('roles.create') }}"> {{ _i('Create New Role') }}</a>
				</span>
            @endcan
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
					     <th>{{ _i('Action') }}</th>
					  </tr>
					    @foreach ($roles as $key => $role)
					    <tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ _i($role->name) }}</td>
					        <td nowrap>
					            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">{{ _i('Show') }}</a>
					            @can('role-edit')
					                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">{{ _i('Edit') }}</a>
					            @endcan
					            @can('role-delete')
					                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'id' => 'formDelete_'.$role->id,'style'=>'display:inline']) !!}
					                    {!! Form::button(_i('Delete'), ['class' => 'btnDel btn btn-danger','data-toggle' => 'modal','data-target' => '#confirm']) !!}
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
</div>
<!-- /. PAGE INNER  -->
@endsection