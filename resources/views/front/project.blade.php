
<div class="container-fluid popup-child">
	<header>
		<div class="row">
			<h2 class="col-xs-12 project-name main-title text-center">{{$project->project_name}}</h2>
		</div>
		<div class="row">
			<div class="hr-top"></div>
		</div>
	</header>
	<div class="row project-description">
		<div id="gallery" class="col-xs-12 col-sm-6 col-md-6 col-lg-offset-2 col-lg-4">
			@eval($galleries = $project->galleries->where('item_type', 'img'))
			@eval($path = isset($all_settings['upload_dir']) ? $all_settings['upload_dir'] : 'upload/')
			@eval($path .= $project->project_slug . '/')
			@forelse($galleries as $index => $gallery)
			<img class="img-responsive img-responsive-100 margin-fix{{ ($index == 0) ? ' active' : ''}}" src="{{url($path . getImageSizeName($gallery['item_url'], 'medium'))}}" alt="{{$gallery['item_alt']}}" data-target="{{url($path . $gallery['item_url'])}}">
			<?php
				if($index == 0)
					$poster = url($path . getImageSizeName($gallery['item_url'], 'medium'));
			?>
			@empty
			<img class="img-responsive img-responsive-100 margin-fix" src="{{$all_settings['img_projectplaceholder']}}" alt="{{$project->project_name}}">
			@endforelse
			@if($galleries->count() > 1)
			<div class="control prev"><span class="glyphicon glyphicon-chevron-left"></span></div>
			<div class="control next"><span class="glyphicon glyphicon-chevron-right"></span></div>
			@endif
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
			@if($project->project_link)
			<div class="project-description-item">
				<p><i class="fa fa-link"></i> <a href="{{$project->project_link}}" rel="nofollow">{{parse_url($project->project_link, PHP_URL_HOST)}}</a></p>
			</div>
			@endif
			@eval($browsers = $project->properties->where('property.property_group', 'browser'))
			@if($browsers->count())
			<div class="project-description-item">
				<p>@lang('app.browsers'):&nbsp;
					@foreach($browsers as $browser)
					<span class="{{$browser->property->property_class}}" data-toggle="tooltip" data-placement="top" title="{{$browser->property->property_name}}"></span>&nbsp;
					@endforeach
				</p>
			</div>
			@endif
			@eval($devices = $project->properties->where('property.property_group', 'device'))
			@if($devices->count())
			<div class="project-description-item">
				<p>
					@foreach($devices as $device)
					<span class="{{$device->property->property_class}}" data-toggle="tooltip" data-placement="top" title="{{$device->property->property_name}}"></span>&nbsp;
					@endforeach
				</p>
			</div>
			@endif
			@eval($technologies = $project->properties->where('property.property_group', 'technology'))
			@if($technologies->count())
				@foreach($technologies as $technology)
				<div class="project-description-item">
					<span class="{{$technology->property->property_class}}"></span>&nbsp;{{$technology->property->property_name}}
				</div>
				@endforeach
			@endif
		</div>
	</div>
	<div class="row project-description">
		<div class="col-xs-12 col-lg-8 col-lg-offset-2">
			@if($project->project_description)
			<div class="project-description-item">
				<p>
					@lang('app.description'):
				</p>
				<p class="small">
					<small>{!! $project->project_description !!}</small>
				</p>
			</div>
			@endif
		</div>
	</div>
	@eval($video = $project->galleries->where('item_type', 'video'))
	@if($video->count())
	@foreach($video as $video)
	<div class="row project-description project-video">
		<div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
			<div class="video embed-responsive embed-responsive-16by9">
				<video id="video-{{$video['id']}}" class="embed-responsive-item" poster="{{$poster or $all_settings['img_videoposter']}}" controls>
					<source src="{{url($path . $video['item_url'])}}" type="video/mp4">
				</video>
				<div class="play">
					<button class="btn btn-danger btn-play" data-target="#video-{{$video['id']}}"><span class="glyphicon glyphicon-play"></span></button>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endif
	@eval($embeds = $project->galleries->where('item_type', 'video_embed'))
	@if($embeds->count())
	@foreach($embeds as $embed)
	<div class="row project-description project-video">
		<div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
			<div class="embed-responsive embed-responsive-16by9">
				{!!$embed['item_embed']!!}
			</div>
		</div>
	</div>
	@endforeach
	@endif
	<div class="close-button text-red" data-target="#project">
		<span class="glyphicon glyphicon-remove"></span>
	</div>
</div>
<script>
$(function(){
	$('[data-toggle="tooltip"]').tooltip()
});
</script>