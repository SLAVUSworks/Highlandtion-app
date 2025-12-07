<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'category'      => 'required',
            'desc'          => 'required',
            'img'           => 'required|image|file|mimes:png,jpg,jpeg,webp|max:5120',
            'status'        => 'required',
            'publish_date'  => 'required|date',
        ]);

        $validated['slug'] = Str::slug($request->title);

        $validated['user_id'] = auth()->user()->id;

        if ($request->file('img')) {
            $validated['img'] = $request->file('img')->store('articles', 'public');
      
        }

        Article::create($validated);

        return redirect()->route('back.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('back.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'category'      => 'required',
            'desc'          => 'required',
            'img'           => 'nullable|image|file|mimes:png,jpg,jpeg,webp|max:5120',
            'status'        => 'required',
            'publish_date'  => 'required|date',
        ]);

        $validated['slug'] = Str::slug($request->title);

        $data['user_id'] = auth()->user()->id;

        if ($request->file('img', 'public')) {
            if ($article->img) {
                Storage::delete($article->img);
            }
            if ($request->hasFile('img')) {
                $validated['img'] = $request->file('img')->store('articles', 'public');
            }
        }

        $article->update($validated);

        return redirect()->route('back.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->img) {
            Storage::delete($article->img); // Delete associated image
        }

        $article->delete();

        return redirect()->route('back.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
