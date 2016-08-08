@extends('admin._main')

@section('page_content')
<div id="_token" class="hidden" data-token="{{csrf_token()}}"></div>
	<div class="row">
		<div id="alert-holder" class="col-sm-6 col-sm-offset-3">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3 col-sm-offset-2">
			<p class="well well-sm"><span class="label label-info"><i class="fa fa-user" aria-hidden="true"></i></span> {{$message->name}}</p>
			@if(!empty($message->email))
			<p class="well well-sm"><span class="label label-info"><i class="fa fa-envelope" aria-hidden="true"></i></span> <a href="{{route('email.reply', $message->id)}}">{{$message->email}}</a></p>
			@endif
			@if(!empty($message->phone))
			<p class="well well-sm"><span class="label label-info"><i class="fa fa-phone-square" aria-hidden="true"></i></span> <a href="tel:+{{getNumbers($message->phone)}}">{{$message->phone}}</a></p>
			@endif
			<div class="well well-sm clearfix"><span class="label label-info"><i class="fa fa-laptop" aria-hidden="true"></i></span> {{$message->ip}}
			@if(is_object($message->blacklisted) && $message->blacklisted->count())
				<form action="{{route('messages.blacklist.remove', $message->blacklisted['ip'])}}" method="POST" class="pull-right">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-success btn-xs">Un-Blacklist It</button>
				</form>
			@else
				<form action="{{route('messages.blacklist.add', $message->ip)}}" method="POST" class="pull-right">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-warning btn-xs">Blacklist It</button>
				</form>
			@endif
			</div>
			<div class="well well-sm" style="overflow: hidden">
				<div class="row">		
					<div class="col-xs-1">
						<span class="label label-info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>&nbsp;
					</div>
					<div class="col-xs-11">
						<select class="form-control" id="set-status" data-url="{{route('messages.updatestatus', $message->id)}}">
							@foreach($statuses as $status)
							<option value="{{$status->id}}" data-class="{{$status->status_class}}" {{($message->status_id == $status->id) ? 'selected' : ''}}>{{$status->status_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<p class="well well-sm"><span class="label label-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> {{$message->subject}}</p>
			<h4>Message</h4>
			<p class="well well-sm">{!!nl2br($message->message)!!}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<a href="{{Session::has('back_to') ? Session::get('back_to') : URL::previous()}}" class="btn btn-default pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
		</div>
	</div>
@stop