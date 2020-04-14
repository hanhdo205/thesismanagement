

<?php $__env->startSection('title', _i('Essay review form')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Select2 styles-->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(_i('Essay review form')); ?></div>
				<div class="card-body">
						<?php if(count($errors) > 0): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							    <?php echo e(_i('There were some problems with your input.')); ?>

							    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
						<?php endif; ?>
						<?php if($message = Session::get('success')): ?>
							<div class="alert alert-success" role="alert">
							   <?php echo e($message); ?>

							</div>
						<?php endif; ?>
					<?php echo Form::model($rows, ['method' => 'PATCH','route' => ['essays.update', $rows->id]]); ?>

						<div class="row">
						    <div class="review-form col-lg-6 col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<label for="student_name"><?php echo e(_i('Student name')); ?></label>
									<div class="alert alert-secondary" role="alert">
									  	<?php echo e($rows->student_name); ?>

									</div>
										<?php echo Form::hidden('student_name', null, array('id' => 'student_name','class' => 'form-control')); ?>

								</div>
								<div class="form-group">
									<label for="essay_belong"><?php echo e(_i('Belong to')); ?></label>
									<div class="alert alert-secondary" role="alert">
									  	<?php echo e($rows->essay_belong); ?>

									</div>
										<?php echo Form::hidden('essay_belong', null, array('id' => 'essay_belong','class' => 'form-control')); ?>

								</div>
								<div class="form-group">
									<label for="essay_major"><?php echo e(_i('Major')); ?></label>
									<div class="alert alert-secondary" role="alert">
									  	<?php echo e($rows->essay_major); ?>

									</div>
										<?php echo Form::hidden('essay_major', null, array('id' => 'essay_major','class' => 'form-control')); ?>

								</div>
								<div class="form-group mb-3">
									<label for="essay_title"><?php echo e(_i('Title')); ?></label>
									<div class="alert alert-secondary" role="alert">
									  	<?php echo e($rows->essay_title); ?>

									</div>
										<?php echo Form::hidden('essay_title', null, array('id' => 'essay_title','class' => 'form-control')); ?>

								</div>
								<div class="form-group mb-3">
									<label for="essay_title"><?php echo e(_i('Link to download')); ?></label>
									<a  href="<?php echo e(Storage::url($rows->essay_file)); ?>" class="btn btn-warning btn-lg btn-block"><i class="fa fa-download" aria-hidden="true"></i> <?php echo e(_i('Download')); ?></a>
								</div>
							</div>

						    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<label for="reviewer"><?php echo e(_i('Reviewer')); ?></label>
										<?php echo Form::select('reviewer_id', [$rows->reviewer_id => $rows->reviewer], $rows->reviewer_id, array('class' => 'form-control select2')); ?>

								</div>
								<div class="form-group">
									<label for="review_status"><?php echo e(_i('Review result')); ?></label>
										<?php echo Form::select('review_result', ['good' => _i(RESULT_GOOD),'bad' => _i(RESULT_BAD)], $rows->review_result, array('class' => 'form-control select2', 'placeholder' => _i(RESULT_NONE) )); ?>

										<span class="text-danger"><?php echo e($errors->first('review_result')); ?></span>
								</div>
								<div class="form-group">
									<label for="comment"><?php echo e(_i('Comments')); ?></label>
									<?php echo Form::textarea('review_comment', null, array('id' => 'comment','class' => 'form-control','rows' => '5')); ?>

									<span class="text-danger"><?php echo e($errors->first('review_comment')); ?></span>
								</div>
								<div class="d-flex justify-content-end">
									<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4 mt-3"><?php echo e(_i('Save changes')); ?></button>
								</div>
							</div>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.guess', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>