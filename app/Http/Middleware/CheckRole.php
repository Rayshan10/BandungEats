<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        if (!in_array(auth()->user()->role, $roles)) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}