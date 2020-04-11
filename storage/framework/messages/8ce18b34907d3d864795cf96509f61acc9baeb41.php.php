

<?php $__env->startSection('title', _i('Essay result detail')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Essay result detail')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					<?php echo e(_i('Essay result detail')); ?>

				</div>
				<div class="card-body">
					<!-- <form> -->
						<div class="form-group row">
							<label for="fullname" class="col-sm-3 col-form-label"><?php echo e(_i('Student name')); ?></label>
							<div class="col-sm-9">
								<input type="fullname" class="form-control" id="fullname">
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_belong" class="col-sm-3 col-form-label"><?php echo e(_i('Belong to')); ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="essay_belong">
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_major" class="col-sm-3 col-form-label"><?php echo e(_i('Major')); ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="essay_major">
							</div>
						</div>
						<div class="form-group row mb-3">
							<label for="essay_title" class="col-sm-3 col-form-label"><?php echo e(_i('Title')); ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="essay_title">
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-3 col-form-label"><?php echo e(_i('Status')); ?></label>
							<div class="col-sm-9">
								<input type="status" class="form-control" id="status">
							</div>
						</div>
						<div class="form-group row">
							<label for="reviewer" class="col-sm-3 col-form-label"><?php echo e(_i('Reviewer')); ?></label>
							<div class="col-sm-9">
								<input type="reviewer" class="form-control" id="reviewer">
							</div>
						</div>
						<div class="form-group row">
							<label for="result" class="col-sm-3 col-form-label"><?php echo e(_i('Review result')); ?></label>
							<div class="col-sm-9">
								<div class="text-success">採択</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="file_download" class="col-sm-3 col-form-label"><?php echo e(_i('Link to download')); ?></label>
							<div class="col-sm-9">
								<a href="#">ダウンロード</a>
							</div>
						</div>
						<div class="form-group">
							<label for="comment"><?php echo e(_i('Comments')); ?></label>
							<textarea name="comment" class="form-control" id="comment" rows="3">ユニークな視点の研究でした。Good</textarea>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4"><?php echo e(_i('Save changes')); ?></button>
						</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>