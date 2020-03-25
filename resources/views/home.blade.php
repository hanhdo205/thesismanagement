@extends('layouts.app')

@section('title', 'TOPページ')
@section('description', 'The SIS management')
@section('keyword', 'management')

@php
	$data = Config::get('sampledata.data');
@endphp

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>
<div id="page-inner">
	<div class="card mb-3">
		<div class="card-body">
			<h5 class="card-title">直近の演題提出状況</h5>
			<div class="card-text">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>タイトル</th>
							<th>氏名</th>
							<th>提出日</th>
						</tr>
					</thead>
					<tbody>
					@foreach($data['abstract'] as $abstract)
						<tr>
							<td>{{ $abstract['id'] }}</td>
							<td>{{ $abstract['title'] }}</td>
							<td>{{ $abstract['name'] }}</td>
							<td>{{ $abstract['date'] }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">直近の査読提出状況</h5>
			<div class="card-text">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>タイトル</th>
							<th>氏名</th>
							<th>提出日</th>
						</tr>
					</thead>
					<tbody>
					@foreach($data['review'] as $review)
						<tr>
							<td>{{ $review['id'] }}</td>
							<td>{{ $review['title'] }}</td>
							<td>{{ $review['name'] }}</td>
							<td>{{ $review['date'] }}</td>
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