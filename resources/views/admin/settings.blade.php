@extends('admin._main')

@section('page_content')
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>Settings</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<form role="form" method="POST" action="{{ url('/admin/settings') }}">
				{{csrf_field()}}
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Type</th>
							<th>Value</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach($settings as $setting)
						<tr>
							<td>
								<div class="form-group{{$errors->has('settings.' . $setting->id . '.setting_name') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="settings[{{$setting->id}}][setting_name]" value="{{$setting->setting_name}}">
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('settings.' . $setting->id . '.setting_type') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="settings[{{$setting->id}}][setting_type]" value="{{old('settings.' . $setting->id . '.setting_type', $setting->setting_type)}}">
								</div>
							</td>
							<td>
								<div class="form-group">
									<input class="form-control" type="text" name="settings[{{$setting->id}}][setting_value]" value="{{$setting->setting_value}}">
								</div>
							</td>
							<td>
								<a href="{{url('admin/settings/remove/' . $setting->id)}}" class="btn btn-danger">Delete</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#addsetting-collapse" aria-expanded="{{empty($errors->all()) ? 'false' : 'true'}}">
				Add New Setting
			</button>
		</div>
	</div>
	<div class="row collapse{{empty($errors->all()) ? '' : ' in'}}" id="addsetting-collapse" aria-expanded="{{empty($errors->all()) ? 'false' : 'true'}}">
		<div class="col-sm-6 col-sm-offset-3">
			<form role="form" method="POST" action="{{ url('/admin/settings/add') }}">
				{{csrf_field()}}
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Type</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="form-group{{$errors->has('setting_name') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="setting_name" placeholder="Name (unique)" value="{{old('setting_name')}}">
									@if($errors->has('setting_name'))
										@foreach($errors->get('setting_name') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('setting_type') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="setting_type" placeholder="Type" value="{{old('setting_type')}}">
									@if($errors->has('setting_type'))
										@foreach($errors->get('setting_type') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('setting_value') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="setting_value" placeholder="Value" value="{{old('setting_value')}}">
									@if($errors->has('setting_value'))
										@foreach($errors->get('setting_value') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary">Add Setting</button>
				</div>
			</form>
		</div>
	</div>
@stop