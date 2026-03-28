<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Portfolio;

class HomeController extends Controller
{
    public function index()
    {
        $latestBlogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $featuredPortfolios = Portfolio::where('status', 'active')
            ->take(6)
            ->get();

        return view('web.home', compact('latestBlogs', 'featuredPortfolios'));
    }
}