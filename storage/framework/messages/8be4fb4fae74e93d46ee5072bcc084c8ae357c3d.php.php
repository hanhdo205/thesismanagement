

<?php $__env->startSection('title', _i('Opponent management')); ?>
<?php $__env->startSection('description', _i('The SIS management')); ?>
<?php $__env->startSection('keyword', _i('management')); ?>

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
				<div class="form-group">
					<div class="form-inline">
						<select name="target_academic" class="form-control" id="target_academic">
							<option>対象学術大会を選択してください</option>
							<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option><?php echo e($topic->title); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="form-inline">
						<button class="form-control btn btn-primary mr-sm-2 pl-5 pr-5" data-toggle="modal" data-target="#importUsers"><?php echo e(_i('Import from CSV')); ?></button>
						<a class="form-control btn btn-primary pl-5 pr-5" href="<?php echo e(route('users.create')); ?>">新規追加</a>
					</div>
				</div>
				<?php if($message = Session::get('success')): ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
					  	<?php echo e($message); ?>

					</div>
				<?php endif; ?>
				<div class="table-scroll mb-5">
					<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="selectAll" />
										<span class="checkmark"></span>
									</label>
								</th>
								<th class="fix-width"><?php echo e(_i('No.')); ?></th>
								<th><?php echo e(_i('Name')); ?></th>
								<th><?php echo e(_i('Status')); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="<?php echo e(++$i); ?>" />
										<span class="checkmark"></span>
									</label>
								</td>
								<td class="fix-width"><?php echo e($i); ?></td>
								<td><?php echo e($user->name); ?></td>
								<td></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					<?php echo $data->render(); ?>

				</div>
				<div class="form-group">
					<form action="/review/confirmation" class="d-flex justify-content-center" method="POST">
					<?php echo csrf_field(); ?> <!-- <?php echo e(csrf_field()); ?> -->
					<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-3 pl-5 pr-5">査読対応確認</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
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
        	<form method="POST" id="csv_upload_form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <span class="input-group div-select-csv-file">
                	<input type="text" name="csv_file_name_txt" class="csv_file_name_txt input full upload form-control" placeholder="<?php echo e(_i('No file chosen')); ?>" autocomplete="off" >
					<span class="input-group-append">
						<label for="csv_upload_file" class="btn btn-primary"><?php echo e(_i('Choose file')); ?></label></span>
					</span>
				</span>
				<small class="help-block"> <?php echo _i('※Data format .csv<br>※Maximum upload file size: 2MB'); ?></small>
                <input type="file" name="file" id="csv_upload_file" class="form-control" style="visibility:hidden;height:0;padding:0;">
            </form>
      	</div>
      	<div class="modal-footer">
        <button type="button" id="csv_upload_cancel" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('Cancel')); ?></button>
        <button type="button" id="csv_upload_button" class="btn btn-primary"><?php echo e(_i('Import')); ?></button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>