<?php

namespace App\Http\Controllers\Home\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

class BlogController extends Controller
{

    //个人主页
    public function index(Request $request)
    {
        return view('home.blog.index');
    }



}
