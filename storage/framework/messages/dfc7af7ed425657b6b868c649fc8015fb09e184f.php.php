

<?php $__env->startSection('title', _i('Student list')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Datatable -->
<link  href="<?php echo e(asset('css/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('css/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Student list')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Student list')); ?>

		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if($message = Session::get('success')): ?>
					<script>
						toastr.success('<?php echo e($message); ?>');
					</script>
				<?php endif; ?>

				<div class="table-scroll">
					<table class="table table-striped table-bordered data-table table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="fix-width">No.</th>
								<th><?php echo e(_i('Student name')); ?></th>
								<th><?php echo e(_i('Email')); ?></th>
								<th><?php echo e(_i('Gender')); ?></th>
								<th><?php echo e(_i('Date of birth')); ?></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('foot'); ?>
<!-- Datatable -->
<script src="<?php echo e(asset('js/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/responsive.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript">
	var essays = {submiter:'<?php echo e(route("essays.submiter")); ?>'};
</script><script src="<?php echo e(asset('js/essays-submiter.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>