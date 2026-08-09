<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::parentOnly()
            ->withCount('products')
            ->orderBy('name')
            ->take(6)
            ->get();

        $products = Product::with(['store', 'category', 'images'])
            ->whereHas('store', fn ($q) => $q->where('status', 'approved'))
            ->latest()
            ->take(8)
            ->get();

        return view('welcome', compact('categories', 'products'));
    }
}
