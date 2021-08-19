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
    	$data = [];
    	return view('admin.cms.addHomepage',compact('key','task','data'));
    }

    public function editHomePageData(Request $req,$id,$key)
    {
    	$this->setPageTitle('Home Page', 'Home page Add');
    	$task = 'edit';
    	$data = FrontendSetting::where('id',$id)->where('key',$key)->first();
    	return view('admin.cms.addHomepage',compact('key','task','data'));
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
			case 'terms_and_condition': return $this->terms_and_condition_save($req); break;
			case 'policy': return $this->policy_save($req); break;
    	}
    }

    public function where_our_mentor_work_at(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$req->validate([
    			'id' => 'required|numeric|min:1',
    		]);
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','where_our_mentor_work_at')->first();
    	}else{
    		$req->validate([
    			'icon' => 'required|image',
    		]);
    		$setting = new FrontendSetting();
    		$setting->key = 'where_our_mentor_work_at';
    	}
    	if($req->hasFile('icon')){
    		$image = $req->file('icon');
    		$setting->icon = imageUpload($image,'homepage');
	    }
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function what_we_do(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'title' => 'required|string|max:200',
    		'description' => 'required|string',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$req->validate([
    			'id' => 'required|numeric|min:1',
    		]);
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','what_we_do')->first();
    	}else{
    		$req->validate([
    			'icon' => 'required|image',
    		]);
    		$setting = new FrontendSetting();
    		$setting->key = 'what_we_do';
    	}
    	if($req->hasFile('icon')){
	    	$image = $req->file('icon');
    		$setting->icon = imageUpload($image,'homepage');
    	}
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
    		$req->validate([
    			'id' => 'required|numeric|min:1',
    		]);
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
    		'title' => 'required|string|max:200',
    		'description' => 'required|string',
    		'designation' => 'required|string|max:200',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$req->validate([
    			'id' => 'required|numeric|min:1',
    		]);
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','our_sucess_story')->first();
    	}else{
    		$req->validate([
    			'media' => 'required|image',
    		]);
    		$setting = new FrontendSetting();
    		$setting->key = 'our_sucess_story';
    	}
    	if($req->hasFile('media')){
	    	$image = $req->file('media');
    		$setting->media = imageUpload($image,'homepage');
    	}
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
    		'title' => 'required|string|max:200',
    		'description' => 'required|string',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$req->validate([
    			'id' => 'required|numeric|min:1',
    		]);
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','how_mentory_works')->first();
    	}else{
    		$req->validate([
    			'media' => 'required|image',
    		]);
    		$setting = new FrontendSetting();
    		$setting->key = 'how_mentory_works';
    	}
    	if($req->hasFile('media')){
	    	$image = $req->file('media');
    		$setting->media = imageUpload($image,'homepage');
    	}
    	$setting->title = $req->title;
    	$setting->description = $req->description;
    	$setting->save();
    	return redirect(route('admin.cms.homepage'))->with('Success','Setting '.$message.' Successfully');
    }

    public function become_mentor_home_page(Request $req)
    {
    	$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'title' => 'required|string|max:200',
    	]);
    	$message = 'Created';
    	if($req->task == 'edit'){
    		$req->validate([
    			'id' => 'required|numeric|min:1',
    		]);
    		$message = 'Updated';
    		$setting = FrontendSetting::where('id',$req->id)->where('key','become_mentor_home_page')->first();
    	}else{
    		$req->validate([
    			'media' => 'required|image',
    		]);
    		$setting = new FrontendSetting();
    		$setting->key = 'become_mentor_home_page';
    	}
    	if($req->hasFile('media')){
    		$image = $req->file('media');
    		$setting->media = imageUpload($image,'homepage');
    	}
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
    			$setting->delete();
    			return response()->json(['error'=>false,'message'=>'Deleted Success']);
    		}
    		return response()->json(['error'=>true,'message'=>'Something went wrong please try after some time']);
    	}
    	return response()->json(['error'=>true,'message'=>$validator->errors()->first()]);
    }

	public function termsAndCondition(Request $req)
	{
		$this->setPageTitle('Terms and Condition', 'Terms and Condition');
    	$task = 'edit';$key = 'terms_and_condition';
    	$data = FrontendSetting::where('key',$key)->first();
    	return view('admin.cms.addHomepage',compact('key','task','data'));
	}

	public function policy(Request $req)
	{
		$this->setPageTitle('Policy', 'Policy');
    	$task = 'edit';$key = 'policy';
    	$data = FrontendSetting::where('key',$key)->first();
    	return view('admin.cms.addHomepage',compact('key','task','data'));
	}

	public function terms_and_condition_save(Request $req)
	{
		$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'description' => 'required|string',
			'id' => 'nullable|numeric|min:1',
    	]);
    	$setting = FrontendSetting::select('*');
		if(!empty($req->id)){
			$setting = $setting->where('id',$req->id);
		}
		$setting = $setting->where('key','terms_and_condition')->first();
		if(!$setting){
    		$setting = new FrontendSetting();
    		$setting->key = 'terms_and_condition';
    	}
    	$setting->description = $req->description;
    	$setting->save();
    	return back()->with('Success','Terms and Condition Updated Successfully');
	}

	public function policy_save(Request $req)
	{
		$req->validate([
    		'task' => 'required|string|in:add,edit',
    		'description' => 'required|string',
			'id' => 'nullable|numeric|min:1',
    	]);
    	$setting = FrontendSetting::select('*');
		if(!empty($req->id)){
			$setting = $setting->where('id',$req->id);
		}
		$setting = $setting->where('key','policy')->first();
		if(!$setting){
    		$setting = new FrontendSetting();
    		$setting->key = 'policy';
    	}
    	$setting->description = $req->description;
    	$setting->save();
    	return back()->with('Success','Policy Updated Successfully');
	}
}
