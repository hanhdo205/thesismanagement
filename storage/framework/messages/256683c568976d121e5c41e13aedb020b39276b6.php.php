

<?php $__env->startSection('title', _i('Essays management')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

<?php $__env->startPush('head'); ?>
<!-- Datatable -->
<link  href="<?php echo e(asset('css/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('css/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Essays management')); ?></li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			<?php echo e(_i('Essays management')); ?>

		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if($message = Session::get('success')): ?>
					<script>
						toastr.success('<?php echo e($message); ?>');
					</script>
					<?php
						$last_topic_id = Session::get('topic_id');
					?>
				<?php endif; ?>
				<?php echo Form::open(array('id' => 'reviewRequest','route' => 'review.request','method'=>'POST')); ?>

				<div class="form-group">
					<div class="form-inline">
						<?php echo Form::select('topic', $topics,$last_topic_id, array('id' => 'topic_select','class' => 'field form-control','placeholder' => _i('Please select topic'))); ?>

					</div>
				</div>
				<div class="form-group">
					<label><?php echo e(_i('Submit form URL')); ?>： <a href="<?php echo e(route('topic.endai_teisyutu', ['id' => $last_topic_id])); ?>" id="topic_url"><?php echo e(route('topic.endai_teisyutu', ['id' => $last_topic_id])); ?></a></label>
				</div>
				<div class="form-group">
					<div class="form-inline custom-inline">
						<div class="alert alert-secondary" role="alert">
							<div class="form-inline">
								<?php echo Form::text('student_name', null, array('id' => 'student_name','class' => 'form-control mt-1 mb-1 mr-sm-2','placeholder' => _i('Enter student name'))); ?>


								<?php echo Form::select('review_result', ['not_yet'=>_i('None'),'good'=>_i('Good'),'bad'=>_i('Not good')],null, array('id' => 'review_result','class' => 'form-control mb-1 mt-1 mr-sm-2','placeholder' => _i('Review result'))); ?>


								<?php echo Form::button(_i('Search'), array('id' => 'searchBtn','class' => 'form-control btn btn-primary pl-5 pr-5 mt-1 mb-1')); ?>

							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-inline">
						<?php echo Form::select('select', ['mail'=>_i('Review request'),'csv'=>_i('CSV Download')],null, array('id' => 'requestSelect','class' => 'form-control mr-sm-2 mb-2','placeholder' => _i('Please select...'))); ?>

						<?php echo Form::button(_i('Send'), array('id' => 'selectBtn','class' => 'form-control btn btn-primary pl-5 pr-5 mb-2')); ?>

					</div>
				</div>
				<div class="table-scroll">
					<table class="table table-striped table-bordered data-table table-hover table-with-checkbox" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="selectAll" />
										<span class="checkmark"></span>
									</label>
								</th>
								<th class="fix-width">No.</th>
								<th><?php echo e(_i('Title')); ?></th>
								<th><?php echo e(_i('Student name')); ?></th>
								<th><?php echo e(_i('Status')); ?></th>
								<th><?php echo e(_i('Review result')); ?></th>
								<th><?php echo e(_i('Date create')); ?></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<?php echo Form::close(); ?>

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
	var essays = {index:'<?php echo e(route("essays.index")); ?>',export:'<?php echo e(route("essays.export")); ?>'};
	var last_topic_id = '<?php echo e($last_topic_id); ?>';
</script>
<script src="<?php echo e(asset('js/essays-index.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>