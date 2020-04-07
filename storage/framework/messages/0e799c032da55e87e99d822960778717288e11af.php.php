

<?php $__env->startSection('title', 'Create New Conference'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create New Conference</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			Create New Conference
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
				<?php echo Form::open(array('route' => 'conferences.store','method'=>'POST')); ?>

					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>タイトル:</strong>
					            <?php echo Form::text('title', null, array('placeholder' => 'タイトル','class' => 'form-control')); ?>

					        </div>
					    </div>

					    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
					        <button type="submit" class="btn btn-primary">Submit</button>
					    </div>
					</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>