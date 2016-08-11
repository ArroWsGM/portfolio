@extends('admin._main')

@section('page_content')
<div id="_token" class="hidden" data-token="{{csrf_token()}}"></div>
	<div class="row">
		<div id="alert-holder" class="col-sm-6 col-sm-offset-3">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 text-center">
			<h2>Messages
				@if($messages->count())
				&nbsp;<span class="badge badge-info">{{($messages->currentPage() * $messages->perPage()) - $messages->perPage() + 1}}-{{($messages->currentPage() * $messages->perPage()) - $messages->perPage() + $messages->count()}} of {{$messages->total()}}</span>
				@endif
				</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<table class="table table-hover table-messages">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th class="date-utc">Phone</th>
						<th>Subject</th>
						<th>Message</th>
						<th>IP</th>
						<th class="date-utc">Crated</th>
						<th class="status">Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@forelse($messages as $key => $message)
					@eval($class = $message->status['status_class'])
					<tr class="{{$class or ''}}" data-id="{{$message->id}}">
						<td>
							@if(Auth::user() && Auth::user()->email != 'demo@demo.demo')
								{{($messages->currentPage()-1) * $messages->perPage() + ($key + 1)}}
							@else
								{{$key+1}}
							@endif
						</td>
						<td class="message-name">
							{{$message->name}}
						</td>
						<td class="message-email">
							{{$message->email}}
						</td>
						<td class="message-phone">
							{{$message->phone}}
						</td>
						<td class="message-subject">
							{{$message->subject}}
						</td>
						<td class="message-message">
							{{str_limit($message->message, 150)}}
						</td>
						<td class="message-ip">
							{{$message->ip}}
						</td>
						<td>
							{{$message->created_at}}
						</td>
						<td class="message-status">
							<select class="form-control set-status" data-url="{{route('messages.updatestatus', $message->id)}}">
								@foreach($statuses as $status)
								<option value="{{$status->id}}" data-class="{{$status->status_class}}" {{($message->status_id == $status->id) ? 'selected' : ''}}>{{$status->status_name}}</option>
								@endforeach
							</select>
						</td>
						<td class="action-buttons">
							@if(is_object($message->blacklisted) && $message->blacklisted->count())
							<form action="{{route('messages.blacklist.remove', $message->blacklisted['ip'])}}" method="POST" class="mbot-15">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button type="submit" class="btn btn-success">Un-Blacklist It</button>
							</form>
							@else
							<form action="{{route('messages.blacklist.add', $message->ip)}}" method="POST" class="mbot-15">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-warning">Blacklist It</button>
							</form>
							@endif
							@if(Auth::user() && Auth::user()->email != 'demo@demo.demo')
							<a href="{{route('messages.show', $message->id)}}" class="btn btn-primary">View</a>
							<form action="{{route('messages.destroy', $message->id)}}" method="POST" class="delete-form">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
							@else
							<a href="#" class="btn btn-primary">View</a>
							<a href="#" class="btn btn-danger">Delete</a>
							@endif
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="10">
							No messages
						</td>
					</tr>
				@endforelse
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			@if(method_exists($messages, 'links'))
			{{ $messages->links() }}
			@endif
		</div>
	</div>
	{{--
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			{{ var_dump($messages) }}
		</div>
	</div>
	--}}
@stop