<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqAdminController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('sort_order')->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faqs.form', [
            'faq' => new Faq(['is_active' => true, 'category' => 'Umum', 'sort_order' => 0]),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:250',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:50',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['category'] = $validated['category'] ?? 'Umum';
        $validated['is_active'] = $request->boolean('is_active');
        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.form', [
            'faq' => $faq,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|max:250',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:50',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['category'] = $validated['category'] ?? $faq->category ?? 'Umum';
        $validated['is_active'] = $request->boolean('is_active');
        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
