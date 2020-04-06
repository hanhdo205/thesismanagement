@extends('layouts.app')

@section('title', _i('演題管理'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@php
	echo '<textarea>'.$essays.'</textarea>';
@endphp

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">演題管理</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			演題管理
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('topic', $topics,$last_topic_id, array('id' => 'topic_select','class' => 'field form-control','placeholder' => _i('Please select topic'))) !!}
					</div>
				</div>
				<div class="form-group">
					<label>演題提出URL： <a href="{{ url('/endai_teisyutu/' . $last_topic_id) }}">{{ url('/endai_teisyutu/' . $last_topic_id) }}</a></label>
				</div>
				<div class="form-group">
					<div class="form-inline custom-inline">
						<div class="alert alert-secondary" role="alert">
							<form class="form-inline">
								<input type="text" name="fullname" class="form-control mt-1 mb-1 mr-sm-2" id="fullname" placeholder="氏名">
								<select name="review_result" class="form-control mb-1 mt-1 mr-sm-2" id="review_result">
									<option>査読結果</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
								<button type="submit" class="form-control btn btn-primary pl-5 pr-5 mt-1 mb-1">検索</button>
							</form>
						</div>
					</div>
				</div>
				<div class="form-group">
					<form action="/review/request" class="form-inline" method="POST">
						@csrf <!-- {{ csrf_field() }} -->
						<select name="select" class="form-control mr-sm-2" id="select">
							<option>選択してください</option>
							<option>査読依頼</option>
							<option>CSVダウンロード</option>
						</select>
						<button type="submit" class="form-control btn btn-primary pl-5 pr-5">検索</button>
					</form>
				</div>
				<div class="table-scroll">
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
								<th>タイトル</th>
								<th>氏名</th>
								<th>ステータス</th>
								<th>査読結果</th>
								<th>提出日</th>
							</tr>
						</thead>
						<tbody>
						@foreach($essays as $essay)
							@php
								$date = date_create($essay->created_at);
								$abs_date = date_format($date,"Y年m月d日");
							@endphp
							<tr>
								<td class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="{{ $essay->id }}" />
										<span class="checkmark"></span>
									</label>
								</td>
								<td class="fix-width">{{ ++$i }}</td>
								<td>{{ $essay->essay_title }}</td>
								<td>{{ $essay->student_name }}</td>
								<td>{{ $essay->review_status }}</td>
								<td>{{ $essay->review_result }}</td>
								<td>{{ $abs_date }}</td>
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
 <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/grocery/post') }}",
                  method: 'post',
                  data: {
                     name: jQuery('#name').val(),
                     type: jQuery('#type').val(),
                     price: jQuery('#price').val()
                  },
                  success: function(result){
                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success);
                  }});
               });
            });
      </script>
@endsection