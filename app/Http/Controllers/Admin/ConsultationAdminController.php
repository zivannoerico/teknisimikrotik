<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsultationAdminController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $query = Consultation::latest();

        if ($status && in_array($status, ['baru', 'diproses', 'selesai', 'dibatalkan'])) {
            $query->where('status', $status);
        }

        $consultations = $query->paginate(15);
        $counts = [
            'all' => Consultation::count(),
            'baru' => Consultation::where('status', 'baru')->count(),
            'diproses' => Consultation::where('status', 'diproses')->count(),
            'selesai' => Consultation::where('status', 'selesai')->count(),
            'dibatalkan' => Consultation::where('status', 'dibatalkan')->count(),
        ];

        return view('admin.consultations.index', compact('consultations', 'counts', 'status'));
    }

    public function show(int $id): View
    {
        $consultation = Consultation::findOrFail($id);

        return view('admin.consultations.show', compact('consultation'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $consultation = Consultation::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:baru,diproses,selesai,dibatalkan',
            'admin_notes' => 'nullable|string',
        ]);

        $consultation->update($validated);

        return redirect()->route('admin.consultations.show', $consultation->id)
            ->with('success', 'Status konsultasi berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return redirect()->route('admin.consultations.index')
            ->with('success', 'Data konsultasi berhasil dihapus.');
    }
}
