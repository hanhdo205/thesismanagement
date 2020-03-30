<div class="navbar navbar-custom navbar-expand-lg navbar-light d-flex justify-content-between">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="brand-bg">
		<div class="align-middle text-center aligner">
			<a class="aligner-item navbar-brand" href="{{ url('/') }}">査読管理システム</a>
		</div>
	</div>
	<div class="inline my-2 my-lg-0">
		<div class="btn-group">
			<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			My account
			</button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="#">My profile</a>
				<a class="dropdown-item" href="{{ route('roles.index') }}">Manage Role</a>
				<div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			</div>
		</div>
	</div>
</div>