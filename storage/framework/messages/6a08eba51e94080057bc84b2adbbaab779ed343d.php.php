

<?php $__env->startSection('title', '査読者管理'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php
	$data = Config::get('sampledata.data');
?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">査読者管理</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			査読者管理
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="form-group">
					<div class="form-inline">
						<select name="target_academic" class="form-control" id="target_academic">
							<option>対象学術大会を選択してください</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="form-inline">
						<button class="form-control btn btn-primary mr-sm-2 pl-5 pr-5">CSV一括取り込み</button>
						<button class="form-control btn btn-primary pl-5 pr-5">新規追加</button>
					</div>
				</div>
				<div class="table-scroll mb-5">
					<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="selectAll" />
										<span class="checkmark"></span>
									</label>
								</th>
								<th class="fix-width">No.</th>
								<th>氏名</th>
								<th>依頼状況</th>
							</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $data['review']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="<?php echo e($review['id']); ?>" />
										<span class="checkmark"></span>
									</label>
								</td>
								<td class="fix-width"><?php echo e($review['id']); ?></td>
								<td><?php echo e($review['name']); ?></td>
								<td><?php echo e($review['status']); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
				<div class="form-group">
					<form action="/review/confirmation" class="d-flex justify-content-center" method="POST">
					<?php echo csrf_field(); ?> <!-- <?php echo e(csrf_field()); ?> -->
					<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-3 pl-5 pr-5">査読対応確認</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>