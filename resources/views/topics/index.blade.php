@extends('layouts.app')

@section('title', _i('Topic management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Topic management') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Topic management') }}
			@can('topic-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="{{ route('topics.create') }}"> {{ _i('Add new topic') }}</a>
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
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">{{ _i('No.') }}</th>
								<th>{{ _i('Title') }}</th>
								<th>{{ _i('Period') }}</th>
								<th>{{ _i('Status') }}</th>
								<th>{{ _i('Action') }}</th>
							</tr>
						</thead>
						<tbody>
					    	@foreach ($topics as $topic)
					    	@php
					    		$period = $topic->start_date . ' ~ ' . $topic->end_date;
				    		@endphp
					    	<tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ $topic->title }}</td>
					        <td>{{ $period }}</td>
					        <td>{{ $topic->status }}</td>
					        <td>
				                <form action="{{ route('topics.destroy',$topic->id) }}" method="POST">
				                    <a class="btn btn-info" href="{{ route('topics.show',$topic->id) }}">{{ _i('Show') }}</a>
				                    @can('topic-edit')
				                    <a class="btn btn-primary" href="{{ route('topics.edit',$topic->id) }}">{{ _i('Edit') }}</a>
				                    @endcan


				                    @csrf
				                    @method('DELETE')
				                    @can('topic-delete')
				                    <button type="submit" class="btn btn-danger">{{ _i('Delete') }}</button>
				                    @endcan
				                </form>
					        </td>
					    </tr>
					    @endforeach
				    	</tbody>
			    	</table>
			    </div>
				{!! $topics->links() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection