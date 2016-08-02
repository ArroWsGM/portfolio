
@extends('front._main')

@section('page_content')
<div id="_token" class="hidden" data-token="{{csrf_token()}}"></div>
<section id="carousel" class="content">
	<div class="carousel row">
		<div class="carousel-wrapper">
			@forelse($projects as $project)
			<?php
				$path = isset($all_settings['upload_directory']) ? $all_settings['upload_directory'] : 'upload/';
				$path .= $project->project_slug . '/';
				$url = $project->galleries->count() ? $path . $project->galleries->first()['item_url'] : false;

				if ($url)
					$url = getImageSizeName($url, 'thumb');
				else
					$url = $all_settings['img_placeholder'];
			?>
			<div class="carousel-item" data-url="{{url('/get/' . $project->id)}}">
				<img src="{{url($url)}}" alt="{{$project->project_name}}">
				<div class="project-title">
					<h3>{{$project->project_name}}</h3>
				</div>
			</div>
			@empty
			<div class="carousel-item"><img src="{{url($all_settings['img_placeholder'])}}" alt="Project #1" data-id="0"></div>
			@endforelse
		</div>
		<div class="control prev"><span class="glyphicon glyphicon-chevron-left"></span></div>
		<div class="control next"><span class="glyphicon glyphicon-chevron-right"></span></div>
	</div>
</section>
@stop