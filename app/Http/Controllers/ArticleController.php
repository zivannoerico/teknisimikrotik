<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $query = Article::where('is_published', true)->latest('published_at');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(6);
        $categories = Article::where('is_published', true)->distinct()->pluck('category');

        return view('pages.blog.index', compact('articles', 'categories', 'search'));
    }

    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $recentArticles = Article::where('id', '!=', $article->id)->where('is_published', true)->latest('published_at')->take(4)->get();

        return view('pages.blog.show', compact('article', 'recentArticles'));
    }
}
