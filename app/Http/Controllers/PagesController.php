<?php

namespace App\Http\Controllers;

use App\ImportantDate;
use App\News;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        $news = News::orderBy('created_at' , 'DESC')->take(6)->get();
        $idates = ImportantDate::orderBy('occur_date', 'DESC')->get();

        return view('welcome', compact('news' , 'idates'));
    }

    public function news()
    {
        $news = News::orderBy('created_at' , 'DESC')->paginate(6);
        $importantDates = ImportantDate::all();
        return view('pages.news' , compact('news' , 'importantDates'));
    }

    public function singlePostNews($id)
    {
        $post = News::findOrFail($id);

        return view('pages.news-post' , compact('post'));
    }




}
