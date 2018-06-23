<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

        return view('welcome', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/');
    }

    public function update(Request $request, Article $article)
    {
        // $this->authorize('update', $article);

        if (! auth()->user()->can('update', $article)) {
            return redirect('/');
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect('/articles/' . $article->id);
    }

    public function destroy(Article $article)
    {
        if (! auth()->user()->can('delete', $article)) {
            return redirect('/');
        }

        $article->delete();

        return redirect('/');
    }
}
