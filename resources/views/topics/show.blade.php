@extends('layouts.app')

@section('title',  $topic->title  )
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('topics.index') }}">{{ _i('Topic management') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $topic->title }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ $topic->title }}
		</div>
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
<!-- /. PAGE INNER  -->
@endsection