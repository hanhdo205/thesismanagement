@extends('layouts.guess')

@section('title', _i('Request reply'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ _i('Confirmation to become a member of the thesis') }}</div>

                <div class="card-body">
                    <div class="card-text">
                    	@php
					   		$yes = true;
					   		$no = false;
					   @endphp
                    	@if ($message = Session::get('success'))
							<div class="alert alert-success" role="alert">
							   {{ $message[0] }}
							   @php
							   		$yes = ($message[1] == 'u_yes') ? true : false;
							   		$no = ($message[1] == 'u_no') ? true : false;
							   @endphp
							</div>
						@endif
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
						<div class="row">
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Title') }}</strong>
						            {{ $rows->title }}
						        </div>
						    </div>
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Period') }}</strong>
						            {{ $rows->start_date . ' ~ ' . $rows->end_date }}
						        </div>
						    </div>
						</div>
						{!! Form::open(array('route' => 'request.reply','method'=>'POST')) !!}
						{!! Form::hidden('review_token', $review_token) !!}
							<div class="row">
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong>{{ _i('Can you join to become a member of the thesis?') }}</strong>
							            <div class="form-group mt-3">
								            {!! Form::radio('request_status', 'u_yes' , $yes,  array('id'=>'yes')) !!}
											{!! Form::label('yes', _i('Yes')) !!}
								            {!! Form::radio('request_status', 'u_no' , $no,  array('id'=>'no')) !!}
	  										{!! Form::label('no', _i('No')) !!}
								        </div>
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
    </div>
</div>
@endsection