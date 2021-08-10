<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,App\Model\JobApplication;
use App\Model\JobType,App\Model\Job;
use App\Model\JobRequirement;

class CarrierController extends Controller
{
    public function jobCateoryList(Request $req)
    {
        $type = JobType::select('*')->latest()->get();
        return view('admin.carrier.category.index',compact('type'));
    }

    public function jobDetailsList(Request $req)
    {
        $job = Job::select('*');
        if(!empty($req->category)){
            $job = $job->where('jobTypeId',decrypt($req->category));
        }
        $job = $job->latest()->get();
        return view('admin.carrier.jobDetails.index',compact('job'));
    }

    public function jobRequirementList(Request $req)
    {
        $requirement = JobRequirement::select('*');
        if(!empty($req->jobId)){
            $requirement = $requirement->where('jobId',decrypt($req->jobId));
        }
        $requirement = $requirement->latest()->get();
        return view('admin.carrier.jobRequirement.index',compact('requirement'));
    }

    public function index(Request $req)
    {
        $jobType = JobType::select('*')->get();
        return view('website.carrier.index',compact('jobType'));
    }

    public function description(Request $req,$jobId)
    {
        $jobId = decrypt($jobId);
        $job = Job::findOrFail($jobId);
        return view('website.carrier.description',compact('job'));   
    }

    public function saveJobApplication(Request $req,$jobId)
    {
        $req->validate([
            'jobId' => 'required|min:1|in:'.$jobId,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'resume' => 'required',
        ]);
        $job = Job::findOrFail($jobId);
        $newApplication = new JobApplication();
        $newApplication->jobId = $req->jobId;
        $newApplication->f_name = $req->first_name;
        $newApplication->l_name = $req->last_name;
        $newApplication->email = $req->email;
        $newApplication->mobile = $req->phone_number;
        if($req->hasFile('resume')){
            $resume = $req->file('resume');
            $newApplication->resume = imageUpload($resume,'resume');
        }
        $newApplication->save();
        $sendMailData = [
            'name' => $req->first_name,
            'content' => 'Thankyou for applying for the post "'.$job->name.'", Our HR will call you shorlty',
        ];
        sendMail($sendMailData,'email/carrierApplication','rrpit9@gmail.com','Your Application Submitted Successfully !!');
        return back()->with('Success','Application Submitted Sucessfully');
    }

    public function carrierApplicationReport(Request $req)
    {
        $application = JobApplication::latest()->get();
        return view('admin.reports.carrierApplication',compact('application'));
    }
}
