<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $portfolios = Portfolio::where('status', 'active')
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->latest()
            ->paginate(9);

        return view('web.portfolio.index', compact('portfolios'));
    }

    public function show(Portfolio $portfolio)
    {
        abort_if($portfolio->status !== 'active', 404);
        return view('web.portfolio.show', compact('portfolio'));
    }
}