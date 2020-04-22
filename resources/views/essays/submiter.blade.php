@extends('layouts.app')

@section('title', _i('Student list'))
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
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Student list') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Student list') }}
		</div>
		<div class="card-body">
			<div class="card-text">
				@if ($message = Session::get('success'))
					<script>
						toastr.success('{{ $message }}');
					</script>
				@endif

				<div class="table-scroll">
					<table class="table table-striped table-bordered data-table table-hover" cellspacing="0" width="100%">
						<thead align="center">
							<tr>
								<th class="fix-width">No.</th>
								<th>{{ _i('Student name') }}</th>
								<th>{{ _i('Email') }}</th>
								<th>{{ _i('Gender') }}</th>
								<th>{{ _i('Date of birth') }}</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
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
<script type="text/javascript">
	var essays = {submiter:'{{ route("essays.submiter") }}'};
</script><script src="{{ asset('js/essays-submiter.js') }}"></script>
<!-- Select2 script -->
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
@endpush