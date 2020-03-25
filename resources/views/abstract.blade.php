@extends('layouts.app')

@section('title', '演題管理')
@section('description', 'The SIS management')
@section('keyword', 'management')

@php
	$data = Config::get('sampledata.data');
@endphp

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">演題管理
</li>
  </ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">演題管理</h5>
			<div class="card-text">
					<div class="form-group">
						<select name="target_academic" class="form-control col-6" id="target_academic">
							<option>対象学術大会を選択してください</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group">
					<label>演題提出URL： https://example.com/endai_teisyutu/02</label>
					</div>
					<div class="col-md-10 alert alert-dark" role="alert">
						<form class="form-inline">
							<input type="text" name="fullname" class="form-control mb-2 mr-sm-2" id="fullname" placeholder="氏名">
							<select name="review_result" class="form-control mb-2 mr-sm-2" id="review_result">
								<option>査読結果</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
							<button type="submit" class="btn btn-primary mb-2">検索</button>
						</form>
					</div>
					<form action="/review/request" class="form-inline" method="POST">
						@csrf <!-- {{ csrf_field() }} -->
						<select name="select" class="form-control mb-3 mr-sm-2" id="select">
							<option>選択してください</option>
							<option>査読依頼</option>
							<option>CSVダウンロード</option>
						</select>
						<button type="submit" class="btn btn-primary mb-3">検索</button>
					</form>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th><input type="checkbox" id="selectAll" /></th>
							<th>No</th>
							<th>タイトル</th>
							<th>氏名</th>
							<th>ステータス</th>
							<th>査読結果</th>
							<th>提出日</th>
						</tr>
					</thead>
					<tbody>
					@foreach($data['abstract'] as $abstract)
						<tr>
							<td><input type="checkbox" id="{{ $abstract['id'] }}"/></td>
							<td>{{ $abstract['id'] }}</td>
							<td>{{ $abstract['title'] }}</td>
							<td>{{ $abstract['name'] }}</td>
							<td>{{ $abstract['status'] }}</td>
							<td>{{ $abstract['review'] }}</td>
							<td>{{ $abstract['date'] }}</td>
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