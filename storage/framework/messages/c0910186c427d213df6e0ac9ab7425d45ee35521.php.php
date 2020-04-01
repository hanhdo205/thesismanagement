

<?php $__env->startSection('title', 'Create New User'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">演題提出者管理</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create New User</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			Create New User
			<span class="float-right">
				<a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>"> Back</a>
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
				<?php echo Form::open(array('route' => 'users.store','method'=>'POST')); ?>

					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Name:</strong>
					            <?php echo Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Email:</strong>
					            <?php echo Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Password:</strong>
					            <?php echo Form::password('password', array('placeholder' => 'Password','class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Confirm Password:</strong>
					            <?php echo Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong>Role:</strong>
					            <?php echo Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')); ?>

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