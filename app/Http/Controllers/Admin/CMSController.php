<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,App\Models\FrontendSetting;

class CMSController extends Controller
{
    public function homePage(Request $req)
    {
    	$this->setPageTitle('Home Page', 'Home page settings');
    	$setting = new FrontendSetting;
    	return view('admin.cms.homepage',compact('setting'));
    }

    public function addHomePageData(Request $req,$key)
    {
    	$this->setPageTitle('Home Page', 'Home page Add');
    	$task = 'add';
    	return view('admin.cms.addHomepage',compact('key','task'));
    }

    public function saveHomePageKey(Request $req,$key)
    {
    	$req->validate([
    		'key' => 'required|string',
    	]);
    	switch ($req->key) {
    		case 'where_our_mentor_work_at': return $this->where_our_mentor_work_at($req); break;
    		case 'what_we_do': return $this->what_we_do($req); break;
    		case 'focus_ontheskill_you_need': return $this->focus_ontheskill_you_need($req); break;
    		case 'our_sucess_story': return $this->our_sucess_story($req); break;
    		case 'how_mentory_works': return $this->how_mentory_works($req); break;
    		case 'become_mentor_home_page': return $this->become_mentor_home_page($req); break;
    	}
    }

    public function where_our_mentor_work_at(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'icon' => 'required|image',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','where_our_mentor_work_at')->first();
    	}else{
    		$setting = new FrontendSetting();
    		$setting->key = 'where_our_mentor_work_at';
    	}
    	// Image Upload
    	$random = $this->randomGenerator();
        $image = $req->file('icon');
        $image->move('upload/homepage/',$random.'.'.$image->getClientOriginalExtension());
        $imageurl = url('upload/homepage/'.$random.'.'.$image->getClientOriginalExtension());
        // Image Upload Done
        $setting->icon = $imageurl;
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function what_we_do(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'icon' => 'required|image',
    		'title' => 'required|string|max:200',
    		'description' => 'required|string',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','what_we_do')->first();
    	}else{
    		$setting = new FrontendSetting();
    		$setting->key = 'what_we_do';
    	}
    	// Image Upload
    	$random = $this->randomGenerator();
        $image = $req->file('icon');
        $image->move('upload/homepage/',$random.'.'.$image->getClientOriginalExtension());
        $imageurl = url('upload/homepage/'.$random.'.'.$image->getClientOriginalExtension());
        // Image Upload Done
        $setting->icon = $imageurl;
    	$setting->title = $req->title;
    	$setting->description = $req->description;
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function focus_ontheskill_you_need(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'description' => 'required|string',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','focus_ontheskill_you_need')->first();
    	}else{
    		$setting = new FrontendSetting();
    		$setting->key = 'focus_ontheskill_you_need';
    	}
    	$setting->description = $req->description;
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function our_sucess_story(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'media' => 'required|image',
    		'title' => 'required|string|max:200',
    		'description' => 'required|string',
    		'designation' => 'required|string|max:200',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','our_sucess_story')->first();
    	}else{
    		$setting = new FrontendSetting();
    		$setting->key = 'our_sucess_story';
    	}
    	// Image Upload
    	$random = $this->randomGenerator();
        $image = $req->file('media');
        $image->move('upload/homepage/',$random.'.'.$image->getClientOriginalExtension());
        $imageurl = url('upload/homepage/'.$random.'.'.$image->getClientOriginalExtension());
        // Image Upload Done
    	$setting->media = $imageurl;
    	$setting->title = $req->title;
    	$setting->designation = $req->designation;
    	$setting->description = $req->description;
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function how_mentory_works(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'media' => 'required|image',
    		'title' => 'required|string|max:200',
    		'description' => 'required|string',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','how_mentory_works')->first();
    	}else{
    		$setting = new FrontendSetting();
    		$setting->key = 'how_mentory_works';
    	}
    	// Image Upload
    	$random = $this->randomGenerator();
        $image = $req->file('media');
        $image->move('upload/homepage/',$random.'.'.$image->getClientOriginalExtension());
        $imageurl = url('upload/homepage/'.$random.'.'.$image->getClientOriginalExtension());
        // Image Upload Done
    	$setting->media = $imageurl;
    	$setting->title = $req->title;
    	$setting->description = $req->description;
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function become_mentor_home_page(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'media' => 'required|image',
    		'title' => 'required|string|max:200',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','become_mentor_home_page')->first();
    	}else{
    		$setting = new FrontendSetting();
    		$setting->key = 'become_mentor_home_page';
    	}
    	// Image Upload
    	$random = $this->randomGenerator();
        $image = $req->file('media');
        $image->move('upload/homepage/',$random.'.'.$image->getClientOriginalExtension());
        $imageurl = url('upload/homepage/'.$random.'.'.$image->getClientOriginalExtension());
        // Image Upload Done
    	$setting->media = $imageurl;
    	$setting->title = $req->title;
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function deleteHomePageKey(Request $req)
    {
    	$rules = [
    		'key' => 'required|string',
    		'id' => 'required|numeric|min:1',
    	];
    	$validator = validator()->make($req->all(),$rules);
    	if(!$validator->fails()){
    		$setting = FrontendSetting::where('id',$req->id)->where('key',$req->key)->first();
    		if($setting){
    			return response()->json(['error'=>false,'message'=>'Deleted Success']);
    		}
    		return response()->json(['error'=>true,'message'=>'Something went wrong please try after some time']);
    	}
    	return response()->json(['error'=>true,'message'=>$validator->errors()->first()]);
    }
}
