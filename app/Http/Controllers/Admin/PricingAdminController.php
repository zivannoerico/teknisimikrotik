<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PricingAdminController extends Controller
{
    public function index(): View
    {
        $plans = PricingPlan::orderBy('sort_order')->get();

        return view('admin.pricing.index', compact('plans'));
    }

    public function create(): View
    {
        return view('admin.pricing.form', [
            'plan' => new PricingPlan(['is_active' => true, 'is_popular' => false, 'billing_period' => 'sekali setting', 'sort_order' => 0]),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->has('price')) {
            $cleanedPrice = preg_replace('/[^\d]/', '', (string) $request->input('price'));
            $request->merge(['price' => $cleanedPrice]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'badge' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_popular'] = $request->boolean('is_popular');
        $validated['is_active'] = $request->boolean('is_active');

        if (! empty($validated['features'])) {
            $validated['features'] = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = [];
        }

        PricingPlan::create($validated);

        return redirect()->route('admin.pricing.index')->with('success', 'Paket harga berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $plan = PricingPlan::findOrFail($id);

        return view('admin.pricing.form', [
            'plan' => $plan,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $plan = PricingPlan::findOrFail($id);

        if ($request->has('price')) {
            $cleanedPrice = preg_replace('/[^\d]/', '', (string) $request->input('price'));
            $request->merge(['price' => $cleanedPrice]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'badge' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_popular'] = $request->boolean('is_popular');
        $validated['is_active'] = $request->boolean('is_active');

        if (! empty($validated['features'])) {
            $validated['features'] = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = [];
        }

        $plan->update($validated);

        return redirect()->route('admin.pricing.index')->with('success', 'Paket harga berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $plan = PricingPlan::findOrFail($id);
        $plan->delete();

        return redirect()->route('admin.pricing.index')->with('success', 'Paket harga berhasil dihapus.');
    }
}
