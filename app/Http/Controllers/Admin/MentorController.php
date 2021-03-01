<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MentorContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

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
