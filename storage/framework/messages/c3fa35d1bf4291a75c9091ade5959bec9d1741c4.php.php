

<?php $__env->startSection('title', 'Show Role'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Show Role</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			Show Role
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="<?php echo e(route('roles.index')); ?>"> Back</a>
				</span>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>Name:</strong>
				            <?php echo e($role->name); ?>

				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong>Permissions:</strong>
				            <?php if(!empty($rolePermissions)): ?>
				                <?php $__currentLoopData = $rolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                    <label class="label label-success"><?php echo e($v->name); ?>,</label>
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