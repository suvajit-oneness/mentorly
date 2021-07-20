<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\FaqContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class FaqController extends BaseController
{
    /**
     * @var FaqContract
     */
    protected $faqRepository;


    /**
     * PageController constructor.
     * @param FaqContract $faqRepository
     */
    public function __construct(FaqContract $faqRepository)
    {
        $this->faqRepository = $faqRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $faq = $this->faqRepository->listFaqs();

        $this->setPageTitle('FAQs', 'List of all faq');
        return view('admin.faqs.index', compact('faq'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('FAQ', 'Create FAQ');
        return view('admin.faqs.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'forwhichpage' => 'required|in:becomeonmentor,homepage',
            'title'      =>  'required|max:191',
            'description'     =>  'required'
        ]);

        $params = $request->except('_token');
        
        $faq = $this->faqRepository->createFaq($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while creating faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.faq.index', 'FAQ added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetFaq = $this->faqRepository->findFaqById($id);
        
        $this->setPageTitle('FAQ', 'Edit FAQ : '.$targetFaq->title);
        return view('admin.faqs.edit', compact('targetFaq'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'forwhichpage' => 'required|in:becomeonmentor,homepage',
            'title'      =>  'required|max:191',
            'description'     =>  'required'
        ]);

        $params = $request->except('_token');

        $faq = $this->faqRepository->updateFaq($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while updating faq.', 'error', true, true);
        }
        return $this->responseRedirectBack('FAQ updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $faq = $this->faqRepository->deleteFaq($id);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while deleting faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.faq.index', 'FAQ deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $faq = $this->faqRepository->updateFaqStatus($params);

        if ($faq) {
            return response()->json(array('message'=>'FAQ status successfully updated'));
        }
    }
}
