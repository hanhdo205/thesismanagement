

<?php $__env->startSection('title', '学術管理'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">学術管理</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			学術管理
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-create')): ?>
				<span class="float-right">
					<a class="btn btn-sm btn-primary" href="<?php echo e(route('topics.create')); ?>"> 新規作成</a>
				</span>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<div class="card-text">
				<?php if($message = Session::get('success')): ?>
				    <div class="alert alert-success">
				        <p><?php echo e($message); ?></p>
				    </div>
				<?php endif; ?>
				<div class="table-scroll">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="fix-width">No.</th>
								<th>タイトル</th>
								<th>応募期間</th>
								<th>ステータス</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
					    	<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    	<?php
					    		$period = $topic->start_date . ' ~ ' . $topic->end_date;
				    		?>
					    	<tr>
					        <td><?php echo e(++$i); ?></td>
					        <td><?php echo e($topic->title); ?></td>
					        <td><?php echo e($period); ?></td>
					        <td><?php echo e($topic->status); ?></td>
					        <td>
				                <form action="<?php echo e(route('topics.destroy',$topic->id)); ?>" method="POST">
				                    <a class="btn btn-info" href="<?php echo e(route('topics.show',$topic->id)); ?>">Show</a>
				                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-edit')): ?>
				                    <a class="btn btn-primary" href="<?php echo e(route('topics.edit',$topic->id)); ?>">Edit</a>
				                    <?php endif; ?>


				                    <?php echo csrf_field(); ?>
				                    <?php echo method_field('DELETE'); ?>
				                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-delete')): ?>
				                    <button type="submit" class="btn btn-danger">Delete</button>
				                    <?php endif; ?>
				                </form>
					        </td>
					    </tr>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    	</tbody>
			    	</table>
			    </div>
				<?php echo $topics->links(); ?>

			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>