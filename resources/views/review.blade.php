@extends('layouts.app')

@section('title', '査読者管理')
@section('description', 'The SIS management')
@section('keyword', 'management')

@php
	$data = Config::get('sampledata.data');
@endphp

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">査読者管理</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			査読者管理
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="form-group">
					<div class="form-inline">
						<select name="target_academic" class="form-control" id="target_academic">
							<option>対象学術大会を選択してください</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="form-inline">
						<button class="form-control btn btn-primary mr-sm-2 pl-5 pr-5">CSV一括取り込み</button>
						<button class="form-control btn btn-primary pl-5 pr-5">新規追加</button>
					</div>
				</div>
				<div class="table-scroll mb-5">
					<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="selectAll" />
										<span class="checkmark"></span>
									</label>
								</th>
								<th class="fix-width">No.</th>
								<th>氏名</th>
								<th>依頼状況</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data['review'] as $review)
							<tr>
								<td class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="{{ $review['id'] }}" />
										<span class="checkmark"></span>
									</label>
								</td>
								<td class="fix-width">{{ $review['id'] }}</td>
								<td>{{ $review['name'] }}</td>
								<td>{{ $review['status'] }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				<div class="form-group">
					<form action="/review/confirmation" class="d-flex justify-content-center" method="POST">
					@csrf <!-- {{ csrf_field() }} -->
					<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-3 pl-5 pr-5">査読対応確認</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection