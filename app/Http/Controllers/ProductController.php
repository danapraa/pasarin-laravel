<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::parentOnly()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        $activeCategory = $request->filled('category')
            ? Category::where('slug', $request->category)->first()
            : null;

        $products = Product::query()
            ->with(['store', 'category', 'images'])
            ->whereHas('store', fn ($q) => $q->where('status', 'approved'))
            ->when($activeCategory, fn ($q) => $q->where('category_id', $activeCategory->id))
            ->search($request->q)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products', 'categories', 'activeCategory'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->store->status->value === 'approved', 404);

        $product->load(['store', 'category', 'images']);

        $relatedProducts = Product::with('images')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->whereHas('store', fn ($q) => $q->where('status', 'approved'))
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
