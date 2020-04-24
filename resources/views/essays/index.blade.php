@extends('layouts.app')

@section('title', _i('Essays management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Datatable -->
<link  href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link  href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Select2 styles-->
<link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Essays management') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Essays management') }}
		</div>
		<div class="card-body">
			<div class="card-text">
				@if ($message = Session::get('success'))
					<script>
						toastr.success('{{ $message }}');
					</script>
					@php
						$last_topic_id = Session::get('topic_id');
						$student_name = Session::get('student_name');
						$review_result = Session::get('review_result');
					@endphp
				@endif
				{!! Form::open(array('id' => 'reviewRequest','route' => 'review.request','method'=>'POST')) !!}
				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('topic', $topics,$last_topic_id, array('id' => 'topic_select','class' => 'field form-control select2','placeholder' => _i('Please select topic'))) !!}
					</div>
				</div>
				<div class="form-group">
					<label class="mb-0">{{ _i('Submit form URL') }}： <a href="{{ route('topic.endai_teisyutu', ['id' => $last_topic_id]) }}" id="topic_url">{{ route('topic.endai_teisyutu', ['id' => $last_topic_id]) }}</a></label>
				</div>
				<div class="form-group">
					<div class="form-inline custom-inline">
						<div class="alert alert-secondary" role="alert">
							<div class="form-inline">
								{!! Form::text('student_name', $student_name, ['id' => 'student_name','class' => 'form-control mt-1 mb-1 mr-sm-2','placeholder' => _i('Enter student name')]) !!}

								{!! Form::select('review_result', ['not_yet'=>_i('None'),'good'=>_i('Good'),'bad'=>_i('Not good')],$review_result, ['id' => 'review_result','class' => 'form-control mb-1 mt-1 mr-sm-2 select2','placeholder' => _i('Review result'),'data-minimum-results-for-search'=>'Infinity']) !!}

								{!! Form::button('<i class="fa fa-search" aria-hidden="true"></i> ' . _i('Search'), ['id' => 'searchBtn','class' => 'form-control btn btn-primary mt-1 mb-1 ml-sm-2']) !!}
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('select', ['mail'=>_i('Review request'),'csv'=>_i('CSV Download')],null, ['id' => 'requestSelect','class' => 'form-control mr-sm-2 mb-2 select2','placeholder' => _i('Please select'),'data-minimum-results-for-search'=>'Infinity']) !!}
						{!! Form::button('<i class="fa fa-ban" aria-hidden="true"></i> ' . _i('Do action'), ['id' => 'selectBtn','class' => 'form-control btn btn-primary pl-5 pr-5 mb-2 ml-sm-2 mt-2', 'data-toggle'=>'popover', 'data-content'=>_i('Please select...')]) !!}
					</div>
				</div>
				<span class="search_text"><div class="alert alert-secondary alert-dismissible search_text_alert d-none" role="alert"><button class="close reset_search" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></span>
				<div class="table-scroll">
					<table class="table table-striped table-bordered data-table table-hover table-with-checkbox" cellspacing="0" width="100%">
						<thead align="center">
							<tr>
								<th class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" class="selectAll" />
										<span class="checkmark"></span>
									</label>
								</th>
								<th class="fix-width">No.</th>
								<th>{{ _i('Title') }}</th>
								<th>{{ _i('Student name') }}</th>
								<th>{{ _i('Status') }}</th>
								<th>{{ _i('Review result') }}</th>
								<th>{{ _i('Submission date') }}</th>
							</tr>
						</thead>
						<tbody></tbody>
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
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- Select2 script -->
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<!-- Custom script -->
<script type="text/javascript">
	var essays = {index:'{{ route("essays.index") }}',export:'{{ route("essays.export") }}'};
	var last_topic_id = '{{ $last_topic_id }}';
	var search_text_both = '<div class="alert alert-secondary alert-dismissible search_text_alert" role="alert">{{ _i("Search result for %(search[0].name)s with student name is %(search[1].name)s or review result is %(search[2].name)s") }}<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ _i("Reset search") }}"><button class="close reset_search" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></span></div>';
	var search_text_name = '<div class="alert alert-secondary alert-dismissible search_text_alert" role="alert">{{ _i("Search result for %(search[0].name)s with student name is %(search[1].name)s") }}<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ _i("Reset search") }}"><button class="close reset_search" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></span></div>';
	var search_text_result = '<div class="alert alert-secondary alert-dismissible search_text_alert" role="alert">{{ _i("Search result for %(search[0].name)s with review result is %(search[2].name)s") }}<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ _i("Reset search") }}"><button class="close reset_search" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></span></div>';
	var translate = {
		review_result:'{{ _i("Review result") }}',
	};
</script>
<script src="{{ asset('js/essays-index.js') }}"></script>
<script src="{{ asset('js/sprintf.js') }}"></script>
@endpush