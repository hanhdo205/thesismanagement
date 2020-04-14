@extends('layouts.app')

@section('title', _i('Review request form'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Review request form') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					{{ _i('Review request form') }}

				</div>
				<div class="card-body">
					<div>以下の演題に対して査読依頼を実施しますか？</div>
					<div>問題ない場合は、査読依頼ボタンを押してください。</div>
					<div class="mb-3">査読依頼を先生へとメールで依頼します。</div>
							{!! Form::open(['route' => 'review.sendmail','method'=>'POST','id' => 'reviewSendMail', 'class' => 'review_send_mail']) !!}
							{!! Form::hidden('topic_id', $topic_id) !!}
							{!! Form::hidden('essays', $essay_lst) !!}
								<div class="form-group">
									{!! Form::textarea('mailbody', $textarea, ['id' => 'mailcontent','class' => 'form-control','rows' => '10']) !!}
								</div>
								<div class="d-flex justify-content-end">
									<span class="spinner-border mr-3" role="status" aria-hidden="true"></span>
									{!! Form::submit(_i('Send review request'), ['class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4']) !!}
								</div>
							{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection

@push('foot')
<script src="{{ asset('js/review-request.js') }}"></script>
@endpush