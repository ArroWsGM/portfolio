@extends('admin._main')

@section('page_content')
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>Users</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Crated</th>
						<th>Updated</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $key=>$user)
					<tr data-id="{{$user->id}}">
						<td>
							@if(Auth::user() && Auth::user()->email != 'demo@demo.demo')
								{{($users->currentPage()-1) * $users->perPage() + ($key + 1)}}
							@else
								{{$key+1}}
							@endif
						</td>
						<td class="user-name">
							<a href="{{url('admin/users/edit/' . $user->id)}}" class="btn-edit" data-token="{{csrf_token()}}">{{$user->name}}</a>
						</td>
						<td class="user-email">
							<a href="{{url('admin/users/edit/' . $user->id)}}" class="btn-edit" data-token="{{csrf_token()}}">{{$user->email}}</a>
						</td>
						<td>
							{{$user->created_at}}
						</td>
						<td class="user-updated_at">
							{{$user->updated_at}}
						</td>
						<td>
							@if(Auth::user() && Auth::user()->email != 'demo@demo.demo')
							<a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-edit" data-action="{{route('users.update', $user->id)}}">Edit</a>
							<form action="{{route('users.destroy', $user->id)}}" method="POST" class="a-block-inline delete-form">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
							@else
							<a href="#" class="btn btn-primary">Edit</a>
							<a href="#" class="btn btn-danger">Delete</a>
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#adduser-collapse" aria-expanded="{{empty($errors->all()) ? 'false' : 'true'}}">
				Add New User
			</button>
		</div>
	</div>
	<div class="row collapse{{empty($errors->all()) ? '' : ' in'}}" id="adduser-collapse" aria-expanded="{{empty($errors->all()) ? 'false' : 'true'}}">
		<div class="col-sm-6 col-sm-offset-3">
			<form role="form" method="POST" action="{{ route('users.store') }}">
				{{csrf_field()}}
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Password</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="name" placeholder="Name" value="{{old('name')}}">
									@if($errors->has('name'))
										@foreach($errors->get('name') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="email" placeholder="Email (unique)" value="{{old('email')}}">
									@if($errors->has('email'))
										@foreach($errors->get('email') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
							<td>
								<div class="form-group{{$errors->has('password') ? ' has-error' : ''}}">
									<input class="form-control" type="text" name="password" placeholder="Password" value="{{old('password')}}">
									@if($errors->has('password'))
										@foreach($errors->get('password') as $message)
										<span class="help-block">{{$message}}</span>
										@endforeach
									@endif
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary">Add User</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			@if(method_exists($users, 'links'))
			{{ $users->links() }}
			@endif
		</div>
	</div>
@stop