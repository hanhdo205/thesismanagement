@extends('layouts.app')

@section('title', _i('Essay result detail'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Essay result detail') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					{{ _i('Essay result detail') }}
				</div>
				<div class="card-body">
					<!-- <form> -->
						<div class="form-group row">
							<label for="fullname" class="col-sm-3 col-form-label">{{ _i('Student name') }}</label>
							<div class="col-sm-9">
								<input type="fullname" class="form-control" id="fullname">
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_belong" class="col-sm-3 col-form-label">{{ _i('Belong to') }}</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="essay_belong">
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_major" class="col-sm-3 col-form-label">{{ _i('Major') }}</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="essay_major">
							</div>
						</div>
						<div class="form-group row mb-3">
							<label for="essay_title" class="col-sm-3 col-form-label">{{ _i('Title') }}</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="essay_title">
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-3 col-form-label">{{ _i('Status') }}</label>
							<div class="col-sm-9">
								<input type="status" class="form-control" id="status">
							</div>
						</div>
						<div class="form-group row">
							<label for="reviewer" class="col-sm-3 col-form-label">{{ _i('Reviewer') }}</label>
							<div class="col-sm-9">
								<input type="reviewer" class="form-control" id="reviewer">
							</div>
						</div>
						<div class="form-group row">
							<label for="result" class="col-sm-3 col-form-label">{{ _i('Review result') }}</label>
							<div class="col-sm-9">
								<div class="text-success">採択</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="file_download" class="col-sm-3 col-form-label">{{ _i('Link to download') }}</label>
							<div class="col-sm-9">
								<a href="#">ダウンロード</a>
							</div>
						</div>
						<div class="form-group">
							<label for="comment">{{ _i('Comments') }}</label>
							<textarea name="comment" class="form-control" id="comment" rows="3">ユニークな視点の研究でした。Good</textarea>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4">{{ _i('Save changes') }}</button>
						</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection