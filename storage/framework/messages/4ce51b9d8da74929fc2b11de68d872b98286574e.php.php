

<?php $__env->startSection('title',  $topic->title  ); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startSection('content'); ?>
<?php
	$student_name_err = $student_dob_err = $student_email_err = $essay_belong_err = $essay_major_err = $essay_title_err = $essay_file_err = $disabled = '';
	$readonly = 'readonly';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(_i('Registration form for essay writing competetion')); ?></div>

                <div class="card-body">
                    <div class="card-text">
						<div class="row">
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong><?php echo e(_i('Title')); ?>:
						            <?php echo e($topic->title); ?></strong>
						        </div>
						    </div>
						    <div class="col-xs-12 col-sm-12 col-md-12">
						        <div class="form-group">
						            <strong><?php echo e(_i('Period')); ?>:
						            <?php
						            $from = Carbon\Carbon::createFromDate($topic->start_date)->format('Y年m月d日');
									$to = Carbon\Carbon::createFromDate($topic->end_date)->format('Y年m月d日');
						            ?>
						            <?php echo e($from . ' ～ ' . $to); ?> 【<?php echo e($status); ?>】</strong>
						        </div>
						    </div>
						</div>
						<?php if($message = Session::get('success')): ?>
							<div class="alert alert-success" role="alert">
							   <?php echo e($message); ?>

							</div>
						<?php endif; ?>
						<?php if(count($errors) > 0): ?>
							<?php if($errors->first('student_name')): ?>
							    <?php
							    	$student_name_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('student_dob')): ?>
							    <?php
							    	$student_dob_err = ' is-invalid';
							    ?>
							<?php endif; ?>
							<?php if($errors->first('student_email')): ?>
							    <?php
							    	$student_email_err = ' is-invalid';
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
							<?php if($errors->first('essay_file')): ?>
							    <?php
							    	$essay_file_err = ' is-invalid';
							    ?>
							<?php endif; ?>
				  <div class="alert alert-danger alert-dismissible fade show" role="alert">
				    <?php echo e(_i('There were some problems with your input.')); ?>

				    <button class="close hide_error" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				  </div>
						<?php endif; ?>
						<?php echo Form::open(['id' => 'register_essay','route' => 'register.endai_teisyutu','method'=>'POST', 'enctype'=>'multipart/form-data','novalidate']); ?>

						<?php if($status != _i(AVAILABLE)): ?>
							<fieldset disabled="disabled">
								<?php
									$readonly = '';
									$disabled = 'disabled';
								?>
						<?php endif; ?>
						<?php echo Form::hidden('topic_id', $topic->id); ?>

							<fieldset class="form-border">
								<legend class="form-border"><?php echo e(_i('Student info')); ?></legend>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="row">
									    <div class="col-md-6">
									        <div class="form-group required">
									            <label class='control-label'><strong><?php echo e(_i('Full name')); ?></strong></label>
									            <?php echo Form::text('student_name', null, ['placeholder' => _i('Full name'),'required' => 'required','class' => 'form-control' . $student_name_err]); ?>

									            <span class="invalid-feedback"><?php echo e($errors->first('student_name')); ?></span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group required">
									            <label class='control-label'><strong><?php echo e(_i('Gender')); ?></strong></label>
									            <div class="form-group mt-2">
										            <?php echo Form::radio('student_gender', 'male' , true,  ['id'=>'male']); ?>

													<?php echo Form::label('male', _i('Male')); ?>

										            <?php echo Form::radio('student_gender', 'female' , false,  ['id'=>'female']); ?>

													<?php echo Form::label('female', _i('Female')); ?>

										        </div>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group required">
									            <label class='control-label'><strong><?php echo e(_i('Date of birth')); ?></strong></label>
									            <?php echo Form::text('student_dob', null, ['placeholder' => _i('Date of birth'),'required' => 'required','id' => 'dateOfBirth','class' => 'form-control' . $student_dob_err,'autocomplete' => 'off']); ?>

									            <span class="invalid-feedback"><?php echo e($errors->first('student_dob')); ?></span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group required">
									            <label class='control-label'><strong><?php echo e(_i('Email address')); ?></strong></label>
									            <?php echo Form::email('student_email', null, ['placeholder' => _i('Email address'),'required' => 'required','id' => 'emailAddress','class' => 'form-control' . $student_email_err,'autocomplete' => 'off']); ?>

									            <span class="invalid-feedback"><?php echo e($errors->first('student_email')); ?></span>
									        </div>
									    </div>
								    </div>
							    </div>
						    </fieldset>

				    		<fieldset class="form-border">
								<legend class="form-border"><?php echo e(_i('Essay info')); ?></legend>
							    <div class="col-xs-12 col-sm-12 col-md-12">
							    	<div class="row">
									    <div class="col-md-6">
									        <div class="form-group required">
									            <label class='control-label'><strong><?php echo e(_i('Belong to')); ?></strong></label>
									            <?php echo Form::text('essay_belong', null, array('placeholder' => _i('Belong to'),'required' => 'required','class' => 'form-control' . $essay_belong_err)); ?>

									            <span class="invalid-feedback"><?php echo e($errors->first('essay_belong')); ?></span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group required">
									            <label class='control-label'><strong><?php echo e(_i('Major')); ?></strong></label>
									            <?php echo Form::text('essay_major', null, ['placeholder' => _i('Major'),'required' => 'required','class' => 'form-control' . $essay_major_err]); ?>

									            <span class="invalid-feedback"><?php echo e($errors->first('essay_major')); ?></span>
									        </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-group required">
									            <label class='control-label'><strong><?php echo e(_i('Title')); ?></strong></label>
									            <?php echo Form::text('essay_title', null, ['placeholder' => _i('Title'),'required' => 'required','class' => 'form-control' . $essay_title_err]); ?>

									            <span class="invalid-feedback"><?php echo e($errors->first('essay_title')); ?></span>
									        </div>
									    </div>
									    <div class="col-md-6">
											<div class="form-group required">
												<label class='control-label'><strong><?php echo e(_i('Upload')); ?></strong></label>
												<span class="input-group div-select-csv-file<?php echo e($essay_file_err); ?>">
													<?php echo Form::text('essay_file_name_txt',null,['required' => 'required','class' => 'essay_file_name_txt input full upload form-control' . $essay_file_err, 'placeholder' => _i('No file chosen'), 'autocomplete' => 'off',$readonly]); ?>

													<span class="input-group-append">
														<label for="essay_upload_file" class="btn btn-primary" <?php echo e($disabled); ?>><i class="fa fa-folder-open-o" aria-hidden="true"></i></label>
													</span>
												</span>
												<span class="invalid-feedback"><?php echo e($errors->first('essay_file')); ?></span>
												<?php echo Form::file('essay_file', ['id' => 'essay_upload_file','class' => 'form-control', 'style' => 'visibility:hidden;height:0;padding:0;']); ?>

												<small class="help-block"> <?php echo _i('※Data format %s<br>※Maximum upload file size: %s', [ '.doc, .docx, .pdf','2MB']); ?></small>
											</div>
								        </div>
							        </div>
						        </div>
						    </fieldset>
							<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						    	<?php echo Form::submit(_i('Register Essay'), ['class' => 'btn btn-primary pl-5 pr-5 mt-3']); ?>

						    </div>
						    <?php if($status != _i(AVAILABLE)): ?>
							</fieldset>
							<?php endif; ?>
						<?php echo Form::close(); ?>

					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guess', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>