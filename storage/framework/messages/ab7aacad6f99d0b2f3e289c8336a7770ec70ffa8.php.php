

<?php $__env->startSection('title', _i('Topic management')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Datatable -->
<link  href="<?php echo e(asset('css/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('css/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet">
<!-- Datepicker styles-->
<link href="<?php echo e(asset('css/jquery-ui.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/"><?php echo e(_i('Home')); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Topic management')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Topic management')); ?>

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-create')): ?>
				<span class="float-right">
					<a class="btn btn-sm btn-primary" id="createNewTopic" href="javascript:void(0)"> <?php echo e(_i('Add new topic')); ?></a>
				</span>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<div class="card-text">
				<!-- <?php if($message = Session::get('success')): ?>
				    <script>
						toastr.success('<?php echo e($message); ?>');
					</script>
				<?php endif; ?> -->
				<div class="table-scroll">
					<table class="table table-striped table-bordered data-table table-hover table-with-checkbox" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="fix-width"><?php echo e(_i('No.')); ?></th>
								<th><?php echo e(_i('Title')); ?></th>
								<th><?php echo e(_i('Period')); ?></th>
								<th><?php echo e(_i('Status')); ?></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
				    	</tbody>
			    	</table>
			    </div>

			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('foot'); ?>
<!-- Datatable -->
<script src="<?php echo e(asset('js/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables/responsive.bootstrap4.min.js')); ?>"></script>
<!-- Custom script -->
<script type="text/javascript">
	var topics = {index:'<?php echo e(route("topics.index")); ?>',store:'<?php echo e(route("topics.store")); ?>'};
	var translate = {
		save_changes:'<?php echo e(_i("Save Changes")); ?>',
		are_you_sure:'<?php echo e(_i("Are you sure want to delete ?")); ?>',
		sending:'<?php echo e(_i("Sending..")); ?>',
		edit_topic:'<?php echo e(_i("Edit Topic")); ?>',
		new_topic:'<?php echo e(_i("Create New Topic")); ?>',
		save_btn:'<?php echo e(_i("Save")); ?>',
	};
</script>
<script src="<?php echo e(asset('js/topics-index.js')); ?>"></script>

<!-- Datepicker script -->
<script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(asset('js/datepicker-ja.js')); ?>"></script>
<!-- Custom script -->
<script src="<?php echo e(asset('js/datepicker-custom.js')); ?>"></script>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <?php echo Form::open(['id' => 'topicForm','name' => 'topicForm', 'class' => 'form-horizontal','novalidate']); ?>

            <div class="modal-body">

                <?php echo Form::hidden('topic_id', null, ['id' => 'topic_id']); ?>

					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Title')); ?>:</strong>
					            <?php echo Form::text('title', null, ['id' => 'title','class' => 'form-control','placeholder' => _i('Title')]); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_i('Start date')); ?>:</strong>
					            <?php echo Form::text('start_date', null, ['placeholder' => _i('Start date'),'id' => 'startDate','class' => 'form-control','autocomplete' => 'off']); ?>

					        </div>
					    </div>
					    <div class="col-xs-12 col-sm-12 col-md-12">
					        <div class="form-group">
					            <strong><?php echo e(_I('End date')); ?>:</strong>
					            <?php echo Form::text('end_date', null, ['placeholder' => _i('End date'),'id' => 'endDate', 'class' => 'form-control','autocomplete' => 'off']); ?>

					        </div>
					    </div>


					</div>

            </div>
            <div class="modal-footer">
            	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
			    	<?php echo Form::submit(_i('Submit'), ['id' => 'saveBtn','class' => 'btn btn-primary pr-5 pl-5', 'value' => 'create']); ?>

			    </div>
		    </div>
		    <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<div class="modal fade" id="showDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="detailHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong><?php echo e(_i('Title')); ?></strong>
				            <span id="detailTitle"></span>
				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong><?php echo e(_i('Period')); ?></strong>
				            <span id="detailStartDate"></span> ~ <span id="detailEndDate"></span>
				        </div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
				        <div class="form-group">
				            <strong><?php echo e(_i('Registration form for essay writing competetion URL')); ?></strong>
				            <a id="detailUrl" href="" target="_blank"></a>
				        </div>
				    </div>
				</div>
            </div>
        </div>
    </div>
</div>
<!-- Delete confirm-->
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- End Delete confirm -->
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>