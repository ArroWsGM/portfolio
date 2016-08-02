		</div>{{-- /.container-fluid @_header --}}
	</div>{{-- /.sticky-footer-wraper @_header --}}

	<footer class="sticky-footer">
		<div class="container-fluid">
			<p class="copyright pull-left mtop-15"><span class="text-red">&copy; A-Dev, 2014-{{date("Y")}}</span></p>
			<p class="text-right">{{ $cms_about->cms_name or 'Valery CMS' }} <span class="text-red">{{ $cms_about->cms_version or '0.0' }}{!! isset($cms_about->cms_build) ? ' (<span id="cms-build">"' . $cms_about->cms_build . '"</span>)' : '' !!}</span> powered by&nbsp;&nbsp;<a class="text-brand" href="{{isset($all_settings['powered_by_link']) ? url($all_settings['powered_by_link']) : '#'}}" target="_blank" rel="nofollow"><span class="arricon arricon-laravel arricon-beat"></span></a></p>
			<p class="text-right"><i class="fa fa-html5" data-toggle="tooltip" data-placement="top" title="HTML5"></i> <i class="fa fa-css3" data-toggle="tooltip" data-placement="top" title="CSS3"></i> <span class="arricon arricon-less" data-toggle="tooltip" data-placement="top" title="{less}"></span> <span class="arricon arricon-twbs" data-toggle="tooltip" data-placement="top" title="Bootstrap"></span> <span class="arricon arricon-jq" data-toggle="tooltip" data-placement="top" title="jQuery"></span> <span class="arricon arricon-php" data-toggle="tooltip" data-placement="top" title="PHP"></span> <span class="arricon arricon-mysql" data-toggle="tooltip" data-placement="top" title="MySQL/Maria"></span></p>
		</div>
		@yield('page_footer')
	</footer>

{{-- jQuery (потрібно для JavaScript плагінів Bootstrap) --}}
<script src="/js/jquery.min.js"></script>
{{-- Підключення мінімізованої збірки всіх плагінів jQuery. Можна підключати додаткові плагіни, якщо потрібно --}}
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.inputmask.bundle.js"></script>
{{-- Підключення додаткового файлу script.js --}}
<script src="/js/script.min.js"></script>

{{-- Modals --}}
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
					<button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
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
<div id="project" class="popup"></div>
<div id="contact-popup" class="popup popup-small">
	<div class="container popup-child">
		<header>
			<div class="row">
				<h3 class="col-xs-12 col-sm-6 col-sm-offset-3 main-title text-center">Leave a message</h3>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3">
					<div class="hr-top"></div>
				</div>
			</div>
		</header>
		<div class="row mtop-15">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<form id="message-form" class="form-horizontal form-black" method="POST" action="{{url('/sendmessage')}}">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="subject" class="col-sm-2 control-label">Subject</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="phone" name="phone" placeholder="+380(xx)xxx-xx-xx">
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-12">Message</label>
						<div class="col-sm-12">
							<textarea class="form-control" rows="5" id="message" name="message" placeholder="Message"></textarea>
						</div>
					</div>
					<div class="row mtop-15">
						<div class="col-xs-12 col-sm-6 col-sm-offset-3 alert-holder"></div>
					</div>
					<div class="form-group">
						<div class="col-xs-12 text-center">
							<button type="submit" class="btn btn-transparent">Send</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="close-button text-red" data-target="#contact-popup">
			<span class="glyphicon glyphicon-remove"></span>
		</div>
	</div>
</div>
{{-- Debug --}}
@if(env('APP_DEBUG', 'false') == true)
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
						<pre>{{var_dump($all_settings)}}</pre>
						<pre>{{var_dump(env('APP_DEBUG'))}}</pre>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
{{-- Loading --}}
<div class="loadanimation"><div class="spinner text-red"><i class="fa fa-gear fa-spin"></i></div></div>

@yield('scripts')

</body>
</html>