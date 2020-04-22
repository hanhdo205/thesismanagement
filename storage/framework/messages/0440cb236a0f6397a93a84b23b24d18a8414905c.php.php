

<?php $__env->startSection('title', _i('Role Management')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Role Management')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Role Management')); ?>

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="<?php echo e(route('roles.create')); ?>"> <?php echo e(_i('Create New Role')); ?></a>
				</span>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if($message = Session::get('success')): ?>
				    <script>
						toastr.success('<?php echo e($message); ?>');
					</script>
				<?php endif; ?>
				<div class="table-scroll">
					<table class="table table-bordered">
						<thead  align="center">
					  <tr>
					     <th><?php echo e(_i('No.')); ?></th>
					     <th><?php echo e(_i('Name')); ?></th>
					     <th><?php echo e(_i('Action')); ?></th>
					  </tr>
					  </thead>
						<tbody>
					    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr>
					        <td><?php echo e(++$i); ?></td>
					        <td><?php echo e(_i($role->name)); ?></td>
					        <td nowrap>
					            <a class="btn btn-sm btn-info" href="<?php echo e(route('roles.show',$role->id)); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
					            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-edit')): ?>
					                <a class="btn btn-sm btn-primary" href="<?php echo e(route('roles.edit',$role->id)); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					            <?php endif; ?>
					            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-delete')): ?>
					                <?php echo Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'id' => 'formDelete_'.$role->id,'style'=>'display:inline']); ?>

					                    <?php echo Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['class' => 'btnDel btn-sm btn btn-danger','data-toggle' => 'modal','data-target' => '#confirm']); ?>

					                <?php echo Form::close(); ?>

					            <?php endif; ?>
					        </td>
					    </tr>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    </tbody>
					</table>
					<?php echo $roles->render(); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('foot'); ?>
<!-- Delete confirm-->
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- End Delete confirm -->
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>