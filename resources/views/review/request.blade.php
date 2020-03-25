@extends('layouts.app')

@section('title', '査読依頼')
@section('description', 'The SIS management')
@section('keyword', 'management')

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">査読依頼
</li>
  </ol>
</nav>
<div id="page-inner">
	<div class="card col">
		<div class="card-body">
			<h5 class="card-title">査読依頼</h5>
			<div class="card-text">
				<div>以下の演題に対して査読依頼を実施しますか？</div>
				<div>問題ない場合は、査読依頼ボタンを押してください。</div>
				<div>査読依頼を先生へとメールで依頼します。</div>
				<div class="row mt-3">
					<div class="col-6">
						<form>
							<div class="form-group mb-5">
								<textarea name="reviews" class="form-control" id="reviews" rows="5">膝関節に関するリハビリ- 著:田中太郎
膝関節に関するリハビリ- 著:田中太郎
								</textarea>
							</div>
							<button type="submit" class="btn btn-primary btn-lg btn-block">査読依頼</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
@endsection