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
	<div class="card">
		<div class="card-header">
			査読対応確認
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<form>
						<div class="form-group">
						<label for="mailcontent">メール内容</label>
							<textarea name="reviews" class="form-control" id="mailcontent" rows="10">{Name}先生

いつも大変お世話になっております。
第3回学術大会の査読依頼をさせていただければと思います。
以下のリンクより、査読対応、可否をご回答くださいませ。

{Link}

							</textarea>
						</div>
						<div class="form-group">
							<label for="destination">送信先</label>
							<input type="destination" class="form-control" id="destination" placeholder="田中太郎先生、田中五郎先生、田中一郎先生">
						</div>
						<div class="container">
							<div class="row">
								<div class="col-sm"></div>
								<button type="submit" class="btn btn-primary btn-lg btn-block col-sm">送信</button>
								<div class="col-sm"></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection