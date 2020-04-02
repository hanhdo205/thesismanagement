<nav class="sidebar" role="navigation">
	<div class="collapse sidebar-collapse" id="navbarSupportedContent">
		<ul class="nav navbar-nav" id="main-menu">
			<li class="{{ request()->is('/') ? 'active' : '' }}">
				<a href="{{ url('/') }}" ><i class="fa fa-home "></i>HOME</a>
			</li>
			@can('topic-list')
			<li class="{{ request()->is('topics') ? 'active' : '' }}">
				<a href="{{ route('topics.index') }}"><i class="fa fa-clipboard "></i>学術大会管理</a>
			</li>
			@endcan
			<li class="{{ request()->is('abstract') || request()->is('review/request') ? 'active' : '' }}">
				<a href="/abstract"><i class="fa fa-clipboard "></i>演題管理</a>
			</li>
			@can('user-list')
			<li>
				<a href="{{ route('users.index') }}"><i class="fa fa-clipboard"></i>演題提出者管理</a>
			</li>
			@endcan
			@can('user-list')
			<li class="{{ request()->is('opponents') ||  request()->is('review/confirmation') ||  request()->is('review/detail') ? 'active' : '' }}">
				<a href="/opponents"><i class="fa fa-clipboard"></i>査読者管理</a>
			</li>
			@endcan
		</ul>
	</div>
</nav>