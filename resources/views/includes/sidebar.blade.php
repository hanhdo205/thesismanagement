<nav class="sidebar" role="navigation">
	<div class="collapse sidebar-collapse" id="navbarSupportedContent">
		<ul class="nav navbar-nav" id="main-menu">
			<li class="{{ request()->is('/') ? 'active' : '' }}">
				<a href="/" ><i class="fa fa-home "></i>HOME</a>
			</li>
			<li class="{{ request()->is('academic') ? 'active' : '' }}">
				<a href="/academic"><i class="fa fa-clipboard "></i>学術大会管理</a>
			</li>
			<li class="{{ request()->is('abstract') ? 'active' : '' }}">
				<a href="/abstract"><i class="fa fa-clipboard "></i>演題管理</a>
			</li>
			<li>
				<a href="#"><i class="fa fa-clipboard"></i>演題提出者管理</a>
			</li>
			<li>
				<a href="#"><i class="fa fa-clipboard"></i>査読者管理</a>
			</li>
		</ul>
	</div>
</nav>