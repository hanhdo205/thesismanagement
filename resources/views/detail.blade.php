@extends('layouts.guess')

@section('title',  $topic->title  )
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $topic->title }}</div>

                <div class="card-body">
                    <div class="card-text">
						<div class="row">
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Title') }}</strong>
						            {{ $topic->title }}
						        </div>
						    </div>
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong>{{ _i('Period') }}</strong>
						            {{ $topic->start_date . ' ~ ' . $topic->end_date }}
						        </div>
						    </div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection