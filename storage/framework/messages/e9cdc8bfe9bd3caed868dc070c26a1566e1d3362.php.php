

<?php $__env->startSection('title', _i('Review request mail template')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Select2 styles-->
<link href="<?php echo e(asset('css/select2/select2.min.css')); ?>" rel="stylesheet" />
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
				<?php echo Form::open(['route' => 'opponents.sendmail','method'=>'POST','id'=>'sendMail']); ?>

				<?php echo Form::hidden('topic_id', $topic, ['id' => 'topic_id','class' => 'form-control']); ?>

						<div class="form-group required">
							<label for="mailcontent" class="control-label"><?php echo e(_i('Mail content')); ?></label>
							<?php echo Form::textarea('mailbody', '{Name}先生

いつも大変お世話になっております。
第3回学術大会の査読依頼をさせていただければと思います。
以下のリンクより、査読対応、可否をご回答くださいませ。

{Link}', ['id' => 'mailcontent','class' => 'form-control','rows' => '10']); ?>

<span class="invalid-feedback"><?php echo e(_i('This is a required field')); ?></span>

						</div>
						<div class="form-group required">
							<label for="destination" class="control-label"><?php echo e(_i('Receiver')); ?></label>
							<?php echo Form::select('opponents[]', $opponents, $checkboxs, ['id' => 'destination','class' => 'form-control select2','multiple']); ?>

							<span class="invalid-feedback"><?php echo e(_i('This is a required field')); ?></span>
						</div>
						<div class="d-flex justify-content-end">
							<span class="spinner-border mr-3" role="status" aria-hidden="true"></span>
							<?php echo Form::button(_i('Send confirmation'), ['id' => 'submitBtn','class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-3 col-xl-4','data-toggle'=>'popover', 'data-placement' => 'left', 'data-content'=>_i('All of them were received the emails already!')]); ?>

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
	var opponents = {check:'<?php echo e(route("opponents.check")); ?>'};
</script>
<script src="<?php echo e(asset('js/opponents-confirmation.js')); ?>"></script>
<!-- Select2 script -->
<script src="<?php echo e(asset('js/select2/select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>