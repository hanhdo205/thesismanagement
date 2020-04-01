

<?php $__env->startSection('title', '演題管理'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php
	$data = Config::get('sampledata.data');
?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">演題管理</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			演題管理
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
					<label>演題提出URL： <a href="#">https://example.com/endai_teisyutu/02</a></label>
				</div>
				<div class="form-group">
					<div class="form-inline custom-inline">
						<div class="alert alert-secondary" role="alert">
							<form class="form-inline">
								<input type="text" name="fullname" class="form-control mt-1 mb-1 mr-sm-2" id="fullname" placeholder="氏名">
								<select name="review_result" class="form-control mb-1 mt-1 mr-sm-2" id="review_result">
									<option>査読結果</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
								<button type="submit" class="form-control btn btn-primary pl-5 pr-5 mt-1 mb-1">検索</button>
							</form>
						</div>
					</div>
				</div>
				<div class="form-group">
					<form action="/review/request" class="form-inline" method="POST">
						<?php echo csrf_field(); ?> <!-- <?php echo e(csrf_field()); ?> -->
						<select name="select" class="form-control mr-sm-2" id="select">
							<option>選択してください</option>
							<option>査読依頼</option>
							<option>CSVダウンロード</option>
						</select>
						<button type="submit" class="form-control btn btn-primary pl-5 pr-5">検索</button>
					</form>
				</div>
				<div class="table-scroll">
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
								<th>タイトル</th>
								<th>氏名</th>
								<th>ステータス</th>
								<th>査読結果</th>
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
								<td class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="<?php echo e($abstract['id']); ?>" />
										<span class="checkmark"></span>
									</label>
								</td>
								<td class="fix-width"><?php echo e($abstract['id']); ?></td>
								<td><?php echo e($abstract['title']); ?></td>
								<td><?php echo e($abstract['name']); ?></td>
								<td><?php echo e($abstract['status']); ?></td>
								<td><?php echo e($abstract['review']); ?></td>
								<td><?php echo e($abs_date); ?></td>
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