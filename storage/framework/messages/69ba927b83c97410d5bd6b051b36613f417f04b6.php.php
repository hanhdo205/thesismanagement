

<?php $__env->startSection('title', _i('Edit Topic')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Datepicker styles-->
<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(route('topics.index')); ?>"><?php echo e(_i('Topic management')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Edit Topic')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Edit Topic')); ?>

			<span class="float-right">
				<a class="btn btn-sm btn-primary" href="<?php echo e(route('topics.index')); ?>"> <?php echo e(_i('Back')); ?></a>
			</span>
		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if(count($errors) > 0): ?>
				    <div class="alert alert-danger">
				        <strong>Whoops!</strong> There were some problems with your input.<br><br>
				        <ul>
				        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				            <li><?php echo e($error); ?></li>
				        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				        </ul>
				    </div>
				<?php endif; ?>
				<?php echo Form::model($topic, ['method' => 'PATCH','route' => ['topics.update', $topic->id]]); ?>

					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Title')); ?>:</strong>
					            <?php echo Form::text('title', null, array('placeholder' => _i('Title'),'class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Start date')); ?>:</strong>
					            <?php echo Form::text('start_date', null, array('placeholder' => _i('Start date'),'id' => 'startDate','class' => 'form-control','autocomplete' => 'off')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_I('End date')); ?>:</strong>
					            <?php echo Form::text('end_date', null, array('placeholder' => _i('End date'),'id' => 'endDate', 'class' => 'form-control','autocomplete' => 'off')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
					    	<?php echo Form::submit(_i('Submit'), array('class' => 'btn btn-primary')); ?>

					    </div>
					</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('foot'); ?>
<!-- Datepicker script -->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo e(asset('js/datepicker-ja.js')); ?>"></script>
<!-- Custom script -->
<script src="<?php echo e(asset('js/datepicker-custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>