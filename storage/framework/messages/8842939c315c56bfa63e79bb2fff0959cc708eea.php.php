<nav class="sidebar" role="navigation">
	<div class="collapse sidebar-collapse" id="navbarSupportedContent">
		<ul class="nav navbar-nav" id="main-menu">
			<li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">
				<a href="<?php echo e(url('/')); ?>" ><i class="fa fa-home "></i><?php echo e(_i('HOME')); ?></a>
			</li>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('topic-list')): ?>
			<li class="<?php echo e(request()->is('topics') ? 'active' : ''); ?>">
				<a href="<?php echo e(route('topics.index')); ?>"><i class="fa fa-list-ol "></i><?php echo e(_i('Topic list')); ?></a>
			</li>
			<?php endif; ?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essay-list')): ?>
			<li class="<?php echo e(request()->is('essays') || request()->is('essays/request') ? 'active' : ''); ?>">
				<a href="<?php echo e(route('essays.index')); ?>"><i class="fa fa-list-ol "></i><?php echo e(_i('Essays list')); ?></a>
			</li>
			<?php endif; ?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('submiter-list')): ?>
			<li class="<?php echo e(request()->is('submiter') ? 'active' : ''); ?>">
				<a href="<?php echo e(route('essays.submiter')); ?>"><i class="fa fa-list-ol"></i><?php echo e(_i('Student list')); ?></a>
			</li>
			<?php endif; ?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
			<li class="<?php echo e(request()->is('opponents') ||  request()->is('review/confirmation') ||  request()->is('review/detail') ? 'active' : ''); ?>">
				<a href="<?php echo e(route('opponents.index')); ?>"><i class="fa fa-list-ol"></i><?php echo e(_i('Opponent list')); ?></a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>