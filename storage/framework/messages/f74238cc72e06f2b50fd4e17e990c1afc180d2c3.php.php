

<?php $__env->startSection('title', '査読依頼'); ?>
<?php $__env->startSection('description', 'The SIS management'); ?>
<?php $__env->startSection('keyword', 'management'); ?>

<?php $__env->startSection('content'); ?>
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">査読依頼</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					査読依頼
				</div>
				<div class="card-body">
					<div>以下の演題に対して査読依頼を実施しますか？</div>
					<div>問題ない場合は、査読依頼ボタンを押してください。</div>
					<div class="mb-3">査読依頼を先生へとメールで依頼します。</div>
							<?php echo Form::open(array('route' => 'review.sendmail','method'=>'POST')); ?>

							<?php echo Form::hidden('topic_id', $topic_id); ?>

							<?php echo Form::hidden('essays', $essay_lst); ?>

								<div class="form-group">
									<?php echo Form::textarea('mailbody', $textarea, array('id' => 'mailcontent','class' => 'form-control','rows' => '10')); ?>

								</div>
								<div class="d-flex justify-content-end">
									<?php echo Form::submit(_i('Send review request'), array('class' => 'btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-4')); ?>

								</div>
							<?php echo Form::close(); ?>


				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PAGE INNER  -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>