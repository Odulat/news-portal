<?php

namespace App\Http\Controllers;


use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->with('categories')
            ->latest()
            ->get();

        return view('index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article->load('categories');

        return view('show', compact('article'));
    }
}
