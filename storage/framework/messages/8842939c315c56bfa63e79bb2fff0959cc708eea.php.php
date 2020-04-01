<nav class="sidebar" role="navigation">
	<div class="collapse sidebar-collapse" id="navbarSupportedContent">
		<ul class="nav navbar-nav" id="main-menu">
			<li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">
				<a href="<?php echo e(url('/')); ?>" ><i class="fa fa-home "></i>HOME</a>
			</li>
			<li class="<?php echo e(request()->is('topics') ? 'active' : ''); ?>">
				<a href="<?php echo e(route('topics.index')); ?>"><i class="fa fa-clipboard "></i>学術大会管理</a>
			</li>
			<li class="<?php echo e(request()->is('abstract') || request()->is('review/request') ? 'active' : ''); ?>">
				<a href="/abstract"><i class="fa fa-clipboard "></i>演題管理</a>
			</li>
			<li>
				<a href="<?php echo e(route('users.index')); ?>"><i class="fa fa-clipboard"></i>演題提出者管理</a>
			</li>
			<li class="<?php echo e(request()->is('review') ||  request()->is('review/confirmation') ||  request()->is('review/detail') ? 'active' : ''); ?>">
				<a href="/review"><i class="fa fa-clipboard"></i>査読者管理</a>
			</li>
		</ul>
	</div>
</nav>