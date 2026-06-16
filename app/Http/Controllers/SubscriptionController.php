<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index');
    }

    public function buy($plan)
    {
        $user = Auth::user();

        // cegah subscribe dua kali
        if ($user->subscription_status === 'active') {
            return redirect('/dashboard')
                ->with('error', 'Anda sudah memiliki subscription aktif.');
        }

        $startDate = Carbon::parse($user->trial_end)->addDay();

        if ($plan === '1month') {

            Subscription::create([
                'user_id'    => $user->id,
                'plan_name'  => '1 Month',
                'price'      => 30000,
                'start_date' => $startDate,
                'end_date'   => $startDate->copy()->addMonth(),
                'status'     => 'active',
            ]);

        } elseif ($plan === '4month') {

            Subscription::create([
                'user_id'    => $user->id,
                'plan_name'  => '4 Month',
                'price'      => 100000,
                'start_date' => $startDate,
                'end_date'   => $startDate->copy()->addMonths(4),
                'status'     => 'active',
            ]);

        }

        return redirect('/subscription')
            ->with('success', 'Subscription berhasil dibuat.');
    }
}
