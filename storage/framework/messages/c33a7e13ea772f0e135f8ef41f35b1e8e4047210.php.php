

<?php $__env->startSection('title', _i('My profile')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<?php
	$name_err = $mail_err = $password_err = $confirm_password_err = '';
?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('My profile')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					<?php echo e(_i('My profile')); ?>

				</div>
				<div class="card-body">
					<div class="card-text">
						<?php if(count($errors) > 0): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							    <?php echo e(_i('There were some problems with your input.')); ?>

							    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						  	</div>
						  	<?php if($errors->first('name')): ?>
							    <?php
							    	$name_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('mail')): ?>
							    <?php
							    	$mail_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('password')): ?>
							    <?php
							    	$password_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('password-confirm')): ?>
							    <?php
							    	$confirm_password_err = ' is-invalid';
							    ?>
							<?php endif; ?>

						<?php endif; ?>
						<?php if($message = Session::get('success')): ?>
							<script>
								toastr.success('<?php echo e($message); ?>');
							</script>
						<?php endif; ?>
						<?php echo Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id],'novalidate']); ?>

							<div class="row">
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Name')); ?></strong>
							            <?php echo Form::text('name', null, ['placeholder' => _i('Name'),'class' => 'form-control' . $name_err]); ?>

							            <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Email')); ?></strong>
							            <?php echo Form::text('email', null, ['placeholder' => _i('Email'),'class' => 'form-control' . $mail_err]); ?>

							            <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('New password')); ?></strong>
							            <?php echo Form::password('password', ['placeholder' => _i('New password'),'class' => 'form-control' . $password_err]); ?>

							            <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Confirm Password')); ?></strong>
							            <?php echo Form::password('confirm-password', ['placeholder' => _i('Confirm Password'),'class' => 'form-control' . $confirm_password_err]); ?>

							            <span class="text-danger"><?php echo e($errors->first('confirm-password')); ?></span>
							        </div>
							    </div>

							            <?php echo Form::select('roles[]', $roles,$userRole, ['class' => 'd-none form-control','multiple']); ?>


							    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
							    	<?php echo Form::submit(_i('Update profile'), ['class' => 'btn btn-primary']); ?>

							    </div>
							</div>
						<?php echo Form::close(); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>