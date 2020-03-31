

<?php $__env->startSection('title', 'TOPページ'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php
	$data = Config::get('sampledata.data');
?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card mb-3">
		<div class="card-header">
			直近の演題提出状況
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">No.</th>
								<th>タイトル</th>
								<th>氏名</th>
								<th>提出日</th>
							</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $data['abstract']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abstract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$date = date_create($abstract['date']);
								$abs_date = date_format($date,"Y年m月d日");
							?>
							<tr>
								<td class="fix-width"><?php echo e($abstract['id']); ?></td>
								<td><?php echo e($abstract['title']); ?></td>
								<td><?php echo e($abstract['name']); ?></td>
								<td><?php echo e($abs_date); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			直近の査読提出状況
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">No.</th>
								<th>タイトル</th>
								<th>氏名</th>
								<th>提出日</th>
							</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $data['review']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$rv_date = date_create($review['date']);
								$review_date = date_format($rv_date,"Y年m月d日");
							?>
							<tr>
								<td class="fix-width"><?php echo e($review['id']); ?></td>
								<td><?php echo e($review['title']); ?></td>
								<td><?php echo e($review['name']); ?></td>
								<td><?php echo e($review_date); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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