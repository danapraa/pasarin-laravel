<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'activeStores' => Store::where('status', 'approved')->count(),
            'pendingStoresCount' => Store::where('status', 'pending')->count(),
            'todayOrders' => Order::whereDate('created_at', today())->count(),
            'totalUsers' => User::count(),
            'pendingStores' => Store::where('status', 'pending')->latest()->take(5)->get(),
        ]);
    }
}
