

<?php $__env->startSection('title', _i('Edit User')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Select2 styles-->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>"><?php echo e(_i('User management')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Edit User')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Edit User')); ?>

			<span class="float-right">
				<a class="btn btn-sm btn-primary" href="<?php echo e(route('users.index')); ?>"> <?php echo e(_i('Back')); ?></a>
			</span>
		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if(count($errors) > 0): ?>
				  <div class="alert alert-danger">
				    <strong><?php echo e(_i('Whoops!')); ?></strong> <?php echo e(_i('There were some problems with your input.')); ?><br><br>
				    <ul>
				       <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				         <li><?php echo e($error); ?></li>
				       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    </ul>
				  </div>
				<?php endif; ?>
				<?php echo Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]); ?>

					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Name')); ?>:</strong>
					            <?php echo Form::text('name', null, array('placeholder' => _i('Name'),'class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Email')); ?>:</strong>
					            <?php echo Form::text('email', null, array('placeholder' => _i('Email'),'class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Password')); ?>:</strong>
					            <?php echo Form::password('password', array('placeholder' => _i('Password'),'class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Confirm Password')); ?>:</strong>
					            <?php echo Form::password('confirm-password', array('placeholder' => _i('Confirm Password'),'class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Role')); ?>:</strong>
					            <?php echo Form::select('roles[]', $roles,$userRole, array('class' => 'form-control select2','multiple')); ?>

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
<!-- Select2 script -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>