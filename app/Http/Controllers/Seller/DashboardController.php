<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderStore;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $store = $request->user()->store;

        return view('seller.dashboard', [
            'store' => $store,
            'productCount' => $store ? Product::where('store_id', $store->id)->count() : 0,
            'pendingOrders' => $store ? OrderStore::where('store_id', $store->id)->where('status', 'pending')->count() : 0,
            'recentOrders' => $store ? OrderStore::where('store_id', $store->id)->latest()->take(5)->get() : collect(),
        ]);
    }
}
