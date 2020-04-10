

<?php $__env->startSection('title',  $topic->title  ); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(_i('Registration form for essay writing competetion')); ?></div>

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
						            <?php echo e($topic->title); ?>

						        </div>
						    </div>
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong><?php echo e(_i('Registration date')); ?></strong>
						            <?php echo e($topic->start_date . ' ~ ' . $topic->end_date); ?>

						        </div>
						    </div>
						</div>
						<?php echo Form::open(array('route' => 'register.endai_teisyutu','method'=>'POST', 'enctype'=>'multipart/form-data')); ?>

						<?php echo Form::hidden('topic_id', $topic->id); ?>

							<div class="row">
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Full name')); ?></strong>
							            <?php echo Form::text('student_name', null, array('placeholder' => _i('Full name'),'class' => 'form-control')); ?>

							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Gender')); ?></strong>
							            <div class="form-group mt-3">
								            <?php echo Form::radio('student_gender', 'male' , true,  array('id'=>'male')); ?>

											<?php echo Form::label('male', _i('Male')); ?>

								            <?php echo Form::radio('student_gender', 'female' , false,  array('id'=>'female')); ?>

	  										<?php echo Form::label('female', _i('Female')); ?>

								        </div>
							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Date of birth')); ?>:</strong>
							            <?php echo Form::text('student_dob', null, array('placeholder' => _i('Date of birth'),'id' => 'dateOfBirth','class' => 'form-control','autocomplete' => 'off')); ?>

							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Email address')); ?>:</strong>
							            <?php echo Form::email('student_email', null, array('placeholder' => _i('Email address'),'id' => 'emailAddress','class' => 'form-control','autocomplete' => 'off')); ?>

							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_i('Title')); ?></strong>
							            <?php echo Form::text('essay_title', null, array('placeholder' => _i('Title'),'class' => 'form-control')); ?>

							        </div>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							        <div class="form-group">
							            <strong><?php echo e(_I('Upload')); ?></strong>
							            <span class="input-group div-select-csv-file">
						                	<?php echo Form::text('essay_file_name_txt',null,array('class' => 'essay_file_name_txt input full upload form-control', 'placeholder' => _i('No file chosen'), 'autocomplete' => 'off')); ?>

											<span class="input-group-append">
												<label for="essay_upload_file" class="btn btn-primary"><?php echo e(_i('Choose file')); ?></label></span>
											</span>
										</span>
							            <?php echo Form::file('essay_file', array('id' => 'essay_upload_file','class' => 'form-control', 'style' => 'visibility:hidden;height:0;padding:0;')); ?>

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