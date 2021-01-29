<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{   
    // !STATIC PAGE: HOME
    public function home() {

        return view('home');
    }

     // !STATIC PAGE: ABOUT
     public function about() {

        return view('about');
    }
}
