

<?php $__env->startSection('title', _i('Request reply')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(_i('Confirmation to become a member of the thesis')); ?></div>

                <div class="card-body">
                    <div class="card-text">
                    	<?php if($message = Session::get('success')): ?>
							<div class="alert alert-success" role="alert">
							   <?php echo e($message); ?>

							</div>
						<?php endif; ?>
						<?php if(count($errors) > 0): ?>
						    <div class="alert alert-danger">
						        <strong>Whoops!</strong> There were some problems with your input.<br><br>
						        <ul>
						        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						            <li><?php echo e($error); ?></li>
						        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						        </ul>
						    </div>
						<?php endif; ?>
						<div class="row">
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong><?php echo e(_i('Title')); ?></strong>
						            <?php echo e($rows->title); ?>

						        </div>
						    </div>
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong><?php echo e(_i('Registration date')); ?></strong>
						            <?php echo e($rows->start_date . ' ~ ' . $rows->end_date); ?>

						        </div>
						    </div>
						</div>
						<?php echo Form::open(array('route' => 'request.reply','method'=>'POST')); ?>

						<?php echo Form::hidden('review_token', $review_token); ?>

							<div class="row">
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Can you join to become a member of the thesis?')); ?></strong>
							            <div class="form-group mt-3">
								            <?php echo Form::radio('review_status', 'yes' , true,  array('id'=>'yes')); ?>

											<?php echo Form::label('yes', _i('Yes')); ?>

								            <?php echo Form::radio('review_status', 'no' , false,  array('id'=>'no')); ?>

	  										<?php echo Form::label('no', _i('No')); ?>

								        </div>
							        </div>
							    </div>

							    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
							    	<?php echo Form::submit(_i('Submit'), array('class' => 'btn btn-primary')); ?>

							    </div>
							</div>
						<?php echo Form::close(); ?>

					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guess', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>