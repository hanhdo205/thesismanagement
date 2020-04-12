@extends('layouts.app')

@section('title', _i('Essays management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Datatable -->
<link  href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link  href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
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
				@endif
				{!! Form::open(array('id' => 'reviewRequest','route' => 'review.request','method'=>'POST')) !!}
				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('topic', $topics,$last_topic_id, array('id' => 'topic_select','class' => 'field form-control','placeholder' => _i('Please select topic'))) !!}
					</div>
				</div>
				<div class="form-group">
					<label>{{ _i('Submit form URL') }}： <a href="{{ route('topic.endai_teisyutu', ['id' => $last_topic_id]) }}" id="topic_url">{{ route('topic.endai_teisyutu', ['id' => $last_topic_id]) }}</a></label>
				</div>
				<div class="form-group">
					<div class="form-inline custom-inline">
						<div class="alert alert-secondary" role="alert">
							<div class="form-inline">
								{!! Form::text('student_name', null, array('id' => 'student_name','class' => 'form-control mt-1 mb-1 mr-sm-2','placeholder' => _i('Enter student name'))) !!}

								{!! Form::select('review_result', ['not_yet'=>_i('None'),'good'=>_i('Good'),'bad'=>_i('Not good')],null, array('id' => 'review_result','class' => 'form-control mb-1 mt-1 mr-sm-2','placeholder' => _i('Review result'))) !!}

								{!! Form::button(_i('Search'), array('id' => 'searchBtn','class' => 'form-control btn btn-primary pl-5 pr-5 mt-1 mb-1')) !!}
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('select', ['mail'=>_i('Review request'),'csv'=>_i('CSV Download')],null, array('id' => 'requestSelect','class' => 'form-control mr-sm-2','placeholder' => _i('Please select...'))) !!}
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
								<th>{{ _i('Title') }}</th>
								<th>{{ _i('Student name') }}</th>
								<th>{{ _i('Status') }}</th>
								<th>{{ _i('Review resuly') }}</th>
								<th>{{ _i('Date create') }}</th>
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
<!-- Custom script -->
<script type="text/javascript">
	var essays = {index:'{{ route("essays.index") }}',export:'{{ route("essays.export") }}'};
	var last_topic_id = '{{ $last_topic_id }}';
</script>
<script src="{{ asset('js/essays-index.js') }}"></script>
@endpush