

<?php $__env->startSection('title', '演題詳細'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">演題詳細</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					演題詳細
				</div>
				<div class="card-body">
					<!-- <form> -->
						<div class="form-group row">
							<label for="fullname" class="col-sm-3 col-form-label">氏名</label>
							<div class="col-sm-9">
								<input type="fullname" class="form-control" id="fullname" placeholder="田中　太郎">
							</div>
						</div>
						<div class="form-group row">
							<label for="affiliate" class="col-sm-3 col-form-label">所属</label>
							<div class="col-sm-9">
								<input type="affiliate" class="form-control" id="affiliate" placeholder="理学療法士">
							</div>
						</div>
						<div class="form-group row">
							<label for="special" class="col-sm-3 col-form-label">専門</label>
							<div class="col-sm-9">
								<input type="special" class="form-control" id="special" placeholder="肩関節">
							</div>
						</div>
						<div class="form-group row mb-3">
							<label for="abstract" class="col-sm-3 col-form-label">演題</label>
							<div class="col-sm-9">
								<input type="abstract" class="form-control" id="abstract" placeholder="肩関節に関するリハビリ">
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-3 col-form-label">ステータス</label>
							<div class="col-sm-9">
								<input type="status" class="form-control" id="status" placeholder="査読済み">
							</div>
						</div>
						<div class="form-group row">
							<label for="reviewer" class="col-sm-3 col-form-label">査読者</label>
							<div class="col-sm-9">
								<input type="reviewer" class="form-control" id="reviewer" placeholder="田中　三郎先生">
							</div>
						</div>
						<div class="form-group row">
							<label for="result" class="col-sm-3 col-form-label">査読結果</label>
							<div class="col-sm-9">
								<div class="text-success">採択</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="file_download" class="col-sm-3 col-form-label">ファイルダウンロード</label>
							<div class="col-sm-9">
								<a href="#">ダウンロード</a>
							</div>
						</div>
						<div class="form-group">
							<label for="comment">査読者コメント</label>
							<textarea name="comment" class="form-control" id="comment" rows="3">ユニークな視点の研究でした。Good</textarea>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4">変更</button>
						</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>