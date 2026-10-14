<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioAdminController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::orderBy('sort_order')->get();

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        return view('admin.portfolios.form', [
            'portfolio' => new Portfolio(['is_active' => true, 'is_featured' => false, 'sort_order' => 0]),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'slug' => 'nullable|string|max:190|unique:portfolios,slug',
            'client_name' => 'required|string|max:120',
            'category' => 'required|string|max:60',
            'location' => 'nullable|string|max:100',
            'summary' => 'required|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'result' => 'nullable|string',
            'device_used' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:200',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolios.form', [
            'portfolio' => $portfolio,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $portfolio = Portfolio::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'slug' => 'nullable|string|max:190|unique:portfolios,slug,'.$portfolio->id,
            'client_name' => 'required|string|max:120',
            'category' => 'required|string|max:60',
            'location' => 'nullable|string|max:100',
            'summary' => 'required|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'result' => 'nullable|string',
            'device_used' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:200',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil dihapus.');
    }
}
