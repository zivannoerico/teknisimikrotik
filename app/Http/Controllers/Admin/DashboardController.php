<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Consultation;
use App\Models\Portfolio;
use App\Models\PricingPlan;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_services' => Service::count(),
            'total_plans' => PricingPlan::count(),
            'total_portfolios' => Portfolio::count(),
            'total_articles' => Article::count(),
            'total_consultations' => Consultation::count(),
            'pending_consultations' => Consultation::where('status', 'baru')->count(),
            'processed_consultations' => Consultation::where('status', 'diproses')->count(),
            'completed_consultations' => Consultation::where('status', 'selesai')->count(),
        ];

        $recentConsultations = Consultation::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentConsultations'));
    }
}
