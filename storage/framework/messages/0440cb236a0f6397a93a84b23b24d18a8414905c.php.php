

<?php $__env->startSection('title', 'Role Management'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Role Management</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			Role Management
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="<?php echo e(route('roles.create')); ?>"> Create New Role</a>
				</span>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if($message = Session::get('success')): ?>
				    <div class="alert alert-success">
				        <p><?php echo e($message); ?></p>
				    </div>
				<?php endif; ?>
				<table class="table table-bordered">
				  <tr>
				     <th>No</th>
				     <th>Name</th>
				     <th width="280px">Action</th>
				  </tr>
				    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				    <tr>
				        <td><?php echo e(++$i); ?></td>
				        <td><?php echo e($role->name); ?></td>
				        <td>
				            <a class="btn btn-info" href="<?php echo e(route('roles.show',$role->id)); ?>">Show</a>
				            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-edit')): ?>
				                <a class="btn btn-primary" href="<?php echo e(route('roles.edit',$role->id)); ?>">Edit</a>
				            <?php endif; ?>
				            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-delete')): ?>
				                <?php echo Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']); ?>

				                    <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

				                <?php echo Form::close(); ?>

				            <?php endif; ?>
				        </td>
				    </tr>
				    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</table>
				<?php echo $roles->render(); ?>

			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>