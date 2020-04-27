@extends('layouts.app')

@section('title', _i('Topic management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Datatable -->
<link  href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link  href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Datepicker styles-->
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
<!-- Select2 styles-->
<link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Topic management') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Topic management') }}
			@can('topic-create')
				<span class="float-right">
					<a class="btn btn-sm btn-primary" id="createNewTopic" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i>  {{ _i('Add new topic') }}</a>
				</span>
            @endcan
		</div>
		<div class="card-body">
			<div class="card-text">
				<!-- @if ($message = Session::get('success'))
				    <script>
						toastr.success('{{ $message }}');
					</script>
				@endif -->
				<div class="table-scroll">
					<table class="table table-striped table-bordered data-table table-hover table-with-checkbox" cellspacing="0" width="100%">
						<thead  align="center">
							<tr>
								<th class="fix-width">{{ _i('No.') }}</th>
								<th>{{ _i('Title') }}</th>
								<th>{{ _i('Period') }}</th>
								<th>{{ _i('Status') }}</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
				    	</tbody>
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
<!-- Custom script -->
<script type="text/javascript">
	var topics = {index:'{{ route("topics.index") }}',store:'{{ route("topics.store") }}'};
	var translate = {
		save_changes:'{{ _i("Save Changes") }}',
		are_you_sure:'{{ _i("Are you sure want to delete ?") }}',
		sending:'{{ _i("Sending..") }}',
		edit_topic:'{{ _i("Edit Topic") }}',
		new_topic:'{{ _i("Create New Topic") }}',
		save_btn:'{{ _i("Create Topic") }}',
		update_btn:'{{ _i("Update Topic") }}',
	};
</script>
<!-- Custom script -->
<script src="{{ asset('js/datepicker-custom.js') }}"></script>
<script src="{{ asset('js/topics-index.js') }}"></script>

<!-- Datepicker script -->
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/datepicker-ja.js') }}"></script>


<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {!! Form::open(['id' => 'topicForm','name' => 'topicForm', 'class' => 'form-horizontal','novalidate']) !!}
            <div class="modal-body">

                {!! Form::hidden('topic_id', null, ['id' => 'topic_id']) !!}
					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group required">
					            <label class='control-label'><strong>{{ _i('Title') }}</strong></label>
					            {!! Form::text('title', null, ['id' => 'title','class' => 'form-control title','placeholder' => _i('Title')]) !!}
					            <span class="invalid-feedback">{{ _i('This is a required field') }}</span>
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group required">
					            <label class='control-label'><strong>{{ _i('Start date') }}</strong></label>
					            {!! Form::text('start_date', null, ['placeholder' => _i('Start date'),'id' => 'startDate','class' => 'form-control start_date','autocomplete' => 'off']) !!}
					            <span class="invalid-feedback">{{ _i('This is a required field') }}</span>
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group required">
					            <label class='control-label'><strong>{{ _I('End date') }}</strong></label>
					            {!! Form::text('end_date', null, ['placeholder' => _i('End date'),'id' => 'endDate', 'class' => 'form-control end_date','autocomplete' => 'off']) !!}
					            <span class="invalid-feedback">{{ _i('This is a required field') }}</span>
					        </div>
					    </div>


					</div>

            </div>
            <div class="modal-footer">
            	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
			    	{!! Form::submit(_i('Submit'), ['id' => 'saveBtn','class' => 'btn btn-primary pr-5 pl-5', 'value' => 'create']) !!}
			    </div>
		    </div>
		    {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="showDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Title') }}: </strong>
				            <span id="detailTitle"></span>
				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Period') }}: </strong>
				            <span id="detailStartDate"></span> ～ <span id="detailEndDate"></span>
				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>{{ _i('Registration form for essay writing competetion URL') }}: </strong>
				            <a id="detailUrl" href="" target="_blank"></a>
				        </div>
				    </div>
				</div>
            </div>
        </div>
    </div>
</div>
<!-- Delete confirm-->
@include('includes.footer')
<!-- End Delete confirm -->
<!-- Select2 script -->
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
@endpush