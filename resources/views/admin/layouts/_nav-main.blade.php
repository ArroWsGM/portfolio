<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{url('/')}}">{{$all_settings['sitename'] or 'Site name'}}</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="main-menu-1">
			@if (Auth::check())
			<ul class="nav navbar-nav">
				<li{!! $view_name == 'admin.projects' ? ' class="active"' : '' !!}><a href="{{url('/admin/projects')}}">Projects</a></li>
				<li{!! $view_name == 'admin.project_properties' ? ' class="active"' : '' !!}><a href="{{url('/admin/properties')}}">Properties</a></li>
				<li{!! $view_name == 'admin.messages' ? ' class="active"' : '' !!}><a href="{{url('/admin/messages')}}">Messages</a></li>
				<li{!! $view_name == 'admin.users' ? ' class="active"' : '' !!}><a href="{{url('/admin/users')}}">Users</a></li>
				@if(Auth::user() && Auth::user()->email != 'demo@demo.demo')
				<li{!! $view_name == 'admin.settings' ? ' class="active"' : '' !!}><a href="{{url('/admin/settings')}}">Settings</a></li>
				@endif
			</ul>
			@endif
			<ul class="nav navbar-nav navbar-right">
				<li{!! ($view_name == 'admin.about') ? ' class="active"' : '' !!}><a href="{{ url('/admin/about') }}">About</a></li>
				<li><a href="#" data-toggle="modal" data-target="#debug-modal">Debug</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					@if (Auth::guest())
						Login
					@else
						{{ Auth::user()->name }}
					@endif
					&nbsp;<span class="caret"></span></a>
					<div class="dropdown-menu pall-15">
						@if (Auth::guest())
						<form role="form" method="POST" action="{{ url('/login') }}">
							{{csrf_field()}}
							<div class="form-group">
								<input type="email" name="email" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-default">Submit</button>
							</div>
						</form>
						@else
						<a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
						@endif
					</div>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>