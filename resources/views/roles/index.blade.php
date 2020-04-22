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
						<thead  align="center">
					  <tr>
					     <th>{{ _i('No.') }}</th>
					     <th>{{ _i('Name') }}</th>
					     <th>{{ _i('Action') }}</th>
					  </tr>
					  </thead>
						<tbody>
					    @foreach ($roles as $key => $role)
					    <tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ _i($role->name) }}</td>
					        <td nowrap>
					            <a class="btn btn-sm btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
					            @can('role-edit')
					                <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					            @endcan
					            @can('role-delete')
					                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'id' => 'formDelete_'.$role->id,'style'=>'display:inline']) !!}
					                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['class' => 'btnDel btn-sm btn btn-danger','data-toggle' => 'modal','data-target' => '#confirm']) !!}
					                {!! Form::close() !!}
					            @endcan
					        </td>
					    </tr>
					    @endforeach
					    </tbody>
					</table>
					{!! $roles->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection

@push('foot')
<!-- Delete confirm-->
@include('includes.footer')
<!-- End Delete confirm -->
@endpush