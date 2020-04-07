

<?php $__env->startSection('title', _i('Edit Role')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(route('roles.index')); ?>"><?php echo e(_i('Role Management')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Edit Role')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Edit Role')); ?>

			<span class="float-right">
				<a class="btn btn-sm btn-primary" href="<?php echo e(route('roles.index')); ?>"> <?php echo e(_i('Back')); ?></a>
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
				<?php echo Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]); ?>

					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Name')); ?>:</strong>
					            <?php echo Form::text('name', null, array('placeholder' => _i('Name'),'class' => 'form-control')); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Permission')); ?>:</strong>
					            <br/>
					            <?php
					            $new_permission = [];
					            ?>
					            <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					            	<?php
					            	$permission_arr = explode("-", $value->name);
					            	$group_permission = $permission_arr[0];
					            	$new_permission[$group_permission][] = ['id' => $value->id,'name'=>$value->name];
					            	?>
					            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					            <div class="row">
						            <?php $__currentLoopData = $new_permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						            	<div class="col-md-3">
							            	<strong><?php echo e(_i($key)); ?> </strong><br/>
							            	<?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						            			<label><?php echo e(Form::checkbox('permission[]', $gr['id'], in_array($gr['id'], $rolePermissions) ? true : false, array('class' => 'name'))); ?>

							                	<?php echo e(_i($gr['name'])); ?></label>
							            		<br/>
							            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						            	</div>
						            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					        	</div>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>