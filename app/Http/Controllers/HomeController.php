<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kgweb.home');
    }
    public function aboutus(){
        return view('kgweb.aboutUs');
    }
    public function listpaket(){
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        return view('kgweb.listPaket');
    }
}
