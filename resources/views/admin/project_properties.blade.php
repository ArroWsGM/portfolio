@extends('admin._main')

@section('page_content')
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>{{ $page_title or 'Project properties'}}</h2>
		</div>
	</div>
	@if(isset($properties) && $properties->count())
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Fonticon</th>
						<th>Name</th>
						<th>Class name</th>
						<th>Group</th>
						<th class="action">Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($properties as $key=>$property)
					<tr data-id="{{$property->id}}">
						<td>{{($properties->currentPage()-1) * $properties->perPage() + ($key + 1)}}</td>
						<td class="property-icon"><span class="{{$property->property_class}}"></span></td>
						<td class="property-name">
							{{$property->property_name}}
						</td>
						<td class="property-class">
							{{$property->property_class}}
						</td>
						<td class="property-group text-capitalize">
							{{$property->property_group}}
						</td>
						<td>
							<a href="{{url('admin/properties/edit/' . $property->id)}}" class="btn btn-primary btn-edit btn-editproperty" data-token="{{csrf_token()}}">Edit</a>
							<a href="{{url('admin/properties/remove/' . $property->id)}}" class="btn btn-danger">Delete</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#addproperty-collapse" aria-expanded="{{empty($errors->all()) ? 'false' : 'true'}}">
				Add New Property
			</button>
		</div>
	</div>
	<div class="row collapse{{empty($errors->all()) ? '' : ' in'}}" id="addproperty-collapse" aria-expanded="{{empty($errors->all()) ? 'false' : 'true'}}">
		<div class="col-sm-10 col-sm-offset-1">
			<form role="form" method="POST" action="{{ url('/admin/properties/add') }}">
				{{csrf_field()}}
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Class name</th>
							<th>Group</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="form-group{{$errors->has('property_name') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="property_name" placeholder="Name" value="{{old('property_name')}}">
									@if($errors->has('property_name'))
										@foreach($errors->get('property_name') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('property_class') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="property_class" placeholder="Class" value="{{old('property_class')}}">
									@if($errors->has('property_class'))
										@foreach($errors->get('property_class') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('property_group') ? ' has-error' : ''}}">
									<select class="form-control" name="property_group">
										<option value="device">Device</option>
										<option value="technology">Technology</option>
										<option value="browser">Browser</option>
									</select>
									@if($errors->has('property_group'))
										@foreach($errors->get('property_group') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary">Add property</button>
				</div>
			</form>
		</div>
	</div>
	@if(isset($properties) && $properties->count())
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			{{ $properties->links() }}
		</div>
	</div>
	@endif
@stop