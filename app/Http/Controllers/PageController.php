<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function ShowHome()
    {
        return view('welcome');
    }

    public function ShowBlog()
    {
        return view('blog');
    }

    
}


