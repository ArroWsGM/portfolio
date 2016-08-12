@include('admin.layouts._header')

@yield('nav_before')

@include('admin.layouts._nav-main')

@yield('nav_after')

<div class="container-fluid">
{{-- Flashing messages --}}
	@if(Session::has('msg_success'))
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{!!Session::get('msg_success')!!}
			</div>
		</div>
	</div>
	@elseif(Session::has('msg_error'))
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{!!Session::get('msg_error')!!}
			</div>
		</div>
	</div>
	@endif
{{-- Flashing messages end --}}

	@yield('page_content')
</div>

@include('admin.layouts._footer')