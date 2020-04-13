

<?php $__env->startSection('title', _i('Show Role')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li
		<li class="breadcrumb-item"><a href="<?php echo e(route('roles.index')); ?>"><?php echo e(_i('Role Management')); ?></a></li>		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Show Role')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Show Role')); ?>

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="<?php echo e(route('roles.index')); ?>"> <?php echo e(_i('Back')); ?></a>
				</span>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong><?php echo e(_i('Name')); ?>:</strong>
				            <?php echo e(_i($role->name)); ?>

				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong><?php echo e(_i('Permission')); ?>:</strong>
				            <?php if(!empty($rolePermissions)): ?>
				                <?php $__currentLoopData = $rolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                    <label class="label label-success"><?php echo e(_i($v->name)); ?>,</label>
				                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				            <?php endif; ?>
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