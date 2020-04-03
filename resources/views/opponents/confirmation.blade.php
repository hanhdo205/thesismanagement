@extends('layouts.app')

@section('title', '査読対応確認')
@section('description', 'The SIS management')
@section('keyword', 'management')

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">査読対応確認</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					査読対応確認
				</div>
				<div class="card-body">
				{!! Form::open(array('route' => 'opponents.sendmail','method'=>'POST')) !!}
						<div class="form-group">
							<label for="mailcontent">メール内容</label>
							{!! Form::textarea('mailbody', '{Name}先生

いつも大変お世話になっております。
第3回学術大会の査読依頼をさせていただければと思います。
以下のリンクより、査読対応、可否をご回答くださいませ。

{Link}', array('id' => 'mailcontent','class' => 'form-control','rows' => '10')) !!}

						</div>
						<div class="form-group">
							<label for="destination">送信先</label>
							{!! Form::select('opponents[]', $opponents, $checkboxs, array('id' => 'destination','class' => 'form-control select2','multiple')) !!}
						</div>
						<div class="d-flex justify-content-end">
							{!! Form::submit(_i('Send'), array('class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4')) !!}
						</div>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection