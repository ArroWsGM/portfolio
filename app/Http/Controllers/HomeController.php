<?php

namespace App\Http\Controllers;

use App;
use Mail;
use Session;
use View;

use App\Project;
use App\Message;
use App\Admin\Setting;
use App\Events\ProjectWasViewed;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $locale;

    public function __construct(Request $request){
        $locale = Session::has('locale') ? Session::get('locale') : setLocaleByIP($request->ip());
        App::setLocale($locale);
        $this->locale = $locale;
    }

    public function index()
    {
        $all_settings = Setting::getAllSettings();
        $page_title = trans('app.portfolio');

        $locale = $this->locale;

        $projects = Project::with([
                                    'galleries' => function($query){
                                                            $query->where('item_type', 'img');
                                                        }
                                ])
                    ->orderBy('updated_at', 'desc')
                    ->take(isset($all_settings['front_carouselitems']) ? $all_settings['front_carouselitems'] : 10)
                    ->get();

        return view('front.home', compact('page_title', 'projects', 'locale'));
    }
//Set Locale
    public function setLocale(Request $request)
    {
        $locale = $request->locale;

        if(!in_array($locale, ['uk', 'en']))
            $locale = 'en';
        
        Session::put('locale', $locale);

        return back();
    }
//Load project
    public function getProject(Request $request, Project $project)
    {
        $project = Project::with([
                                    'galleries' => function($query){
                                                            $query->orderBy('item_type');
                                                        },
                                    'properties.property'
                                ])->find($project->id);
        if($project->count()){
            event(new ProjectWasViewed($project->id, $request->ip()));
            return ['success' => View::make('front.project', compact('project'))->render()];
        } else {
            return ['error' => trans('notfound')];
        }
    }
//add message
    public function addMessage(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|between:2,128',
            'email' => 'email',
            'subject' => 'required|between:3,128',
            'phone' => 'regex:/\+380\([0-9]{2}\)[0-9]{3}-[0-9]{2}-[0-9]{2}/',
            'message' => 'required|min:10',
        ]);

        $blacklisted = \DB::table('blacklist_ip')->where('ip', $request->ip())->count();

        if($blacklisted > 0)
            return ['error' => trans('app.blacklist')];

        $msg = [
            'status_id' => 1,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'msg' => $request->message,
            'ip' => $request->ip(),
        ];

        $all_settings = Setting::getAllSettings();

        if(isset($all_settings['email_message_resend']) && $all_settings['email_message_resend'] && isset($all_settings['email_admin']) && !empty($all_settings['email_admin'])){
            Mail::send('front.emails.contactme', $msg, function ($m) use ($msg, $all_settings) {
                $m->from(env('MAIL_USERNAME', 'admin@valery.cms'));
                $m->replyTo(!empty($msg['email']) ? $msg['email'] : 'not@set.email', $msg['name']);

                $m->to($all_settings['email_admin'])->subject($msg['subject']);
            });
        }

        if(Message::create($msg))
        {
            return ['success' => trans('app.msgsend')];
        }
        else
        {
            return ['error' => trans('app.msgerror')];
        }
    }
}
