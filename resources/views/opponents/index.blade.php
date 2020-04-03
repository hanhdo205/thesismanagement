@extends('layouts.app')

@section('title', _i('Opponent management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Opponent management') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Opponent management') }}
		</div>
		<div class="card-body">
			<div class="card-text">
				{!! Form::open(array('route' => 'opponents.confirmation','method'=>'POST', 'class' => 'opponent_management')) !!}
				<div class="form-group">
					<div class="form-inline">
						{!! Form::select('topic', $topics,[], array('id' => 'topic_select','class' => 'field form-control','placeholder' => _i('Please select topic'))) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="form-inline">
						<a class="form-control btn btn-primary mr-sm-2 pl-5 pr-5" href="javascript:void(0);"data-toggle="modal" data-target="#importUsers">{{ _i('Import from CSV') }}</a>
						<a class="form-control btn btn-primary pl-5 pr-5" href="{{ route('users.create') }}">新規追加</a>
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
								<th class="fix-width">{{ _i('No.') }}</th>
								<th>{{ _i('Name') }}</th>
								<th>{{ _i('Status') }}</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($data as $key => $user)
							<tr>
								<td class="fix-width text-center">
									<label class="custom-check">
										{!! Form::checkbox('opponents[]', $user->id, false, array('id' => ++$i, 'class' => 'field')) !!}
										<span class="checkmark"></span>
									</label>
								</td>
								<td class="fix-width">{{ $i }}</td>
								<td>{{ $user->name }}</td>
								<td></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					{!! $data->render() !!}
				</div>
				<div class="form-group">
					<div class="d-flex justify-content-center">
						{!! Form::submit(_i('Go to letter confirm'), array('id' => 'formSubmit','class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-3 pl-5 pr-5')) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="importUsers" tabindex="-1" role="dialog" aria-labelledby="importUsers" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importUsersTitle">{{ _i('Import from CSV') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      	</div>
      	<div class="modal-body">
        	{!! Form::open(array('id' => 'csv_upload_form','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                <span class="input-group div-select-csv-file">
                	{!! Form::text('csv_file_name_txt',null,array('class' => 'csv_file_name_txt input full upload form-control', 'placeholder' => _i('No file chosen'), 'autocomplete' => 'off')) !!}
					<span class="input-group-append">
						<label for="csv_upload_file" class="btn btn-primary">{{ _i('Choose file') }}</label></span>
					</span>
				</span>
				<small class="help-block"> {!! _i('※Data format .csv<br>※Maximum upload file size: 2MB') !!}</small>
				{!! Form::file('file', array('id' => 'csv_upload_file','class' => 'form-control', 'style' => 'visibility:hidden;height:0;padding:0;')) !!}
            {!! Form::close() !!}
      	</div>
      	<div class="modal-footer">
        <button type="button" id="csv_upload_cancel" class="btn btn-secondary" data-dismiss="modal">{{ _i('Cancel') }}</button>
        <button type="button" id="csv_upload_button" class="btn btn-primary">{{ _i('Import') }}</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- /. PAGE INNER  -->
@endsection