<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = json_decode(file_get_contents("https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province.json"), true);
        return view('admin/checks/create',compact("provinces"));
    }
}
