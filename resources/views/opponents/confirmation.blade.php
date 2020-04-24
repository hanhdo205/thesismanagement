@extends('layouts.app')

@section('title', _i('Review request mail template'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@push('head')
<!-- Select2 styles-->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Review request mail template') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					{{ _i('Review request mail template') }}
				</div>
				<div class="card-body">
				{!! Form::open(['route' => 'opponents.sendmail','method'=>'POST','id'=>'sendMail']) !!}
				{!! Form::hidden('topic_id', $topic) !!}
						<div class="form-group required">
							<label for="mailcontent" class="control-label">{{ _i('Mail content')}}</label>
							{!! Form::textarea('mailbody', '{Name}先生

いつも大変お世話になっております。
第3回学術大会の査読依頼をさせていただければと思います。
以下のリンクより、査読対応、可否をご回答くださいませ。

{Link}', ['id' => 'mailcontent','class' => 'form-control','rows' => '10']) !!}
<span class="invalid-feedback">{{ _i('This is a required field') }}</span>

						</div>
						<div class="form-group required">
							<label for="destination" class="control-label">{{ _i('Receiver')}}</label>
							{!! Form::select('opponents[]', $opponents, $checkboxs, ['id' => 'destination','class' => 'form-control select2','multiple']) !!}
							<span class="invalid-feedback">{{ _i('This is a required field') }}</span>
						</div>
						<div class="d-flex justify-content-end">
							<span class="spinner-border mr-3" role="status" aria-hidden="true"></span>
							{!! Form::button(_i('Send confirmation'), ['id' => 'submitBtn','class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-3 col-xl-4']) !!}
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
<script type="text/javascript">
	var translate = {
		no_destination:'{{ _i("No item selected") }}',
		no_content:'{{ _i("Email content can not be blank") }}',
	};
</script>
<script src="{{ asset('js/opponents-confirmation.js') }}"></script>
<!-- Select2 script -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endpush