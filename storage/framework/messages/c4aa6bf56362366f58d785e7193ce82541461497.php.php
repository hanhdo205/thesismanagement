

<?php $__env->startSection('title', _i('User management')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('User management')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('User management')); ?>

			<span class="float-right">
				<a class="btn btn-sm btn-primary" href="<?php echo e(route('users.create')); ?>"> <?php echo e(_i('Create New User')); ?></a>
			</span>
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
						 <tr>
						   <th><?php echo e(_i('No.')); ?></th>
						   <th><?php echo e(_i('Name')); ?></th>
						   <th><?php echo e(_i('Email')); ?></th>
						   <th><?php echo e(_i('Roles')); ?></th>
						   <th><?php echo e(_i('Action')); ?></th>
						 </tr>
						 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <tr>
						    <td><?php echo e(++$i); ?></td>
						    <td><?php echo e($user->name); ?></td>
						    <td><?php echo e($user->email); ?></td>
						    <td>
						      <?php if(!empty($user->getRoleNames())): ?>
						        <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						           <label class="badge badge-success"><?php echo e($v); ?></label>
						        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						      <?php endif; ?>
						    </td>
						    <td nowrap>
						       <a class="btn btn-info" href="<?php echo e(route('users.show',$user->id)); ?>"><?php echo e(_i('Show')); ?></a>
						       <a class="btn btn-primary" href="<?php echo e(route('users.edit',$user->id)); ?>"><?php echo e(_i('Edit')); ?></a>
						        <?php echo Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'id' => 'formDelete_'.$user->id,'style'=>'display:inline']); ?>

						            <?php echo Form::button(_i('Delete'), ['id' => 'btn-delete','class' => 'btnDel btn btn-danger','data-toggle' => 'modal','data-target' => '#confirm']); ?>

						        <?php echo Form::close(); ?>

						    </td>
						  </tr>
						 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				<?php echo $data->render(); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>