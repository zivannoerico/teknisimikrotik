<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\PricingPlan;
use App\Models\Service;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        $featuredServices = $services->sortByDesc('is_featured')->take(3)->values();
        $serviceOptions = $services->pluck('title');

        $plans = PricingPlan::where('is_active', true)->orderBy('sort_order')->take(3)->get();
        $portfolios = Portfolio::where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->take(2)
            ->get();

        return view('pages.home', compact('featuredServices', 'serviceOptions', 'plans', 'portfolios'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function pricing(): View
    {
        $plans = PricingPlan::where('is_active', true)->orderBy('sort_order')->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->take(4)->get();

        return view('pages.pricing', compact('plans', 'faqs'));
    }

    public function faq(): View
    {
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.faq', compact('faqs'));
    }

    public function contact(): View
    {
        $serviceOptions = Service::where('is_active', true)->orderBy('sort_order')->pluck('title');

        return view('pages.contact', compact('serviceOptions'));
    }
}
