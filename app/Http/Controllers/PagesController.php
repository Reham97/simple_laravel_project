<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
       // return view('myPages.index');
       $title="hi";
       return view('myPages.index')->with('title',$title);

    }

    public function about() {
        return view('myPages.about');
    }

    public function services() {
        return view('myPages.services');
    }
}
