<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\NewsContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class NewsController extends BaseController
{
    /**
     * @var NewsContract
     */
    protected $newsRepository;


    /**
     * PageController constructor.
     * @param NewsContract $newsRepository
     */
    public function __construct(NewsContract $newsRepository)
    {
        $this->newsRepository = $newsRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $news = $this->newsRepository->listNewss();

        $this->setPageTitle('News', 'List of all news');
        return view('admin.news.index', compact('news'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('News', 'Create News');
        return view('admin.news.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'image'     =>  'required|mimes:jpg,jpeg,png|max:1000',
            'description'     =>  'required'
        ]);

        $params = $request->except('_token');
        
        $news = $this->newsRepository->createNews($params);

        if (!$news) {
            return $this->responseRedirectBack('Error occurred while creating news.', 'error', true, true);
        }
        return $this->responseRedirect('admin.news.index', 'News added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetNews = $this->newsRepository->findNewsById($id);
        
        $this->setPageTitle('News', 'Edit News : '.$targetNews->title);
        return view('admin.news.edit', compact('targetNews'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'description'     =>  'required'
        ]);

        $params = $request->except('_token');

        $news = $this->newsRepository->updateNews($params);

        if (!$news) {
            return $this->responseRedirectBack('Error occurred while updating news.', 'error', true, true);
        }
        return $this->responseRedirectBack('News updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $news = $this->newsRepository->deleteNews($id);

        if (!$news) {
            return $this->responseRedirectBack('Error occurred while deleting News.', 'error', true, true);
        }
        return $this->responseRedirect('admin.news.index', 'News deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $news = $this->newsRepository->updateNewsStatus($params);

        if ($news) {
            return response()->json(array('message'=>'News status successfully updated'));
        }
    }
}
