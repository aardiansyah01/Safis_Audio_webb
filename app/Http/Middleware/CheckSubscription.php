<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        if ($user->subscription_status === 'active') {
            return $next($request);
        }

        if (
            $user->subscription_status === 'trial' &&
            $user->trial_end >= Carbon::now()
        ) {
            return $next($request);
        }

        return redirect('/subscription');
    }
}