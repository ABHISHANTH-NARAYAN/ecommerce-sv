<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('status', 'Published')
                    ->latest()
                    ->get();

        return view('frontend.news.index', compact('news'));
    }
}