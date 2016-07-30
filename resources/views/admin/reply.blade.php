@extends('admin._main')

@section('page_content')
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<form class="form-horizontal" action="{{url('/admin/email/send')}}" method="POST">
				{{csrf_field()}}
				<div class="form-group{{($errors->has('name') || $errors->has('email')) ? ' has-error' : ''}}">
					<label for="to" class="col-sm-1 control-label">To:</label>
					<div class="col-sm-11">
						<input type="text" class="form-control" value="{{$message->name}} <{{$message->email}}>" readonly>
					</div>
						<input type="hidden" name="name" value="{{$message->name}}">
						<input type="hidden" name="email" value="{{$message->email}}">
				</div>
				<div class="form-group{{$errors->has('subject') ? ' has-error' : ''}}">
					<label for="subject" class="col-sm-1 control-label">Subject:</label>
					<div class="col-sm-11">
						@eval($subject = 'Re: '. $message->subject)
						<input type="text" name="subject" class="form-control" value="{{old('subject', $subject)}}">
						@if($errors->has('subject'))
							@foreach($errors->get('subject') as $error_message)
							<span class="help-block">{{$error_message}}</span>
							@endforeach
						@endif
					</div>
				</div>
				<div class="form-group{{$errors->has('from') ? ' has-error' : ''}}">
					<label for="from" class="col-sm-1 control-label">From:</label>
					<div class="col-sm-11">
						@eval($from = isset($all_settings['email_admin']) ? $all_settings['email_admin'] : '')
						<input type="text" name="from" class="form-control" value="{{old('from', $from)}}">
						@if($errors->has('from'))
							@foreach($errors->get('from') as $error_message)
							<span class="help-block">{{$error_message}}</span>
							@endforeach
						@endif
					</div>
				</div>
				<div class="form-group{{$errors->has('reply') ? ' has-error' : ''}}">
<?php
//Compose message cite
	$reply = '<br><br><p> On ';
	$reply .= $message->created_at->format('D, M d, Y');
	$reply .= ' at ';
	$reply .= $message->created_at->format('H:m');
	$reply .= ' <strong>';
	$reply .= $message->name;
	$reply .= '</strong>';
	$reply .= ' wrote:</p>';
	$reply .= '<blockquote style="padding: 10px 20px; margin: 0 0 20px; border-left: 5px solid #eee;">';
	$reply .= nl2br($message->message);
	$reply .= '</blockquote>';
	if(isset($all_settings['email_signature']))
		$reply .= $all_settings['email_signature'];
?>
					<textarea class="form-control tinymce-field" name="reply" cols="30" rows="10">
						{{old('reply', $reply)}}
					</textarea>
					@if($errors->has('reply'))
						@foreach($errors->get('reply') as $error_message)
						<span class="help-block">{{$error_message}}</span>
						@endforeach
					@endif
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<a href="{{url('admin/messages')}}" class="btn btn-default pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to messages</a>
						<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop