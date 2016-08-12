<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use Image;
use Validator;
use DB;
use Purifier;

use App\Admin\Gallery;
use App\Admin\Project;
use App\Admin\ProjectProperty;
use App\Admin\Property;
use App\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
//Index
    public function index(Request $request)
    {
		$all_settings = Setting::getAllSettings();

		$per_page = isset($all_settings['per_page_admin']) ? $all_settings['per_page_admin'] : 50;

		$sort = $request->sort ? $request->sort : 'updated_at';
		$order = $request->order ? $request->order : 'desc';

		$query = DB::table('projects')
            ->select(DB::raw(' `projects`.*,
            					(select count(`view_counters`.`ip`) from `view_counters` where `view_counters`.`project_id` = `projects`.`id`) as `total`,
            					(select count(distinct `view_counters`.`ip`) from `view_counters` where `view_counters`.`project_id` = `projects`.`id`) as `unique`'
            					));
        $query->orderBy($sort, $order);
        
        if($sort == 'total' || $sort == 'unique')
        	$query->orderBy('updated_at', 'desc');

        $projects = $query->paginate($per_page);
		//$projects = Project::orderBy($sort, $order)->paginate($per_page);
		
		$page_title = 'Projects';

    	return view('admin.projects', compact('page_title', 'projects', 'request'));
    }
//Add project
    public function create()
    {
		$page_title = 'New project';
		$all_properties = Property::all();
		$tinymce = true;

    	return view('admin.project_edit', compact('page_title', 'all_properties', 'tinymce'));
    }
//Edit project
    public function edit(Project $project)
    {
		$page_title = 'Project Editing';
		$tinymce = true;
		$project = Project::with([
									'galleries' => function($query){
															$query->orderBy('item_type');
														},
									'properties.property'
								])->find($project->id);
		$used_properties = ProjectProperty::where('project_id', $project->id)->lists('property_id');
		$all_properties = Property::whereNotIn('id', $used_properties)->get();

    	return view('admin.project_edit', compact('page_title', 'project', 'all_properties', 'used_properties', 'tinymce'));
    }
//Validator
    protected function validator(Request $request, $project_id = null)
    {
    	$validator = Validator::make($request->all(), [
            'project_name' => 'required|between:3,255|unique:projects,project_name,'.$project_id,
            'project_slug' => 'alpha_dash|between:3,255|unique:projects,project_slug,'.$project_id,
            'project_link' => 'url',
            'project_description' => 'min:10',
        ]);

        $validator->sometimes('item_alt', 'required|between:3,255', function($input) {
		    return ($input->item_url != '' && $input->item_type == 'img');
		});

        $validator->sometimes('item_url', 'image', function($input) {
		    return ($input->item_type == 'img');
		});

        $validator->sometimes('item_url', 'mimetypes:video/mp4', function($input) {
		    return ($input->item_type == 'video');
		});

		return $validator;
    }
