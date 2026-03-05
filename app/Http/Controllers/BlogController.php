<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::published()->latest()->paginate(9);
        return view('blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        abort_if(!$blog->is_published, 404);
        $blogLainnya = Blog::published()->where('id', '!=', $blog->id)->latest()->take(3)->get();
        return view('blog.show', compact('blog', 'blogLainnya'));
    }
}
