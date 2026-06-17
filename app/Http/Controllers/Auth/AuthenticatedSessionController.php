<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        $hasActiveSubscription = $user->subscriptions()
            ->where('status', 'active')
            ->exists();

        if (
            $user->subscription_status === 'trial'
            && !$hasActiveSubscription
        ) {

            $request->session()->put(
                'show_trial_popup',
                true
            );

        }

        if (
            $user->subscription_status === 'trial' &&
            now()->lessThanOrEqualTo($user->trial_end)
        ) {
            return redirect('/dashboard');
        }

        if ($user->subscription_status === 'active') {
            return redirect('/dashboard');
        }

        return redirect('/subscription');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
