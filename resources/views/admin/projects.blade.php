@extends('admin._main')

@section('page_content')
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>{{ $page_title or 'Projects'}}</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<a href="{{url('/admin/projects/add/')}}" class="btn btn-info">
				Add New Project
			</a>
		</div>
	</div>
	@if(isset($projects) && $projects->count())
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>
							@if($request->order == 'asc' || $request->order == null)
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'id', 'order' => 'desc'])  }}">#</a>
							@else
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'id', 'order' => 'asc'])  }}">#</a>
							@endif
							@if($request->sort == 'id')
								{!!$request->order == 'asc' ? '<span class="glyphicon glyphicon-triangle-top"></span>' : '<span class="glyphicon glyphicon-triangle-bottom"></span>'!!}
							@endif
						</th>
						<th>
							@if($request->order == 'asc' || $request->order == null)
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'project_name', 'order' => 'desc'])  }}">Name</a>
							@else
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'project_name', 'order' => 'asc'])  }}">Name</a>
							@endif
							@if($request->sort == 'project_name')
								{!!$request->order == 'asc' ? '<span class="glyphicon glyphicon-triangle-top"></span>' : '<span class="glyphicon glyphicon-triangle-bottom"></span>'!!}
							@endif
						</th>
						<th>Link</th>
						<th>Description</th>
						<th class="views text-center">Views<br>
							(
							@if($request->order == 'asc' || $request->order == null)
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'total', 'order' => 'desc'])  }}">Total</a>
							@else
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'total', 'order' => 'asc'])  }}">Total</a>
							@endif
							@if($request->sort == 'total')
								{!!$request->order == 'asc' ? '<span class="glyphicon glyphicon-triangle-top"></span>' : '<span class="glyphicon glyphicon-triangle-bottom"></span>'!!}
							@endif
							/
							@if($request->order == 'asc' || $request->order == null)
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'unique', 'order' => 'desc'])  }}">Unique</a>
							@else
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'unique', 'order' => 'asc'])  }}">Unique</a>
							@endif
							@if($request->sort == 'unique')
								{!!$request->order == 'asc' ? '<span class="glyphicon glyphicon-triangle-top"></span>' : '<span class="glyphicon glyphicon-triangle-bottom"></span>'!!}
							@endif
							)
						</th>
						<th class="date-utc">
							@if($request->order == null && $request->order == null)
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'updated_at', 'order' => 'asc'])  }}">Updated</a>
							<span class="glyphicon glyphicon-triangle-bottom"></span>
							@elseif($request->order == 'asc' || $request->order == null)
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'updated_at', 'order' => 'desc'])  }}">Updated</a>
							@else
							<a href="{{  $request->fullUrlWithQuery(['sort' => 'updated_at', 'order' => 'asc'])  }}">Updated</a>
							@endif
							@if($request->sort == 'updated_at')
								{!!$request->order == 'asc' ? '<span class="glyphicon glyphicon-triangle-top"></span>' : '<span class="glyphicon glyphicon-triangle-bottom"></span>'!!}
							@endif
						</th>
						<th class="action">Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($projects as $key=>$project)

				
					<tr data-id="{{$project->id}}">
						<td>{{($projects->currentPage()-1) * $projects->perPage() + ($key + 1)}}</td>
						<td class="user-name">
							<a href="{{url('admin/projects/edit/' . $project->id)}}">{{$project->project_name}}</a>
						</td>
						<td>
							<a href="{{url($project->project_link)}}" target="_blank">{{parse_url($project->project_link, PHP_URL_HOST)}}</a>
						</td>
						<td>
							@ellip($project->project_description, 200)
						</td>
						<td class="text-center">
							<p class="lead">
								<span class="label label-info">
									{{--$project->views->count()--}}
									{{$project->total}}
								/
									{{--$project->views->groupBy('ip')->count()--}}
									{{$project->unique}}
								</span>
							</p>
						</td>
						<td class="user-updated_at">
							{{$project->updated_at}}
						</td>
						<td>
							<a href="{{url('admin/projects/edit/' . $project->id)}}" class="btn btn-primary">Edit</a>
							<a href="{{url('admin/projects/remove/' . $project->id)}}" class="btn btn-danger">Delete</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<a href="{{url('/admin/projects/add')}}" class="btn btn-info">
				Add New Project
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<?php
				$paginator = $projects;

				if($request->sort)
					$paginator = $projects->appends(['sort' => $request->sort]);
				if($request->order)
					$paginator = $projects->appends(['order' => $request->order]);
			?>
			{{ $paginator->links() }}
		</div>
	</div>
	@endif
@stop