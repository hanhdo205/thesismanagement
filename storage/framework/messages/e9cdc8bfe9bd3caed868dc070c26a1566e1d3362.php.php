

<?php $__env->startSection('title', _i('Review request mail template')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Select2 styles-->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Review request mail template')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					<?php echo e(_i('Review request mail template')); ?>

				</div>
				<div class="card-body">
				<?php echo Form::open(array('route' => 'opponents.sendmail','method'=>'POST','id'=>'sendMail')); ?>

				<?php echo Form::hidden('topic_id', $topic); ?>

						<div class="form-group">
							<label for="mailcontent">メール内容</label>
							<?php echo Form::textarea('mailbody', '{Name}先生

いつも大変お世話になっております。
第3回学術大会の査読依頼をさせていただければと思います。
以下のリンクより、査読対応、可否をご回答くださいませ。

{Link}', array('id' => 'mailcontent','class' => 'form-control','rows' => '10')); ?>


						</div>
						<div class="form-group">
							<label for="destination">送信先</label>
							<?php echo Form::select('opponents[]', $opponents, $checkboxs, array('id' => 'destination','class' => 'form-control select2','multiple')); ?>

						</div>
						<div class="d-flex justify-content-end">
							<?php echo Form::button(_i('Send'), array('id' => 'submitBtn','class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4')); ?>

						</div>
					<?php echo Form::close(); ?>


				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('foot'); ?>
<script type="text/javascript">
	var translate = {
		no_destination:'<?php echo e(_i("No item selected")); ?>',
		no_content:'<?php echo e(_i("Email content can not be blank")); ?>',
	};
</script>
<script src="<?php echo e(asset('js/opponents-confirmation.js')); ?>"></script>
<!-- Select2 script -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>