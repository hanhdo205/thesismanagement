<nav class="sidebar" role="navigation">
	<div class="collapse sidebar-collapse" id="navbarSupportedContent">
		<ul class="nav navbar-nav" id="main-menu">
			<li class="{{ request()->is('/') ? 'active' : '' }}">
				<a href="{{ url('/') }}" ><i class="fa fa-home "></i>{{ _i('HOME') }}</a>
			</li>
			@if($user->hasRole('Admin'))
			<li class="{{ request()->is('topics') ? 'active' : '' }}">
				<a href="{{ route('topics.index') }}"><i class="fa fa-clipboard "></i>{{ _i('Topic list') }}</a>
			</li>

			<li class="{{ request()->is('essays') || request()->is('essays/request') ? 'active' : '' }}">
				<a href="{{ route('essays.index') }}"><i class="fa fa-clipboard "></i>{{ _i('Essays list') }}</a>
			</li>

			<li class="{{ request()->is('submiter') ? 'active' : '' }}">
				<a href="{{ route('essays.submiter') }}"><i class="fa fa-clipboard"></i>{{ _i('Student list') }}</a>
			</li>

			<li class="{{ request()->is('opponents') ||  request()->is('review/confirmation') ||  request()->is('review/detail') ? 'active' : '' }}">
				<a href="{{ route('opponents.index') }}"><i class="fa fa-clipboard"></i>{{ _i('Opponent list') }}</a>
			</li>
			@endif
		</ul>
	</div>
</nav>