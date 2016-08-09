<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Admin\Property;
use App\Admin\Setting;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
//Index
    public function index()
    {
		$all_settings = Setting::getAllSettings();

		$per_page = isset($all_settings['per_page_admin']) ? $all_settings['per_page_admin'] : 50;

		$properties = Property::orderBy('property_group')->paginate($per_page);
		
		$page_title = 'Project properties';

		$property_edit_modal = true;

    	return view('admin.project_properties', compact('page_title', 'properties', 'property_edit_modal'));
    }

    public function removeProperty(Request $request, Property $property)
    {
    	if(Auth::check()){
    		$property->destroy($property->id);
    		$request->session()->flash('msg_success', 'Project property named "' . $property->property_name . '" was removed');
    	}

		return back();
    }

    public function editProperty($id)
    {
		return Property::find($id);
    }

    public function updateProperty(Request $request, Property $property)
    {
    	$this->validate($request, [
    		'property_name' => 'required|between:2,32',
    		'property_class' => 'required|between:2,32',
    		'property_group' => 'required|in:device,technology,browser',
    	]);

		if($property->update($request->all())) {
    		return ['success' => 'Property successfully updated', 'result' => $request->all()];
		} else {
    		return ['error' => 'There is an error occured', 'result' => $request->all()];
		}
    }

    public function addProperty(Request $request)
    {
    	$this->validate($request, [
    		'property_name' => 'required|between:2,32',
    		'property_class' => 'required|between:2,32',
    		'property_group' => 'required|in:device,technology,browser',
    	]);

		if(Property::create($request->all()))
    		$request->session()->flash('msg_success', 'Property successfully added');

		return back();
    }
}
