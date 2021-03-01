<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\SeniorityContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SeniorityController extends BaseController
{
    /**
     * @var SeniorityContract
     */
    protected $seniorityRepository;


    /**
     * PageController constructor.
     * @param SeniorityContract $seniorityRepository
     */
    public function __construct(SeniorityContract $seniorityRepository)
    {
        $this->seniorityRepository = $seniorityRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $seniority = $this->seniorityRepository->listSeniorities();

        $this->setPageTitle('Seniorities', 'List of all seniority');
        return view('admin.seniority.index', compact('seniority'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Seniority', 'Create Seniority');
        return view('admin.seniority.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191'
        ]);

        $params = $request->except('_token');
        
        $seniority = $this->seniorityRepository->createSeniority($params);

        if (!$seniority) {
            return $this->responseRedirectBack('Error occurred while creating Seniority.', 'error', true, true);
        }
        return $this->responseRedirect('admin.seniority.index', 'Seniority added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetSeniority = $this->seniorityRepository->findSeniorityById($id);
        
        $this->setPageTitle('Seniority', 'Edit Seniority : '.$targetSeniority->title);
        return view('admin.seniority.edit', compact('targetSeniority'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191'
        ]);

        $params = $request->except('_token');

        $seniority = $this->seniorityRepository->updateSeniority($params);

        if (!$seniority) {
            return $this->responseRedirectBack('Error occurred while updating Seniority.', 'error', true, true);
        }
        return $this->responseRedirectBack('Seniority updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $seniority = $this->seniorityRepository->deleteSeniority($id);

        if (!$seniority) {
            return $this->responseRedirectBack('Error occurred while deleting Seniority.', 'error', true, true);
        }
        return $this->responseRedirect('admin.seniority.index', 'Seniority deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $seniority = $this->seniorityRepository->updateSeniorityStatus($params);

        if ($seniority) {
            return response()->json(array('message'=>'Seniority status successfully updated'));
        }
    }
}
