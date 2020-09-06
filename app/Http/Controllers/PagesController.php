<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        $news = News::orderBy('created_at' , 'DESC')->take(6)->get();

        return view('welcome', compact('news'));
    }

    public function news()
    {
        return view('pages.news');
    }

    public function singlePostNews($id)
    {
        $post = News::findOrFail($id);

        return view('pages.news-post' , compact('post'));
    }




}
