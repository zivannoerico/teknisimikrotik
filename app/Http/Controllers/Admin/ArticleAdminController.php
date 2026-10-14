<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleAdminController extends Controller
{
    public function index(): View
    {
        $articles = Article::latest()->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin.articles.form', [
            'article' => new Article(['is_published' => true, 'read_time' => 5, 'author_name' => 'Tim Teknisi MikroTik']),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'slug' => 'nullable|string|max:190|unique:articles,slug',
            'category' => 'required|string|max:60',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'author_name' => 'required|string|max:80',
            'read_time' => 'required|integer|min:1',
            'image' => 'nullable|string|max:200',
        ]);

        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);

        return view('admin.articles.form', [
            'article' => $article,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'slug' => 'nullable|string|max:190|unique:articles,slug,'.$article->id,
            'category' => 'required|string|max:60',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'author_name' => 'required|string|max:80',
            'read_time' => 'required|integer|min:1',
            'image' => 'nullable|string|max:200',
        ]);

        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published'] && ! $article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
