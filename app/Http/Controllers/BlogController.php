<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::where('status', 'published')
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = Blog::where('status', 'published')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('web.blog.index', compact('blogs', 'categories'));
    }

    public function show(Blog $blog)
    {
        abort_if($blog->status !== 'published', 404);

        $related = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->take(3)
            ->get();

        return view('web.blog.show', compact('blog', 'related'));
    }
}