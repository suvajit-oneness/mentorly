<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function homePage(Request $req)
    {
    	$this->setPageTitle('Home Page', 'Home page settings');
    	return view('admin.cms.homepage');
    }
}
