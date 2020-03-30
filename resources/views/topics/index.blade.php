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
			@can('topic-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="{{ route('topics.create') }}"> 新規作成</a>
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
					    	@foreach ($topics as $topic)
					    	<tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ $topic->title }}</td>
					        <td>{{ $topic->period }}</td>
					        <td>{{ $topic->status }}</td>
					        <td>
				                <form action="{{ route('topics.destroy',$topic->id) }}" method="POST">
				                    <a class="btn btn-info" href="{{ route('topics.show',$topic->id) }}">Show</a>
				                    @can('topic-edit')
				                    <a class="btn btn-primary" href="{{ route('topics.edit',$topic->id) }}">Edit</a>
				                    @endcan


				                    @csrf
				                    @method('DELETE')
				                    @can('topic-delete')
				                    <button type="submit" class="btn btn-danger">Delete</button>
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