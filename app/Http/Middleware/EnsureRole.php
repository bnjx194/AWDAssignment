<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            return $next($request);
        }

        if (in_array($user->role, $roles, true)) {
            return $next($request);
        }

        if ($user->role === 'seller') {
            return redirect()->route('sell')->with('error', 'Seller accounts can only access the sell page.');
        }

        if ($user->role === 'buyer') {
            return redirect()->route('buy')->with('error', 'Buyer accounts can only access the buy page.');
        }

        abort(403, 'You do not have access to this page.');
    }
}