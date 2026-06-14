<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/');
        }

        // jika masih trial
        if (
            $user->subscription_status === 'trial' &&
            now()->lessThanOrEqualTo($user->trial_end)
        ) {
            return $next($request);
        }

        // jika sudah subscribe
        if ($user->subscription_status === 'active') {
            return $next($request);
        }

        return redirect('/subscription');
    }
}