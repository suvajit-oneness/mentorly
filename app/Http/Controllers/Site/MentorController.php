<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function setting(Request $req)
    {
    	return view('mentor.setting');
    }
}
