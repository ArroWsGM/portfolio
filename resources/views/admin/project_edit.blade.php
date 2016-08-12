@eval( $pid = isset($project->id) ? $project->id : '' )
@extends('admin._main')

@section('page_content')
	@unless(empty($pid))
	<div class="row">
		<div class="col-sm-12 text-right">
			<a href="{{route('projects.create')}}" class="btn btn-info">
				Add New Project
			</a>
		</div>
	</div>
	@endunless
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>{{ $page_title or 'Project'}}</h2>
		</div>
	</div>
	<form id="project-edit-form" class="form form-horizontal" action="{{ $pid ? route('projects.update', $pid) : route('projects.store') }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		@if($pid)
		{{method_field('PUT')}}
		@endif
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group{{$errors->has('project_name') ? ' has-error' : ''}}">
					<div class="col-sm-12">
						<h4>Name</h4>
						@eval( $edit_project_name = isset($project->project_name) ? $project->project_name : '' )
						<input type="text" name="project_name" class="form-control" value="{{old('project_name', $edit_project_name)}}">
						@if($errors->has('project_name'))
							@foreach($errors->get('project_name') as $message)
							<span class="help-block">{{$message}}</span>
							@endforeach
						@endif
					</div>
				</div>
				<div class="col-sm-12">
					@eval( $edit_project_slug = isset($project->project_slug) ? $project->project_slug : '' )
					<div class="form-group{{$errors->has('project_slug') ? ' has-error' : ''}}">
						<h4>Slug</h4>
						<input type="text" name="project_slug" class="form-control" value="{{old('project_slug', $edit_project_slug)}}">
						@if($errors->has('project_slug'))
							@foreach($errors->get('project_slug') as $message)
							<span class="help-block">{{$message}}</span>
							@endforeach
						@endif
					</div>
				</div>
				<div class="form-group{{$errors->has('project_link') ? ' has-error' : ''}}">
					<div class="col-sm-12">
						<h4>Link</h4>
						@eval( $edit_project_link = isset($project->project_link) ? $project->project_link : '' )
						<input type="text" name="project_link" class="form-control" value="{{old('project_link', $edit_project_link)}}">
						@if($errors->has('project_link'))
							@foreach($errors->get('project_link') as $message)
							<span class="help-block">{{$message}}</span>
							@endforeach
						@endif
					</div>
				</div>
				@if(!empty($pid))
				<div class="row">
					<div class="col-sm-12">
						<h4>Views (Total/Unique): 
							<span class="label label-info">
								{{$project->views->count()}}
							/
								{{$project->views->groupBy('ip')->count()}}
							</span>
						</h4>
					</div>
				</div>
				@endif
			</div>
			<div class="col-sm-7">
				<div class="form-group{{$errors->has('project_description') ? ' has-error' : ''}}">
					<h4>Description</h4>
					@eval( $edit_project_description = isset($project->project_description) ? $project->project_description : '' )
					<textarea name="project_description" rows="10" class="form-control tinymce-field">{{old('project_description', $edit_project_description)}}</textarea>
					@if($errors->has('project_description'))
						@foreach($errors->get('project_description') as $message)
						<span class="help-block">{{$message}}</span>
						@endforeach
					@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div id="ajax-response" class="col-sm-12">
				
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h2>Properties</h2>
			</div>
		</div>
		@if(isset($project->properties) && $project->properties->count())
		<div class="row project-properties">
			<div class="col-sm-2">
				<h4>Devices</h4>
				<ul class="list-inline properties-list deletable">
					@forelse($project->properties->where('property.property_group', 'device') as $property)
					<li class="text-center property-remove" data-url="{{route('projects.property.destroy', $property->id)}}" data-property_id="{{$property->property->id}}">
						<p><span class="{{$property->property->property_class}}"></span></p>
						<p>{{$property->property->property_name}}</p>
					</li>
					@empty
					<li>No properies</li>
					@endforelse
				</ul>
			</div>
			<div class="col-sm-3">
				<h4>Browser</h4>
				<ul class="list-inline properties-list deletable">
					@forelse($project->properties->where('property.property_group', 'browser') as $property)
					<li class="text-center property-remove" data-url="{{route('projects.property.destroy', $property->id)}}" data-property_id="{{$property->property->id}}">
						<p><span class="{{$property->property->property_class}}"></span></p>
						<p>{{$property->property->property_name}}</p>
					</li>
					@empty
					<li>No properies</li>
					@endforelse
				</ul>
			</div>
			<div class="col-sm-3">
				<h4>Tech</h4>
				<ul class="list-inline properties-list deletable">
					@forelse($project->properties->where('property.property_group', 'technology') as $property)
					<li class="text-center property-remove" data-url="{{route('projects.property.destroy', $property->id)}}" data-property_id="{{$property->property->id}}">
						<p><span class="{{$property->property->property_class}}"></span></p>
						<p>{{$property->property->property_name}}</p>
					</li>
					@empty
					<li>No properies</li>
					@endforelse
				</ul>
			</div>
		</div>
		@else
		<div class="row">
			<div class="col-sm-12">
				<h4>No Properties</h4>
			</div>
		</div>
		@endif
		<div class="row mbot-15">
			<div class="col-sm-12">
				<h3>Properties to add:</h3>
				<ul id="properties-toadd" class="list-inline">
				</ul>
				<input type="hidden" name="properties_toadd">
			</div>
		</div>
		<div class="row mbot-15">
			<div class="col-sm-12">
				<h3>Add Property</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul class="list-inline properties-list all-properties-list">
					@forelse($all_properties as $all_property)
					<li class="text-center property-add" data-id="{{$all_property->id}}">
						<p><span class="{{$all_property->property_class}}"></span></p>
						<p>{{$all_property->property_name}}</p>
					</li>
					@empty
					<li>
						Add properties <a href="{{url('/admin/properties')}}">here.</a>
					</li>
					@endforelse
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<h2>Gallery</h2>
			</div>
		</div>
		@if(isset($project->galleries) && $project->galleries->count())
		<div id="gallery" class="row mbot-15">
			@foreach($project->galleries as $item)
				@if(!empty($item->item_url) || !empty($item->item_embed))
				<div class="col-sm-3 gallery-item">
					@eval($path = isset($all_settings['upload_dir']) ? $all_settings['upload_dir'] : 'upload/')
					@eval($path .= $project->project_slug . '/')
					@if($item->item_type == 'img' && !empty($item->item_url))
					<img src="{{url($path.getImageSizeName($item->item_url, 'small'))}}" alt="" class="img-responsive">
					@elseif($item->item_type == 'video_embed' && !empty($item->item_embed))
					<div class="embed-responsive embed-responsive-16by9">
						{!!$item->item_embed!!}
					</div>
					@elseif($item->item_type == 'video' && !empty($item->item_url))
					<div class="video embed-responsive embed-responsive-16by9">
						<video class="embed-responsive-item" controls="">
							<source src="{{url($path.$item->item_url)}}" type="video/mp4">
						</video>
					</div>
					@endif
					<button type="button" class="btn btn-danger btn-delete" data-url="{{route('projects.gallery.destroy', $item->id)}}"><span aria-hidden="true">&times;</span></button>
				</div>
				@endif
			@endforeach
		</div>
		@else
		<div class="row">
			<div class="col-sm-12">
				<h4>No items</h4>
			</div>
		</div>
		@endif
		<div class="row mbot-15">
			<div class="col-sm-12">
				<h3>Add to gallery</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label for="item_type" class="col-sm-3 control-label">Type</label>
					<div class="col-sm-9">
						<select name="item_type" class="form-control">
							@if(old('item_type') == 'img')
							<option value="img" selected>Image</option>
							@else
							<option value="img">Image</option>
							@endif
							@if(old('item_type') == 'video')
							<option value="video" selected>Upload Video</option>
							@else
							<option value="video">Upload Video</option>
							@endif
							@if(old('item_type') == 'video_embed')
							<option value="video_embed" selected>Video embed code</option>
							@else
							<option value="video_embed">Video embed code</option>
							@endif
						</select>
					</div>
				</div>
			</div>
			<div id="item-url" class="col-sm-6">
				<div class="form-group{{$errors->has('item_url') ? ' has-error' : ''}}">
					<label for="item_url" class="col-sm-3 control-label">Select file</label>
					<div class="col-sm-9">
						<input type="file" name="item_url" class="form-control">
						@if($errors->has('item_url'))
							@foreach($errors->get('item_url') as $message)
							<span class="help-block">{{$message}}</span>
							@endforeach
						@endif
					</div>
				</div>
				<div id="item-alt" class="form-group mtop-15{{$errors->has('item_alt') ? ' has-error' : ''}}">
					<label for="item_alt" class="col-sm-3 control-label">Alt attribute</label>
					<div class="col-sm-9">
						<input type="text" name="item_alt" class="form-control" value="{{old('item_alt')}}">
						@if($errors->has('item_alt'))
							@foreach($errors->get('item_alt') as $message)
							<span class="help-block">{{$message}}</span>
							@endforeach
						@endif
					</div>
				</div>
			</div>
			<div id="item-embed" class="col-sm-6">
				<div class="form-group">
					<label for="item_embed" class="col-sm-3 control-label">Embed Code</label>
					<div class="col-sm-9">
						<input type="text" name="item_embed" class="form-control" value="{{old('item_embed')}}">
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop-15 mbot-15">
			<div class="col-sm-12">
				<div class="text-right">
					<button type="submit" class="btn btn-default">Ok</button>
				</div>
			</div>
		</div>
	</form>
@stop