@extends('layouts.app')

@section('title', '学術管理')
@section('description', 'The SIS management')
@section('keyword', 'management')

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">学術管理</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			学術管理
			@can('conference-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="{{ route('conferences.create') }}"> 新規作成</a>
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
								<th class="fix-width">No.</th>
								<th>タイトル</th>
								<th>応募期間</th>
								<th>ステータス</th>
							</tr>
						</thead>
						<tbody>
					    	@foreach ($conferences as $conference)
					    	<tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ $product->title }}</td>
					        <td>{{ $product->period }}</td>
					        <td>{{ $product->status }}</td>
					        <td>
				                <form action="{{ route('conference.destroy',$conference->id) }}" method="POST">
				                    <a class="btn btn-info" href="{{ route('conference.show',$conference->id) }}">Show</a>
				                    @can('conference-edit')
				                    <a class="btn btn-primary" href="{{ route('conference.edit',$conference->id) }}">Edit</a>
				                    @endcan


				                    @csrf
				                    @method('DELETE')
				                    @can('conference-delete')
				                    <button type="submit" class="btn btn-danger">Delete</button>
				                    @endcan
				                </form>
					        </td>
					    </tr>
					    @endforeach
				    	</tbody>
			    	</table>
			    </div>
				{!! $conferences->links() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection