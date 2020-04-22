<div class="navbar navbar-custom navbar-expand-lg navbar-light d-flex justify-content-between">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="brand-bg">
		<div class="align-middle text-center aligner">
			<a class="aligner-item navbar-brand" href="<?php echo e(url('/')); ?>">査読管理システム</a>
		</div>
	</div>
	<div class="inline my-2 my-lg-0">
		<div class="btn-group">
			<span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?php echo e(_i('Welcome, %s',$user->name)); ?>

			</span>
			<div class="dropdown-menu dropdown-menu-right mt-0 mb-0 pt-0 pb-0">
				<div class="dropdown-header text-center"><?php echo e(_i('Account')); ?></div>
				<a class="dropdown-item" href="<?php echo e(route('users.profile')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(_i('My profile')); ?></a>
				<div class="dropdown-divider mb-0 mt-0"></div>
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fa fa-key" aria-hidden="true"></i> <?php echo e(_i('Logout')); ?>

                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
			</div>
		</div>
	</div>
</div>