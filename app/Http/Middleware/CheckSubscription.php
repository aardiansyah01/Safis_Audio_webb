<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Models\User;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect('/');
        }

        /*
        |--------------------------------------------------------------------------
        | 1. Masih trial
        |--------------------------------------------------------------------------
        */
        if (
            $user->subscription_status === 'trial' &&
            now()->lessThanOrEqualTo($user->trial_end)
        ) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Trial habis → cek subscription
        |--------------------------------------------------------------------------
        */
        if ($user->subscription_status === 'trial') {

            $subscription = Subscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

            if ($subscription) {

                if (now()->greaterThanOrEqualTo($subscription->start_date)) {

                    $user->update([
                        'subscription_status' => 'active'
                    ]);

                    return $next($request);
                }

                return redirect('/subscription');
            }

            return redirect('/subscription');
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Sudah active
        |--------------------------------------------------------------------------
        */
        if ($user->subscription_status === 'active') {

            $subscription = Subscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

            if (!$subscription) {

                $user->update([
                    'subscription_status' => 'expired'
                ]);

                return redirect('/subscription');
            }

            if (now()->greaterThan($subscription->end_date)) {

                $subscription->update([
                    'status' => 'expired'
                ]);

                $user->update([
                    'subscription_status' => 'expired'
                ]);

                return redirect('/subscription');
            }

            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Expired
        |--------------------------------------------------------------------------
        */
        return redirect('/subscription');
    }
}
