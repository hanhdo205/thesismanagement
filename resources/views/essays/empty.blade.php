@extends('layouts.app')

@section('title', _i('Essays management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

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
				{{ _i('There is no data.') }}
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection