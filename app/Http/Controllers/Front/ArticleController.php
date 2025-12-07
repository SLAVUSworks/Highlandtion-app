<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles on the frontend.
     */
    public function index()
    {
        $userId = auth()->id();
        $articles = Article::where('status', 'published')
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('front.articles.index', compact('articles'));
    }

    /**
     * Display the specified article details.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        $article -> increment('views');
        $article -> with('user');


        return view('front.articles.show', compact('article'));
    }
}
