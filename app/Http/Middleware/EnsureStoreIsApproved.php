<?php

namespace App\Http\Middleware;

use App\Enums\StoreStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStoreIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $store = $request->user()?->store;

        if (! $store || $store->status !== StoreStatus::Approved) {
            abort(403, 'Toko Anda belum dibuat atau belum disetujui admin.');
        }

        return $next($request);
    }
}
