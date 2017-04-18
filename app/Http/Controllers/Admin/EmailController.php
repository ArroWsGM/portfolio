<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Support\Facades\Mail;

use App\Admin\Message;
use App\Mail\AdminReplyMessage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Message $message)
    {
    	$page_title = 'Reply to message';
    	$tinymce = true;
    	//$message = Message::find($message->id);
    	return view('admin.reply', compact('page_title', 'message', 'tinymce'));
    }

    public function sendEmail(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|between:2,128',
    		'email' => 'required|email',
    		'subject' => 'required|min:3',
    		'from' => 'required|email',
    		'reply' => 'required|min:10',
    	]);

        Mail::to($request->email, $request->name)
            ->bcc($request->from)
            ->send(new AdminReplyMessage($request));

        return redirect('/admin/messages')->with('msg_success', 'Email to ' . $request->name . ' was sent.');
    }
}
