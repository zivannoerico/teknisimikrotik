<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->query('category');
        $query = Portfolio::where('is_active', true)->orderBy('sort_order');

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        $portfolios = $query->paginate(9);
        $categories = Portfolio::where('is_active', true)->distinct()->pluck('category');

        return view('pages.portfolio.index', compact('portfolios', 'categories', 'category'));
    }

    public function show(string $slug): View
    {
        $portfolio = Portfolio::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedPortfolios = Portfolio::where('id', '!=', $portfolio->id)->where('is_active', true)->take(3)->get();

        return view('pages.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}
