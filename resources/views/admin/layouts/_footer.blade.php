	</div>{{-- /.sticky-footer-wraper @_header --}}

	<footer class="sticky-footer">
		<div class="container-fluid">
			<p class="text-right"><span class="text-red">{{ $cms_about->cms_name or 'Valery CMS' }} {{ $cms_about->cms_version or '0.0' }}{!! isset($cms_about->cms_build) ? ' (<span id="cms-build">"' . $cms_about->cms_build . '"</span>)' : '' !!}</span> powered by&nbsp;&nbsp;<a class="text-brand" href="{{isset($all_settings['powered_by_link']) ? url($all_settings['powered_by_link']) : '#'}}" target="_blank"><span class="arricon arricon-laravel arricon-beat"></span></a></p>
			<p class="text-right"><i class="fa fa-html5" data-toggle="tooltip" data-placement="top" title="HTML5"></i> <i class="fa fa-css3" data-toggle="tooltip" data-placement="top" title="CSS3"></i> <span class="arricon arricon-less" data-toggle="tooltip" data-placement="top" title="{less}"></span> <span class="arricon arricon-twbs" data-toggle="tooltip" data-placement="top" title="Bootstrap"></span> <span class="arricon arricon-jq" data-toggle="tooltip" data-placement="top" title="jQuery"></span> <span class="arricon arricon-njs"></span> <span class="arricon arricon-php"></span> <span class="arricon arricon-ajs"></span> <span class="arricon arricon-mysql"></span></p>
		</div>
		@yield('page_footer')
	</footer>

{{-- jQuery (потрібно для JavaScript плагінів Bootstrap) --}}
<script src="/js/jquery.min.js"></script>
{{-- Підключення мінімізованої збірки всіх плагінів jQuery. Можна підключати додаткові плагіни, якщо потрібно --}}
<script src="/js/bootstrap.min.js"></script>
@if(isset($tinymce) && $tinymce)
<script src="/js/tinymce/tinymce.min.js"></script>
<script src="/js/tinymce/jquery.tinymce.min.js"></script>
@endif
{{-- Підключення додаткового файлу script.js --}}
<script src="/js/script_admin.js"></script>
<!-- Modals -->
@if(isset($cms_about->cms_promo))
	<div class="modal" id="cms-build-modal" tabindex="-1" role="dialog" aria-labelledby="cms-build-modal-label">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="cms-build-modal-label">{{$cms_about->cms_build or ''}}</h4>
				</div>
				<div class="modal-body">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item"></iframe>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		var modalSRC = '{!! $cms_about->cms_promo !!}?autoplay=1',
			ctrlPressed = false;

		$(document).keydown(function(e){
			e = e || window.event;
			if(e.which=="17") ctrlPressed = true;
		});
		$(document).keyup(function(){
			ctrlPressed = false;
		});

		$('#cms-build').click(function () {
			if(ctrlPressed){			
				$('#cms-build-modal').modal('show');
				$('#cms-build-modal iframe').attr('src', modalSRC);
			} else {
				return false;
			}
		});

		$('#cms-build-modal button').click(function () {
			$('#cms-build-modal iframe').removeAttr('src');
		});
	</script>
@endif
@if(isset($user_edit_modal))
	<div class="modal" id="user-edit-modal" tabindex="-1" role="dialog" aria-labelledby="user-edit-modal-label">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="user-edit-modal-label">Edit user</h4>
				</div>
				<div class="modal-body">
					<form id="user-edit-form" role="form" method="POST" action="{{ url('/admin/users/update') }}">
						<input type="hidden" name="id">
						<div class="form-group user-name">
							<input class="form-control" type="text" name="name" placeholder="Name">
						</div>
						<div class="form-group user-email">
							<input class="form-control" type="text" name="email" placeholder="Email (unique)">
						</div>
						<div class="form-group user-password">
							<input class="form-control" type="text" name="password" placeholder="Password">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-update-user pull-left" data-token="{{csrf_token()}}">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endif
@if(isset($property_edit_modal))
	<div class="modal" id="property-edit-modal" tabindex="-1" role="dialog" aria-labelledby="property-edit-modal-label">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="property-edit-modal-label">Edit user</h4>
				</div>
				<div class="modal-body">
					<form id="property-edit-form" role="form" method="POST" action="">
						{{ method_field('PUT') }}
						<input type="hidden" name="id">
						<div class="form-group property-name">
							<input class="form-control" type="text" name="property_name" placeholder="Name">
						</div>
						<div class="form-group property-class">
							<input class="form-control" type="text" name="property_class" placeholder="Class">
						</div>
						<div class="form-group property-group">
							<select class="form-control" name="property_group" id="property-group">
								<option value="device">Device</option>
								<option value="technology">Technology</option>
								<option value="browser">Browser</option>
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-update-property pull-left" data-token="{{csrf_token()}}">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endif
<!-- Debug -->
	<div class="modal" id="debug-modal" tabindex="-1" role="dialog" aria-labelledby="debug-modal-label">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="debug-modal-label">Debug</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							@if(Auth::user() && Auth::user()->email != 'demo@demo.demo')
							<pre>{{var_dump($all_settings)}}</pre>
							<pre>{{var_dump($errors)}}</pre>
							@else
							<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You do not have permission to do this</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="loadanimation"><div class="spinner text-red"><i class="fa fa-gear fa-spin"></i></div></div>
@yield('scripts')
</body>
</html>