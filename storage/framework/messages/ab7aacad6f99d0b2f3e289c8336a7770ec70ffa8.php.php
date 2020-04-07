

<?php $__env->startSection('title', _i('Topic management')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Topic management')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Topic management')); ?>

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-create')): ?>
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="<?php echo e(route('topics.create')); ?>"> <?php echo e(_i('Add new topic')); ?></a>
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
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width"><?php echo e(_i('No.')); ?></th>
								<th><?php echo e(_i('Title')); ?></th>
								<th><?php echo e(_i('Period')); ?></th>
								<th><?php echo e(_i('Status')); ?></th>
								<th><?php echo e(_i('Action')); ?></th>
							</tr>
						</thead>
						<tbody>
					    	<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    	<?php
					    		$period = $topic->start_date . ' ~ ' . $topic->end_date;
					    		$start_date = new DateTime($topic->start_date);
					    		$end_date = new DateTime($topic->end_date);
								$now = new DateTime();
								$status = _i('Available');
				    		?>
				    		<?php if($end_date < $now): ?>
							    <?php
							    $status = _i('Expired');
							    ?>
							<?php endif; ?>
							<?php if($start_date > $now): ?>
								<?php
								$status = _i('Comming soon');
								?>
							<?php endif; ?>
							<tr>
						        <td><?php echo e(++$i); ?></td>
						        <td><?php echo e($topic->title); ?></td>
						        <td><?php echo e($period); ?></td>
						        <td><?php echo e($status); ?></td>
						        <td nowrap>
					                <form action="<?php echo e(route('topics.destroy',$topic->id)); ?>" id="formDelete_<?php echo e($topic->id); ?>" method="POST">
					                    <a class="btn btn-info" href="<?php echo e(route('topics.show',$topic->id)); ?>"><?php echo e(_i('Show')); ?></a>
					                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-edit')): ?>
					                    <a class="btn btn-primary" href="<?php echo e(route('topics.edit',$topic->id)); ?>"><?php echo e(_i('Edit')); ?></a>
					                    <?php endif; ?>


					                    <?php echo csrf_field(); ?>
					                    <?php echo method_field('DELETE'); ?>
					                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-delete')): ?>
					                    <button type="button" class="btnDel btn btn-danger" data-toggle="modal" data-target="#confirm"><?php echo e(_i('Delete')); ?></button>
					                    <?php endif; ?>
					                </form>
						        </td>
						    </tr>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    	</tbody>
			    	</table>
			    </div>
				<?php echo $topics->links(); ?>

			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>