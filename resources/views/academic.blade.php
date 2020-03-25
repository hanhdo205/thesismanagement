@extends('layouts.app')

@section('title', '学術管理')
@section('description', 'The SIS management')
@section('keyword', 'management')

@php
	$data = Config::get('sampledata.data');
@endphp

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">学術管理</li>
  </ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">学術管理<span class="badge badge-primary float-right">新規作成</span></h5>
			<div class="card-text">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>タイトル</th>
							<th>応募期間</th>
							<th>ステータス</th>
						</tr>
					</thead>
					<tbody>
					@foreach($data['academic'] as $academic)
						<tr>
							<td>{{ $academic['id'] }}</td>
							<td>{{ $academic['title'] }}</td>
							<td>{{ $academic['period'] }}</td>
							<td>{{ $academic['status'] }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection