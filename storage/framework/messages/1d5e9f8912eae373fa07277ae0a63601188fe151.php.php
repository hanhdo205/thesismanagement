

<?php $__env->startSection('title', _i('Essay result detail')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Select2 styles-->
<link href="<?php echo e(asset('css/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
	$review_comment_err = $student_name_err = $essay_belong_err = $essay_major_err = $essay_title_err = '';
?>
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
						<?php if(count($errors) > 0): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							    <?php echo e(_i('There were some problems with your input.')); ?>

							    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
						 	<?php if($errors->first('review_comment')): ?>
							    <?php
							    	$review_comment_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('student_name')): ?>
							    <?php
							    	$student_name_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('essay_belong')): ?>
							    <?php
							    	$essay_belong_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('essay_major')): ?>
							    <?php
							    	$essay_major_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('essay_title')): ?>
							    <?php
							    	$essay_title_err = ' is-invalid';
							    ?>
							<?php endif; ?>
						<?php endif; ?>
						<?php if($message = Session::get('success')): ?>
							<script>
								toastr.success('<?php echo e($message); ?>');
							</script>
						<?php endif; ?>
					<?php echo Form::model($rows, ['method' => 'PATCH','route' => ['essays.update', $rows->id]]); ?>

						<div class="form-group row">
							<label for="student_name" class="col-sm-3 col-form-label"><?php echo e(_i('Student name')); ?></label>
							<div class="col-sm-9">
								<?php echo Form::text('student_name', null, ['id' => 'student_name','class' => 'form-control' . $student_name_err]); ?>

								<span class="text-danger"><?php echo e($errors->first('student_name')); ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_belong" class="col-sm-3 col-form-label"><?php echo e(_i('Belong to')); ?></label>
							<div class="col-sm-9">
								<?php echo Form::text('essay_belong', null, ['id' => 'essay_belong','class' => 'form-control' . $essay_belong_err]); ?>

								<span class="text-danger"><?php echo e($errors->first('essay_belong')); ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="essay_major" class="col-sm-3 col-form-label"><?php echo e(_i('Major')); ?></label>
							<div class="col-sm-9">
								<?php echo Form::text('essay_major', null, ['id' => 'essay_major','class' => 'form-control' . $essay_major_err]); ?>

								<span class="text-danger"><?php echo e($errors->first('essay_major')); ?></span>
							</div>
						</div>
						<div class="form-group row mb-3">
							<label for="essay_title" class="col-sm-3 col-form-label"><?php echo e(_i('Title')); ?></label>
							<div class="col-sm-9">
								<?php echo Form::text('essay_title', null, ['id' => 'essay_title','class' => 'form-control' .$essay_title_err]); ?>

								<span class="text-danger"><?php echo e($errors->first('essay_title')); ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="review_status" class="col-sm-3 col-form-label"><?php echo e(_i('Status')); ?></label>
							<div class="col-sm-9">
								<?php echo Form::select('review_status', ['pending' => _i('pending'),'reviewing' => _i('reviewing'),'reviewed' => _i('reviewed')], $rows->review_status, ['class' => 'form-control select2','data-minimum-results-for-search'=>'Infinity']); ?>

							</div>
						</div>
						<div class="form-group row">
							<label for="reviewer" class="col-sm-3 col-form-label"><?php echo e(_i('Reviewer')); ?></label>
							<div class="col-sm-9">
								<?php echo Form::select('reviewer_id', [$rows->reviewer_id => $rows->reviewer], $rows->reviewer_id, ['class' => 'form-control select2','data-minimum-results-for-search'=>'Infinity']); ?>

								<?php echo Form::hidden('review_result', null, array()); ?>

							</div>
						</div>
						<div class="form-group row">
							<label for="result" class="col-sm-3 col-form-label"><?php echo e(_i('Review result')); ?></label>
							<div class="col-sm-9">
								<div class="text-success"><?php echo e(_i($rows->review_result)); ?></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="file_download" class="col-sm-4 col-form-label"><?php echo e(_i('Link to download')); ?></label>
							<div class="col-sm-8">
								<a href="<?php echo e(Storage::url($rows->essay_file)); ?>"><?php echo e(_i('Download')); ?></a>
							</div>
						</div>
						<div class="form-group">
							<label for="comment"><?php echo e(_i('Comments')); ?></label>
							<?php echo Form::textarea('review_comment', null, ['id' => 'comment','class' => 'form-control' . $review_comment_err,'rows' => '3']); ?>

							<span class="text-danger"><?php echo e($errors->first('review_comment')); ?></span>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4"><?php echo e(_i('Save changes')); ?></button>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('foot'); ?>
<!-- Select2 script -->
<script src="<?php echo e(asset('js/select2/select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>