<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MentorContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Mentor;use Hash;use Session;

class MentorController extends BaseController
{
    /**
     * @var MentorContract
     */
    protected $mentorRepository;


    /**
     * PageController constructor.
     * @param MentorContract $mentorRepository
     */
    public function __construct(MentorContract $mentorRepository)
    {
        $this->mentorRepository = $mentorRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $mentor = $this->mentorRepository->listMentors();

        $this->setPageTitle('Mentor', 'List of all Mentor');
        return view('admin.mentor.index', compact('mentor'));
    }

    public function editMentor(Request $req,$id)
    {
        $mentor = Mentor::findOrFail($id);
        return view('admin.mentor.edit',compact('mentor'));
    }

    public function updateMentor(Request $req,$id)
    {
        $req->validate([
            'name' => 'required|max:200|string',
            'email' => 'required|email|string|unique:mentors,email,'.$id,
            'mobile' => 'required|numeric|digits:10',
        ]);
        $mentor = Mentor::find($id);
        $mentor->name = $req->name;
        $mentor->email = $req->email;
        $mentor->mobile = $req->mobile;
        $mentor->save();
        Session::flash('message', 'Mentor Updated successfully!');
        return redirect(route('admin.mentor.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $mentor = $this->mentorRepository->deleteMentor($id);

        if (!$mentor) {
            return $this->responseRedirectBack('Error occurred while deleting mentor.', 'error', true, true);
        }
        return $this->responseRedirect('admin.mentor.index', 'Mentor deleted successfully' ,'success',false, false);
    }

    public function create(Request $req)
    {
        return view('admin.mentor.create');
    }

    public function saveNewMentor(Request $req)
    {
        $req->validate([
            'name' => 'required|max:200|string',
            'email' => 'required|email|string|unique:mentors',
            'mobile' => 'required|numeric|digits:10',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $mentor = new Mentor;
        $mentor->name = $req->name;
        $mentor->email = $req->email;
        $mentor->mobile = $req->mobile;
        $mentor->password = Hash::make($req->password);
        $mentor->status = 1;
        $mentor->is_verified = 1;
        $mentor->save();
        Session::flash('message', 'Mentor added successfully!');
        return redirect(route('admin.mentor.index'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $mentor = $this->mentorRepository->updateMentorStatus($params);

        if ($mentor) {
            return response()->json(array('message'=>'Mentor status successfully updated'));
        }
    }
}
