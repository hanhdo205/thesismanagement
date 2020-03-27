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
		<div class="card-header">
			直近の演題提出状況
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">No.</th>
								<th>タイトル</th>
								<th>氏名</th>
								<th>提出日</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data['abstract'] as $abstract)
							@php
								$date = date_create($abstract['date']);
								$abs_date = date_format($date,"Y年m月d日");
							@endphp
							<tr>
								<td class="fix-width">{{ $abstract['id'] }}</td>
								<td>{{ $abstract['title'] }}</td>
								<td>{{ $abstract['name'] }}</td>
								<td>{{ $abs_date }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			直近の査読提出状況
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">No.</th>
								<th>タイトル</th>
								<th>氏名</th>
								<th>提出日</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data['review'] as $review)
							@php
								$rv_date = date_create($review['date']);
								$review_date = date_format($rv_date,"Y年m月d日");
							@endphp
							<tr>
								<td class="fix-width">{{ $review['id'] }}</td>
								<td>{{ $review['title'] }}</td>
								<td>{{ $review['name'] }}</td>
								<td>{{ $review_date }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	 
</div>
<!-- /. PAGE INNER  -->
@endsection