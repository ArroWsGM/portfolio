@extends('admin._main')

@section('page_content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>About CMS</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-sm-offset-3 text-right">
			Name
		</div>
		<div class="col-sm-4 col-md-3">
			{{$cms_about->cms_name}}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-sm-offset-3 text-right">
			Version
		</div>
		<div class="col-sm-4 col-md-3">
			{{$cms_about->cms_version}}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-sm-offset-3 text-right">
			Build name
		</div>
		<div class="col-sm-4 col-md-3">
			{{$cms_about->cms_build}}
		</div>
	</div>
	@if(Auth::user() && Auth::user()->email != 'demo@demo.demo')
	<div class="row mtop-15">
		<div class="col-sm-12 phpinfo-wrapper text-center">
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#phpinfo-collapse" aria-expanded="false">
				PHP Info
			</button>
			<div class="collapse" id="phpinfo-collapse">
				<div class="well mtop-15">
					{!! $phpinfo !!}
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
@stop