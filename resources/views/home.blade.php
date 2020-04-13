@extends('layouts.app')

@section('title', _i('Home page'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@php
	$data = Config::get('sampledata.data');
@endphp

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Home') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card mb-3">
		<div class="card-header">
			{{ _i('Lastest essays') }}
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">{{ _i('No.') }}</th>
								<th>{{ _i('Title') }}</th>
								<th>{{ _i('Student name') }}</th>
								<th>{{ _i('Registration date') }}</th>
							</tr>
						</thead>
						<tbody>
						@if(count($lastestEssays) == 0)
							<tr>
								<td colspan="4" align="center">{{ _i('There is no data.') }}</td>
							</tr>
						@else
							@foreach($lastestEssays as $essay)
								<tr>
									<td class="fix-width">{{ ++$i }}</td>
									<td>{{ $essay->essay_title }}</td>
									<td>{{ $essay->student_name }}</td>
									<td>{{ Carbon\Carbon::parse($essay->created_at)->format('Y年m月d日') }}</td>
								</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			{{ _i('Lastest reviews') }}
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">{{ _i('No.') }}</th>
								<th>{{ _i('Title') }}</th>
								<th>{{ _i('Student name') }}</th>
								<th>{{ _i('Registration date') }}</th>
							</tr>
						</thead>
						<tbody>
						@if(count($lastestReview) == 0)
							<tr>
								<td colspan="4" align="center">{{ _i('There is no data.') }}</td>
							</tr>
						@else
							@foreach($lastestReview as $review)
								<tr>
									<td class="fix-width">{{ ++$i }}</td>
									<td>{{ $review->essay_title }}</td>
									<td>{{ $review->student_name }}</td>
									<td>{{ Carbon\Carbon::parse($review->updated_at)->format('Y年m月d日') }}</td>
								</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection