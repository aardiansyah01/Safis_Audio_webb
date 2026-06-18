<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeSubscription = Subscription::where(
            'user_id',
            $user->id
        )
        ->where('status', 'active')
        ->orderByDesc('end_date')
        ->first();

        if ($activeSubscription) {

            $daysRemaining = now()
                ->diffInDays(
                    $activeSubscription->end_date,
                    false
                );

            if ($daysRemaining > 7) {

                return redirect('/dashboard')
                    ->with(
                        'error',
                        'Subscription masih aktif.'
                    );
            }
        }

        return view('subscription.index');
    }

    public function buy($plan)
    {
        $user = Auth::user();

        $activeSubscription = Subscription::where(
            'user_id',
            $user->id
        )
        ->where('status', 'active')
        ->orderByDesc('end_date')
        ->first();

        if ($activeSubscription) {

            $daysRemaining = now()
                ->diffInDays(
                    $activeSubscription->end_date,
                    false
                );

            if ($daysRemaining > 7) {

                return redirect('/dashboard')
                    ->with(
                        'error',
                        'Subscription masih aktif.'
                    );
            }

            $startDate =
                \Carbon\Carbon::parse(
                    $activeSubscription->end_date
                )->addDay();

        } else {

            if (
                $user->trial_end &&
                now()->lessThanOrEqualTo($user->trial_end)
            ) {

                $startDate =
                    \Carbon\Carbon::parse(
                        $user->trial_end
                    )->addDay();

            } else {

                $startDate = now();

            }

        }

        if ($plan === '1month') {

            $endDate =
                $startDate
                    ->copy()
                    ->addMonth();

            Subscription::create([
                'user_id'    => $user->id,
                'plan_name'  => '1 Month',
                'price'      => 30000,
                'start_date' => $startDate,
                'end_date'   => $endDate,
                'status'     => 'active',
            ]);

        } elseif ($plan === '4month') {

            $endDate =
                $startDate
                    ->copy()
                    ->addMonths(4);

            Subscription::create([
                'user_id'    => $user->id,
                'plan_name'  => '4 Month',
                'price'      => 100000,
                'start_date' => $startDate,
                'end_date'   => $endDate,
                'status'     => 'active',
            ]);
        }

        $user->update([
            'subscription_status' => 'active'
        ]);

        return redirect('/dashboard')
            ->with(
                'success',
                'Subscription berhasil dibuat.'
            );
    }
}
