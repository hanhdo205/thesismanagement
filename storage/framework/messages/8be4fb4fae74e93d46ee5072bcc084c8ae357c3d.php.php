

<?php $__env->startSection('title', _i('Opponent management')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Datatable -->
<link  href="<?php echo e(asset('css/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('css/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet">
<!-- Select2 styles-->
<link href="<?php echo e(asset('css/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Opponent management')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Opponent management')); ?>

		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if($message = Session::get('success')): ?>
					<script>
						toastr.success('<?php echo e($message); ?>');
					</script>
				<?php endif; ?>
				<?php if(Session::get('topic_id')): ?>
					<?php
						$last_topic_id = Session::get('topic_id');
					?>
				<?php endif; ?>
				<?php echo Form::open(['route' => 'opponents.confirmation','method'=>'POST', 'id' => 'opponentForm' ,'class' => 'opponent_management']); ?>

				<div class="form-group">
					<div class="form-inline">
						<?php echo Form::select('topic', $topics,$last_topic_id, ['id' => 'topic_select','class' => 'field form-control select2','placeholder' => _i('Please select topic')]); ?>

					</div>
				</div>
				<div class="form-group">
					<div id="action-button" class="form-inline">
						<a class="form-control btn btn-primary mr-sm-2 mb-2" href="javascript:void(0);" data-toggle="modal" data-target="#importUsers"><i class="fa fa-upload" aria-hidden="true"></i> <?php echo e(_i('Import from CSV')); ?></a>
						<a class="form-control btn btn-primary mb-2" href="javascript:void(0);" data-toggle="modal" data-target="#newUser"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo e(_i('Add new')); ?></a>
					</div>
				</div>
				<div class="table-scroll mb-5">
					<table class="table table-striped table-bordered data-table table-hover table-with-checkbox" width="100%">
						<thead align="center">
							<tr>
								<th class="fix-width text-center sorting_disabled">
									<label class="custom-check">
										<input type="checkbox" class="selectAll" />
										<span class="checkmark"></span>
									</label>
								</th>
								<th class="fix-width"><?php echo e(_i('No.')); ?></th>
								<th><?php echo e(_i('Opponent name')); ?></th>
								<th><?php echo e(_i('Status')); ?></th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="form-group">
					<div class="d-flex justify-content-center">
						<?php echo Form::button(_i('Go to letter confirm'), ['id' => 'formSubmit','class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-3 col-xl-3','data-toggle'=>'popover', 'data-placement' => 'right', 'data-content'=>_i('All of them were received the emails already!')]); ?>

					</div>
				</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>

<!-- CSV Modal -->
<div class="modal fade" id="importUsers" tabindex="-1" role="dialog" aria-labelledby="importUsers" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importUsersTitle"><?php echo e(_i('Import from CSV')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      	</div>
      	<div class="modal-body">
        	<?php echo Form::open(['id' => 'csv_upload_form','method'=>'POST', 'enctype' => 'multipart/form-data']); ?>

	        	<div class="form-group required">
	                <span class="input-group div-select-csv-file">
	                	<?php echo Form::text('csv_file_name_txt',null,['class' => 'csv_file_name_txt input full upload form-control', 'placeholder' => _i('No file chosen'), 'autocomplete' => 'off']); ?>

						<span class="input-group-append">
							<label for="csv_upload_file" class="btn btn-primary"><i class="fa fa-folder-open-o" aria-hidden="true"></i></label>
						</span>
					</span>
					<span class="invalid-feedback"></span>
					<small class="help-block"> <?php echo _i('※Data format %s<br>※Maximum upload file size: %s<br>※Sample CSV file: %s', [ '.csv','2 MB', $sample ] ); ?></small>
				</div>

				<?php echo Form::file('csv_upload_file', ['id' => 'csv_upload_file','class' => 'form-control', 'style' => 'visibility:hidden;height:0;padding:0;']); ?>

            <?php echo Form::close(); ?>

      	</div>
      	<div class="modal-footer">
        <button type="button" id="csv_upload_cancel" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('Cancel')); ?></button>
        <button type="button" id="csv_upload_button" class="btn btn-primary"><?php echo e(_i('Import')); ?></button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- New User Modal -->
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="importUsers" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importUsersTitle"><?php echo e(_i('Add New Opponent')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      	</div>
      	<div class="modal-body">
        	<?php echo Form::open(['id' => 'new_user_form','method'=>'POST','novalidate']); ?>

				<div class="form-group required">
					<label for="inputName" class="control-label"><strong><?php echo e(_i('Full name')); ?></strong></label>
					<?php echo Form::text('name',null,['id' => 'inputName','class' => 'name input full upload form-control', 'placeholder' => _i('Enter full name'), 'autocomplete' => 'off']); ?>

					<span class="invalid-feedback"><?php echo e(_i('This is a required field')); ?></span>
				</div>
				<div class="form-group required">
					<label for="inputEmail" class="control-label"><strong><?php echo e(_i('Email address')); ?></strong></label>
					<?php echo Form::email('email',null,['id' => 'inputEmail','class' => 'email input full upload form-control', 'placeholder' => _i('Enter email'), 'autocomplete' => 'off']); ?>

					<span class="invalid-feedback"><?php echo e(_i('This is a required field')); ?></span>
				</div>
            <?php echo Form::close(); ?>

      	</div>
      	<div class="modal-footer">
        <button type="button" id="new_opponent_cancel" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('Cancel')); ?></button>
        <button type="button" id="new_opponent_button" class="btn btn-primary"><?php echo e(_i('Create Opponent')); ?></button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- /. PAGE INNER  -->
<?php $__env->startPush('foot'); ?>
<!-- Datatable -->
<script src="<?php echo e(asset('js/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/responsive.bootstrap4.min.js')); ?>"></script>
<!-- Select2 script -->
<script src="<?php echo e(asset('js/select2/select2.min.js')); ?>"></script>
<!-- Custom script -->
<script type="text/javascript">
	var opponents = {index:'<?php echo e(route("opponents.index")); ?>',import_csv:'<?php echo e(url("import_csv")); ?>',create_new:'<?php echo e(url("create-new-opponent")); ?>',check:'<?php echo e(route("opponents.check")); ?>'};
	var translate = {
		opponent_created:'<?php echo e(_i("New opponent added successfully")); ?>',
	};
</script>
<script src="<?php echo e(asset('js/opponents-index.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>