<?php

namespace App\Http\Controllers\Api;

use App\Admin\Setting;
use App\Message;
use App\Project;
use App\Http\Controllers\Controller;
use App\Events\ProjectWasViewed;
use App\Notifications\newMessageNotification;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ApiController extends Controller
{
    public function index($locale = null){
        $all_settings = Setting::getAllSettings();

        $projects = Project::with([
            'galleries' => function($query){
                $query->where('item_type', 'img');
            }
        ])
            ->orderBy('updated_at', 'desc')
            ->take(isset($all_settings['front_carouselitems']) ? $all_settings['front_carouselitems'] : 10)
            ->get();

        if(!$projects->count())
            abort(404);

        $data = collect([]);

        foreach($projects as $project){
            $item['id'] = $project->id;
            $item['slug'] = $project->project_slug;
            $path = isset($all_settings['upload_dir']) ? $all_settings['upload_dir'] : 'upload/';
            $path .= $project->project_slug . '/';
            $url = $project->galleries->count() ? $path . $project->galleries->first()['item_url'] : false;
            $item['img'] = $url ? url(getImageSizeName($url, 'thumb')) : $all_settings['img_placeholder'];
            $item['project']['name'] = $project->project_name;
            $item['project']['description'] = str_limit(strip_tags($project->project_description), 100);

            $data->push($item);
        }

        return $data;
    }

    public function project(Request $request, $slug, $locale = null) {

        if($locale)
            \App::setLocale($locale);

        $project = Project::where('project_slug', $slug)->with([
            'galleries' => function($query){
                $query->orderBy('item_type');
            },
            'properties.property'
        ])->firstOrFail();

        event(new ProjectWasViewed($project->id, $request->ip()));

        $path = isset($all_settings['upload_dir']) ? $all_settings['upload_dir'] : 'upload/';
        $path .= $project->project_slug . '/';

        $galleries = collect([]);

        foreach($project->galleries as $gallerie){
            if($gallerie->item_type == 'img')
                $gallerie->item_url = getAllImageNames($gallerie->item_url, $path, true);
            elseif($gallerie->item_type == 'video')
                $gallerie->item_url = url($path . $gallerie->item_url);
            elseif($gallerie->item_type == 'video_embed'){
                preg_match('/^.+src="https:\/\/www\.youtube\.com\/embed\/(.+?)[?"]{1}.+$/', $gallerie->item_embed, $matches);
                $gallerie->item_embed = $matches[1];
            }

            $galleries->push($gallerie);
        }

        $project->galleries = $galleries;

        return $project;
    }
    //add message
    public function sendMessage(Request $request, $locale = null)
    {

        if($locale)
            \App::setLocale($locale);

        $this->validate($request, [
            'name' => 'required|between:2,128',
            'email' => 'email',
            'subject' => 'required|between:3,128',
            'phone' => 'regex:/\+380\([0-9]{2}\)[0-9]{3}-[0-9]{2}-[0-9]{2}/',
            'message' => 'required|min:10',
        ]);

        $blacklisted = \DB::table('blacklist_ip')->where('ip', $request->ip())->count();

        if($blacklisted > 0)
            return response(['message' => trans('app.blacklist')], 418);

        $msg = [
            'status_id' => 1,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'ip' => $request->ip(),
        ];

        $created = Message::create($msg);

        $all_settings = Setting::getAllSettings();

        if(isset($all_settings['email_message_resend']) && $all_settings['email_message_resend'] && isset($all_settings['email_admin']) && !empty($all_settings['email_admin'])){
            $admin = new User(['name' => 'admin', 'email' => $all_settings['email_admin']]);

            if($admin)
                Notification::send($admin, new newMessageNotification($created));
        }

        return $created ?
                        response(['message' => trans('app.msgsend')]) :
                        response(['message' => trans('app.msgerror')], 418);
    }

    public function getLocale(Request $request){
        return setLocaleByIP($request->ip(), true);
    }

    public function getVersion(){
        return json_encode(\DB::table('about')->first());
    }
}
