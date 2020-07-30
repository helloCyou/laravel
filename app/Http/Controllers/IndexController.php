<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;

class IndexController extends Controller
{
    //
    public function home()
    {
        $blogs = Blog::orderby('id','DESC')->with('user')->paginate('10');
        return view("home",compact('blogs'));
    }
}
