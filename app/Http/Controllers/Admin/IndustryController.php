<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\IndustryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class IndustryController extends BaseController
{
    /**
     * @var IndustryContract
     */
    protected $industryRepository;


    /**
     * PageController constructor.
     * @param IndustryContract $industryRepository
     */
    public function __construct(IndustryContract $industryRepository)
    {
        $this->industryRepository = $industryRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $industry = $this->industryRepository->listIndustries();

        $this->setPageTitle('Industries', 'List of all industry');
        return view('admin.industry.index', compact('industry'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Industry', 'Create Industry');
        return view('admin.industry.create');
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
        
        $industry = $this->industryRepository->createIndustry($params);

        if (!$industry) {
            return $this->responseRedirectBack('Error occurred while creating industry.', 'error', true, true);
        }
        return $this->responseRedirect('admin.industry.index', 'Industry added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetIndustry = $this->industryRepository->findIndustryById($id);
        
        $this->setPageTitle('Industry', 'Edit Industry : '.$targetIndustry->title);
        return view('admin.industry.edit', compact('targetIndustry'));
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

        $industry = $this->industryRepository->updateIndustry($params);

        if (!$industry) {
            return $this->responseRedirectBack('Error occurred while updating Industry.', 'error', true, true);
        }
        return $this->responseRedirectBack('Industry updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $industry = $this->industryRepository->deleteIndustry($id);

        if (!$industry) {
            return $this->responseRedirectBack('Error occurred while deleting Industry.', 'error', true, true);
        }
        return $this->responseRedirect('admin.industry.index', 'Industry deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $industry = $this->industryRepository->updateIndustryStatus($params);

        if ($industry) {
            return response()->json(array('message'=>'Industry status successfully updated'));
        }
    }
}
