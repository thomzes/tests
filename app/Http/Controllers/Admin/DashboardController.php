<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class DashboardController extends Controller
{
    public function index($slug)
    {
        if($slug != Session::get('name'))
        {
            Session::flush();
            return redirect()->route('login');
        }

        return view('dashboard');

    }


}