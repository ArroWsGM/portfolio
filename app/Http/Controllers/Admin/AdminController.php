<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use Validator;
use App\User;
use App\Admin\Setting;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	//private $all_settings;

    public function __construct()
    {
    	$this->middleware('auth', ['except' => ['about', 'index']]);
    	//$this->all_settings = Setting::getAllSettings();
    }
//Index
//Currently empty
    public function index()
    {
    	return redirect()->action('Admin\AdminController@about');
    }
//About page
    public function about()
    {
    	//get phpinfo
		ob_start();
		    phpinfo();
		    $phpinfo_raw = ob_get_contents();
		ob_end_clean();

		preg_match("/<body[^>]*>(.*?)<\/body>/is", $phpinfo_raw, $matches);
		$phpinfo = $matches[1];

		//dd(\Auth::check());

		$page_title = 'About';
    	return view('admin.about', compact('page_title', 'phpinfo'));
    }
//Settings page & settings managment
    public function settingIndex()
    {
		$settings = Setting::all();

		$page_title = 'Settings';
    	return view('admin.settings', compact('page_title', 'settings'));
    }

    public function settingStore(Request $request)
    {
        $v = Validator::make($request->all(), [
            'setting_name' => 'required|between:3,128|unique:settings',
            'setting_type' => 'required|in:string,bool,boolean,int,integer,float|max:32',
        ]);

        $v->sometimes('setting_value', 'required|integer|digits_between:1,512', function($input){
            return ($input->setting_type == 'int' || $input->setting_type == 'integer');
        });

        $v->sometimes('setting_value', 'required|boolean|max:512', function($input){
            return ($input->setting_type == 'bool' || $input->setting_type == 'boolean');
        });

        $v->sometimes('setting_value', 'required|string|max:512', function($input){
            return ($input->setting_type == 'string');
        });

        $v->sometimes('setting_value', 'required|numeric|digits_between:1,512', function($input){
            return ($input->setting_type == 'float');
        });

        if($v->fails()) {
            Session::flash('msg_error', 'Some errors found while adding new setting');
            return back()->withErrors($v)->withInput();
        }

        if(Setting::create($request->all()))
            Session::flash('msg_success', 'Setting successfully added');

        return back();
    }

    public function settingUpdate(Request $request)
    {
		foreach($request->settings as $id=>$row){
            $v = Validator::make($request->all(), [
                'settings.' . $id . '.setting_name' => 'required|between:3,128|unique:settings,setting_name,'.$id,
                'settings.' . $id . '.setting_type' => 'required|in:string,bool,boolean,int,integer,float|max:32',
            ]);

            $v->sometimes('settings.' . $id . '.setting_value', 'required|integer|digits_between:1,512', function($input) use($id){
                return ($input->settings[$id]['setting_type'] == 'int' || $input->settings[$id]['setting_type'] == 'integer');
            });

            $v->sometimes('settings.' . $id . '.setting_value', 'required|boolean|max:512', function($input) use($id){
                return ($input->settings[$id]['setting_type'] == 'bool' || $input->settings[$id]['setting_type'] == 'boolean');
            });

            $v->sometimes('settings.' . $id . '.setting_value', 'required|string|max:512', function($input) use($id){
                return ($input->settings[$id]['setting_type'] == 'string');
            });

            $v->sometimes('settings.' . $id . '.setting_value', 'required|numeric|digits_between:1,512', function($input) use($id){
                return ($input->settings[$id]['setting_type'] == 'float');
            });

            if($v->fails()) {
                Session::flash('msg_error', 'Some errors found while adding new setting');
                return back()->withErrors($v)->withInput();
            }

            unset($v);

			$settings = Setting::find($id);
			$settings->update($row);
		}

		return back();
    }

    public function settingDestroy(Setting $setting)
    {
    	if(Auth::check()){
    		$setting->destroy($setting->id);
    	}

		return response()->json(['success' => 'Setting named "' . $setting->setting_name . '" was removed']);
    }
//
//  Users managment
//
    public function userIndex()
    {
        $user_email = auth()->user()->email;

        if($user_email == 'demo@demo.demo'){
            $users = factory(\App\User::class, 20)->make();
            Session::flash('msg_error', 'You are logged in as a demo user. This users generated by faker factory. To see a real users login as administrator');
        } else {
        	$all_settings = Setting::getAllSettings();
            $per_page = isset($all_settings['per_page_admin']) ? $all_settings['per_page_admin'] : 50;

            $users = User::paginate($per_page);
        }

		$page_title = 'Users';
        $user_edit_modal = true;

    	return view('admin.users', compact('page_title', 'user_edit_modal', 'users'));
    }

    public function userDestroy(User $user)
    {
		$user->destroy($user->id);
		Session::flash('msg_success', 'User <strong>' . $user->name . '</strong> was removed');

		return back();
    }

    public function userStore(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|min:3|max:128',
    		'email' => 'required|email|unique:users',
    		'password' => 'required|min:8',
    	]);

		if(User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]))
    	
        Session::flash('msg_success', 'User successfully added');

		return back();
    }

    public function userEdit(User $user)
    {
		return response()->json($user);
    }

    public function userUpdate(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|min:3|max:128',
    		'email' => 'required|email|unique:users,email,'.$request->id.',id',
    		'password' => 'required|min:8',
    	]);

    	$time = new \DateTime('NOW');

    	$user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'updated_at' => $time->format('Y-m-d H:i:s'),
        ];

		if(User::find($request->id)->update($user))
		{
			unset($user['password']);
    		return ['success' => 'User successfully updated', 'result' => $user];
		}
		else
		{
			unset($user['password']);
    		return ['error' => 'There is an error occured', 'result' => $user];
		}
    }
}
