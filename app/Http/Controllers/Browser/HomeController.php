<?php

namespace App\Http\Controllers\Browser;

use Illuminate\Http\Request;
use Auth;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       return view('home');
    }

    public function xujian(Request $request)
    {
       return $request->user();
    }
}