//Create new project
    public function store(Request $request)
    {
        $project_slug = (isset($request->project_slug) && !empty($request->project_slug)) ? $request->project_slug : str_slug($request->project_name, '-');

        $request->project_slug = $project_slug;

    	$validator = $this->validator($request);
    	//if validation fails
        if ($validator->fails()) {
        	return redirect()
        				->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
    	$upload_dir = $this->getUploadDir();

        if ($request->item_url != '' && $request->file('item_url')->isValid()) {
        	$destination = public_path($upload_dir . $project_slug) . '/';
			
			if ($request->item_type == 'img')
				$name = 'image_' . time() . '_' . str_random(8);
			else
				$name = 'video_' . time() . '_' . str_random(8);

			$extension = $request->file('item_url')->guessExtension() ? '.' . $request->file('item_url')->guessExtension() : '.tmp';

			//$name .= '.' . $extension;
			
			$request->file('item_url')->move($destination, $name . $extension);

			if ($request->item_type == 'img')
				makeImages($destination, $name, $extension);

			$item_url = $name . $extension;
		}
		//dd($res);
		$project = new Project;

		$project = $project->create([
				'project_name' => $request->project_name,
				'project_slug' => $project_slug,
				'project_link' => $request->project_link,
				'project_description' => Purifier::clean($request->project_description),
			]);

		if(isset($item_url) || !empty($request->item_embed)){
			$data = [
					'project_id' => $project->id,
					'item_type' => $request->item_type,
					'item_url' => isset($item_url) ? $item_url : null,
					'item_alt' => $request->item_alt,
					'item_embed' => $request->item_embed,
				];
			
			$gallery = new Gallery($data);
	
			Project::find($project->id)->galleries()->save($gallery);
		}

		if(!empty($request->properties_toadd)){
			$prop_ids = explode(',', $request->properties_toadd);
			foreach ($prop_ids as $prop) {
				$property = new ProjectProperty(['project_id' => $project->id, 'property_id' => $prop]);
				Project::find($project->id)->properties()->save($property);
			}
		}

    	return redirect()->route('projects.edit', $project->id);
    }
//update project
    public function update(Request $request, Project $project)
    {
    	$validator = $this->validator($request, $project->id);
    	//if validation fails
        if ($validator->fails()) {
        	return back()
                     ->withErrors($validator)
                     ->withInput();
        }

    	$upload_dir = $this->getUploadDir();

        $project_slug = $project->project_slug;

        if ($request->item_url != '' && $request->file('item_url')->isValid()) {
        	$destination = public_path($upload_dir . $project_slug) . '/';
			
			if ($request->item_type == 'img')
				$name = 'image_' . time() . '_' . str_random(8);
			else
				$name = 'video_' . time() . '_' . str_random(8);

			$extension = $request->file('item_url')->guessExtension() ? '.' . $request->file('item_url')->guessExtension() : '.tmp';

			//$name .= '.' . $extension;
			
			$request->file('item_url')->move($destination, $name . $extension);

			if ($request->item_type == 'img')
				makeImages($destination, $name, $extension);

			$item_url = $name . $extension;
		}
		//dd($res);

        if($project_slug != $request->project_slug){
        	if (file_exists(public_path($upload_dir . $project_slug))){
        		rename(public_path($upload_dir . $project_slug), public_path($upload_dir . $request->project_slug));
        	}
        	$project_slug = $request->project_slug;
        }

		$project->update([
				'project_name' => $request->project_name,
				'project_link' => $request->project_link,
				'project_slug' => $project_slug,
				'project_description' => Purifier::clean($request->project_description),
				'updated_at' => new \DateTime('NOW'),
			]);

		if(isset($item_url) || !empty($request->item_embed)){
			$data = [
					'project_id' => $project->id,
					'item_type' => $request->item_type,
					'item_url' => isset($item_url) ? $item_url : null,
					'item_alt' => $request->item_alt,
					'item_embed' => $request->item_embed,
				];
			
			$gallery = new Gallery($data);
	
			Project::find($project->id)->galleries()->save($gallery);
		}

		if(!empty($request->properties_toadd)){
			$prop_ids = explode(',', $request->properties_toadd);
			foreach ($prop_ids as $prop) {
				$property = new ProjectProperty(['project_id' => $project->id, 'property_id' => $prop]);
				Project::find($project->id)->properties()->save($property);
			}
		}

    	return redirect()->route('projects.edit', $project->id);
    }
//destroy project
    public function destroy(Project $project)
    {
    	$upload_dir = $this->getUploadDir();
    	$path = public_path($upload_dir . $project->project_slug) .'/';
    	File::deleteDirectory($path);

    	if($project->destroy($project->id)){
    		session()->flash('msg_success', 'Project named "' . $project->project_name . '" was removed');
    		return back();
    	} else {
    		session()->flash('msg_error', 'An error occured when deleting project named "' . $project->project_name);
    		return back();
    	}
    }
//destroy gallery item
    public function destroyGalleryItem(Gallery $gallery)
    {
    	if($gallery->item_type != 'video_embed'){
    		$upload_dir = $this->getUploadDir();
    		$path = public_path($upload_dir . $gallery->project->project_slug) .'/';
    		$name = explode('/', $gallery->item_url);
    		$name = end($name);
    		if($gallery->item_type == 'img'){
    			$name = getAllImageNames($name, $path);
    		} else {
    			$name = $path . $name;
    		}
    		File::delete($name);
    		if(empty(File::files($path))){
    			File::deleteDirectory($path);
    		}
    	}

    	if($gallery->destroy($gallery->id))
    		return ['success' => true];
    	else
    		return ['success' => false];
    }
//destroy project property
    public function destroyProjectProperty(ProjectProperty $property)
    {
    	if($property->destroy($property->id))
    		return ['success' => true];
    	else
    		return ['success' => false];
    }
//get upload directory
    private function getUploadDir(){
		$all_settings = Setting::getAllSettings();
		return isset($all_settings['upload_dir']) ? $all_settings['upload_dir'] : 'public/upload/';
    }
}
