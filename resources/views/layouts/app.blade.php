<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link
            rel="stylesheet"
            href="{{ asset('css/dashboard.css') }}">
        <link
            rel="stylesheet"
            href="{{ asset('css/navbar.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
         <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            @php

                $showTrialPopup = false;

                if (Auth::check()) {

                    $activeSubscription = Auth::user()
                        ->subscriptions()
                        ->where('status', 'active')
                        ->exists();

                    $showTrialPopup =
                        Auth::user()->subscription_status === 'trial'
                        && !$activeSubscription
                        && session('show_trial_popup');
                }

            @endphp

            @if($showTrialPopup)

                <div
                    class="trial-modal-overlay"
                    id="trialModal">

                    <div class="trial-modal">

                        <h2>
                            Welcome to SafisAudio
                        </h2>

                        <p class="trial-desc">

                            You are currently using our
                            7-Day Free Trial.

                        </p>

                        <div class="trial-date">

                            Trial Ends

                            <strong>

                                {{ \Carbon\Carbon::parse(
                                    Auth::user()->trial_end
                                )->format('d M Y') }}

                            </strong>

                        </div>

                        <div class="trial-features">

                            <div>✓ Unlimited Audio Processing</div>

                            <div>✓ AI Noise Reduction</div>

                            <div>✓ Audio Enhancement</div>

                            <div>✓ Download Processed Files</div>

                        </div>

                        <p class="trial-note">

                            After your trial expires,
                            an active subscription will be required
                            to continue using SafisAudio.

                        </p>

                        <div class="trial-buttons">

                            <button
                                class="trial-btn-secondary"
                                onclick="closeTrialModal()">

                                Continue Trial

                            </button>

                            <a
                                href="/subscription"
                                class="trial-btn-primary">

                                View Plans

                            </a>

                        </div>

                    </div>

                </div>

                <script>

                function closeTrialModal() {

                    document
                        .getElementById('trialModal')
                        .style.display = 'none';

                    fetch('/hide-trial-popup', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content
                        }
                    });

                }

                </script>

            @endif
        </div>
    </body>
</html>
