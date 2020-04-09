@extends('layouts.app')

@section('title', _i('演題管理'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Datatable -->
<link  href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link  href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

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
				{!! Form::open(array('id' => 'reviewRequest','route' => 'review.request','method'=>'POST')) !!}
				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('topic', $topics,$last_topic_id, array('id' => 'topic_select','class' => 'field form-control','placeholder' => _i('Please select topic'))) !!}
					</div>
				</div>
				<div class="form-group">
					<label>演題提出URL： <a href="{{ route('topic.endai_teisyutu', ['id' => $last_topic_id]) }}" id="topic_url">{{ route('topic.endai_teisyutu', ['id' => $last_topic_id]) }}</a></label>
				</div>
				<div class="form-group">
					<div class="form-inline custom-inline">
						<div class="alert alert-secondary" role="alert">
							<div class="form-inline">
								<input type="text" name="fullname" class="form-control mt-1 mb-1 mr-sm-2" id="fullname" placeholder="氏名">
								<select name="review_result" class="form-control mb-1 mt-1 mr-sm-2" id="review_result">
									<option>査読結果</option>
									<option value="ok">OK</option>
								</select>
								<button type="submit" class="form-control btn btn-primary pl-5 pr-5 mt-1 mb-1">検索</button>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('select', ['mail'=>'Review request','csv'=>'CSV Download'],null, array('id' => 'requestSelect','class' => 'form-control mr-sm-2','placeholder' => _i('Please select...'))) !!}
						{!! Form::button(_i('Send'), array('id' => 'selectBtn','class' => 'form-control btn btn-primary pl-5 pr-5')) !!}
					</div>
				</div>
				<div class="table-scroll">
					<table class="table table-striped table-bordered data-table table-hover table-with-checkbox" cellspacing="0" width="100%">
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
					</table>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection

@push('foot')
<!-- Datatable -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<!-- Custom script -->
<script type="text/javascript">
	var ajax_url = {table:'{{ url('essay-ajax') }}',csv:'{{ url('essay-csv') }}',review_request:'{{ url('review-request') }}'};
	var last_topic_id = '{{ $last_topic_id }}';
</script>
<script src="{{ asset('js/essays-index.js') }}"></script>
@endpush