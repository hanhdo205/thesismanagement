@extends('layouts.app')

@section('title', _i('Create New Topic'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Datepicker styles-->
<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
@endpush

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Create New Topic') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Create New Topic') }}
		</div>
		<div class="card-body">
			<div class="card-text">
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <strong>Whoops!</strong> There were some problems with your input.<br><br>
				        <ul>
				        @foreach ($errors->all() as $error)
				            <li>{{ $error }}</li>
				        @endforeach
				        </ul>
				    </div>
				@endif
				{!! Form::open(array('route' => 'topics.store','method'=>'POST')) !!}
					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Title') }}:</strong>
					            {!! Form::text('title', null, array('placeholder' => _i('Title'),'class' => 'form-control')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _i('Start date') }}:</strong>
					            {!! Form::text('start_date', null, array('placeholder' => _i('Start date'),'id' => 'startDate','class' => 'form-control','autocomplete' => 'off')) !!}
					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>{{ _I('End date') }}:</strong>
					            {!! Form::text('end_date', null, array('placeholder' => _i('End date'),'id' => 'endDate', 'class' => 'form-control','autocomplete' => 'off')) !!}
					        </div>
					    </div>

					    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
					    	{!! Form::submit(_i('Submit'), array('class' => 'btn btn-primary')) !!}
					    </div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection

@push('foot')
<!-- Datepicker script -->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/datepicker-ja.js') }}"></script>
<!-- Custom script -->
<script src="{{ asset('js/datepicker-custom.js') }}"></script>
@endpush