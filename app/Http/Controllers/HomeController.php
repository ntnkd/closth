<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function page(){
        return view('adminpage');
    }
}
