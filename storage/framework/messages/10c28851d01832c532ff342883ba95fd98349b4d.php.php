

<?php $__env->startSection('title',  $topic->title  ); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(route('topics.index')); ?>"><?php echo e(_i('Topic management')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e($topic->title); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e($topic->title); ?>

		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong><?php echo e(_i('Title')); ?></strong>
				            <?php echo e($topic->title); ?>

				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong><?php echo e(_i('Period')); ?></strong>
				            <?php echo e($topic->start_date . ' ~ ' . $topic->end_date); ?>

				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>