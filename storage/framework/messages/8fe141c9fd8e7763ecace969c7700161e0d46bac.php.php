

<?php $__env->startSection('title', '査読対応確認'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
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
					<form action="/review/detail" method="POST">
						<?php echo csrf_field(); ?> <!-- <?php echo e(csrf_field()); ?> -->
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
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4">送信</button>
						</div>
					</form>
						
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>