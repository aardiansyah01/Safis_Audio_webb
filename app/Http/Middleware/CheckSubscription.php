<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class CheckSubscription
{
    public function handle(
        Request $request,
        Closure $next
    ): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/');
        }

        /*
        |--------------------------------------------------------------------------
        | 1. Trial masih aktif
        |--------------------------------------------------------------------------
        */

        if (
            $user->trial_end &&
            now()->lessThanOrEqualTo($user->trial_end)
        ) {

            if (
                $user->subscription_status !== 'trial'
            ) {

                $user->update([
                    'subscription_status' => 'trial'
                ]);
            }

            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Cari subscription aktif terbaru
        |--------------------------------------------------------------------------
        */

        $subscription = Subscription::where(
            'user_id',
            $user->id
        )
        ->where('status', 'active')
        ->orderByDesc('end_date')
        ->first();

        /*
        |--------------------------------------------------------------------------
        | 3. Tidak punya subscription aktif
        |--------------------------------------------------------------------------
        */

        if (!$subscription) {

            if (
                $user->subscription_status !== 'expired'
            ) {

                $user->update([
                    'subscription_status' => 'expired'
                ]);
            }

            return redirect('/subscription');
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Subscription sudah habis
        |--------------------------------------------------------------------------
        */

        if (
            now()->greaterThan(
                $subscription->end_date
            )
        ) {

            $subscription->update([
                'status' => 'expired'
            ]);

            $user->update([
                'subscription_status' => 'expired'
            ]);

            return redirect('/subscription');
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Subscription aktif
        |--------------------------------------------------------------------------
        */

        if (
            $user->subscription_status !== 'active'
        ) {

            $user->update([
                'subscription_status' => 'active'
            ]);
        }

        return $next($request);
    }
}
