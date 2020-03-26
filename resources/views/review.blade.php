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
					<select name="target_academic" class="form-control col-md-5" id="target_academic">
						<option>対象学術大会を選択してください</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<div class="row">
					<div class="form-inline col-md-6 d-flex flex-row-reverse">
						<button class="form-control btn btn-primary mb-3 p-2">新規追加</button>
						<button class="form-control btn btn-primary mb-3 mr-sm-2 p-2">CSV一括取り込み</button>
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
				<div class="container">
					<div class="row">
					
						<div class="col-sm"></div>
						<form action="/review/confirmation" class="col-sm" method="POST">
						@csrf <!-- {{ csrf_field() }} -->
						<button type="submit" class="btn btn-primary btn-lg btn-block ">査読対応確認</button>
						</form>
						<div class="col-sm"></div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection