<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function singlePostNews()
    {
        return view('pages.news-post');
    }
}
