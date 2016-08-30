@extends('admin._main')

@section('page_content')
	<div class="row">
		<div id="alert-holder" class="col-sm-6 col-sm-offset-3">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>Settings</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<form role="form" method="POST" action="{{ route('settings.update') }}">
				{{csrf_field()}}
				{{method_field('PUT')}}
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
						<tr data-id="{{ $setting->id }}">
							<td>
								<div class="form-group{{$errors->has('settings.' . $setting->id . '.setting_name') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="settings[{{$setting->id}}][setting_name]" value="{{$setting->setting_name}}">
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('settings.' . $setting->id . '.setting_type') ? ' has-error' : ''}}">
									<select name="settings[{{$setting->id}}][setting_type]" class="form-control">
										@eval( $setting_type = old('settings.' . $setting->id . '.setting_type', $setting->setting_type) )
										<option value="string" {{ $setting_type == 'string' ? 'selected' : '' }}>String</option>
										<option value="bool" {{ ($setting_type == 'boolean' || $setting_type == 'bool') ? 'selected' : '' }}>Boolean</option>
										<option value="int" {{ ($setting_type == 'integer' || $setting_type == 'int') ? 'selected' : '' }}>Integer</option>
										<option value="float" {{ $setting_type == 'float' ? 'selected' : '' }}>Float</option>
									</select>
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('settings.' . $setting->id . '.setting_value') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="settings[{{$setting->id}}][setting_value]" value="{{$setting->setting_value}}">
									@if($errors->has('settings.' . $setting->id . '.setting_value'))
										@foreach($errors->get('settings.' . $setting->id . '.setting_value') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
							<td>
								<a href="{{route('settings.destroy', $setting->id)}}" class="btn btn-danger remove-setting">Delete</a>
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
			<form role="form" method="POST" action="{{ route('settings.store') }}">
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
									<select name="setting_type" class="form-control">
										<option value="string" {{ old('setting_type') == 'string' ? 'selected' : '' }}>String</option>
										<option value="bool" {{ old('setting_type') == 'boolean' ? 'selected' : '' }}>Boolean</option>
										<option value="int" {{ old('setting_type') == 'integer' ? 'selected' : '' }}>Integer</option>
										<option value="float" {{ old('setting_type') == 'float' ? 'selected' : '' }}>Float</option>
									</select>
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