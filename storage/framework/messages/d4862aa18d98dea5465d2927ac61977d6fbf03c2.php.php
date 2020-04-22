

<?php $__env->startSection('title', _i('Home page')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php
	$data = Config::get('sampledata.data');
?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Home')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card mb-3">
		<div class="card-header">
			<?php echo e(_i('Lastest essays')); ?>

		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width"><?php echo e(_i('No.')); ?></th>
								<th><?php echo e(_i('Title')); ?></th>
								<th><?php echo e(_i('Student name')); ?></th>
								<th><?php echo e(_i('Submission date')); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php if(count($lastestEssays) == 0): ?>
							<tr>
								<td colspan="4" align="center"><?php echo e(_i('There is no data.')); ?></td>
							</tr>
						<?php else: ?>
							<?php $__currentLoopData = $lastestEssays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $essay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td class="fix-width"><?php echo e(++$i); ?></td>
									<td><?php echo e($essay->essay_title); ?></td>
									<td><?php echo e($essay->student_name); ?></td>
									<td><?php echo e(Carbon\Carbon::parse($essay->created_at)->format('Y年m月d日')); ?></td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Lastest reviews')); ?>

		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width"><?php echo e(_i('No.')); ?></th>
								<th><?php echo e(_i('Title')); ?></th>
								<th><?php echo e(_i('Student name')); ?></th>
								<th><?php echo e(_i('Submission date')); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php if(count($lastestReview) == 0): ?>
							<tr>
								<td colspan="4" align="center"><?php echo e(_i('There is no data.')); ?></td>
							</tr>
						<?php else: ?>
							<?php $__currentLoopData = $lastestReview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td class="fix-width"><?php echo e(++$j); ?></td>
									<td><?php echo e($review->essay_title); ?></td>
									<td><?php echo e($review->student_name); ?></td>
									<td><?php echo e(Carbon\Carbon::parse($review->updated_at)->format('Y年m月d日')); ?></td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>