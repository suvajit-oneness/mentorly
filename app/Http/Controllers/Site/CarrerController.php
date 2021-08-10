<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarrerController extends Controller
{
    public function index(Request $req)
    {
        return view('website.carrer.index');
    }

    public function description(Request $req)
    {
        return view('website.carrer.description');   
    }
}
