<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceAdminController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('sort_order')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.form', [
            'service' => new Service(['is_active' => true, 'is_featured' => false, 'sort_order' => 0]),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->filled('price_start')) {
            $rawPrice = trim((string) $request->input('price_start'));
            if (preg_match('/^(\d+[\.\s]?)+$/', $rawPrice)) {
                $digits = preg_replace('/[^\d]/', '', $rawPrice);
                if ($digits !== '') {
                    $request->merge(['price_start' => 'Rp '.number_format((float) $digits, 0, ',', '.')]);
                }
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'slug' => 'nullable|string|max:160|unique:services,slug',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'features' => 'nullable|string', // newline-separated string in form
            'price_start' => 'nullable|string|max:50',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if (! empty($validated['features'])) {
            $validated['features'] = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = [];
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $service = Service::findOrFail($id);

        return view('admin.services.form', [
            'service' => $service,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $service = Service::findOrFail($id);

        if ($request->filled('price_start')) {
            $rawPrice = trim((string) $request->input('price_start'));
            if (preg_match('/^(\d+[\.\s]?)+$/', $rawPrice)) {
                $digits = preg_replace('/[^\d]/', '', $rawPrice);
                if ($digits !== '') {
                    $request->merge(['price_start' => 'Rp '.number_format((float) $digits, 0, ',', '.')]);
                }
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'slug' => 'nullable|string|max:160|unique:services,slug,'.$service->id,
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'features' => 'nullable|string',
            'price_start' => 'nullable|string|max:50',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if (! empty($validated['features'])) {
            $validated['features'] = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = [];
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
