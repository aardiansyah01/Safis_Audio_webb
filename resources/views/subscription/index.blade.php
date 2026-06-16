@extends('layouts.subscription')

@section('content')

@if(session('success'))
    <div class="alert alert-success text-center mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="container py-5">

    <div class="subscription-header">

        <div class="subscription-badge">
            Premium Plans
        </div>

        <h1 class="subscription-title">
            What Do You Like To Subscribe?
        </h1>

        <p class="subscription-subtitle">
            Choose the perfect plan for your audio enhancement needs
        </p>

    </div>

    <div class="row g-4">

        <!-- 1 MONTH -->

        <div class="col-lg-6">

            <div class="plan-card">

                <h3 class="plan-name">
                    1 Month Plan
                </h3>

                <div class="plan-price">

                    Rp30.000

                    <span class="plan-duration">
                        /month
                    </span>

                </div>

                <div class="plan-desc">
                    (~ $2)
                </div>

                <ul class="plan-features">

                    <li>✔ Unlimited audio processing</li>

                    <li>✔ AI noise reduction</li>

                    <li>✔ Audio enhancement tools</li>

                    <li>✔ Download processed files</li>

                    <li>✔ Email support</li>

                    
                </ul>

                <form method="POST"
                    action="{{ route('subscription.buy', '1month') }}">
                    @csrf

                    <button type="submit"
                            class="plan-btn btn-dark-plan">
                        Subscribe Now
                    </button>
                </form>
                
            </div>

        </div>

        <!-- 4 MONTH -->

        <div class="col-lg-6">

            <div class="plan-card active">
                
                <div class="popular-badge">
                    Most Popular
                </div>
                
                <h3 class="plan-name">
                    4 Month Plan
                </h3>

                <div class="plan-price">

                    Rp100.000

                    <span class="plan-duration">
                        /4 months
                    </span>

                </div>

                <div class="plan-desc">
                    (~ $6)
                </div>
                
                <ul class="plan-features">

                    <li>✔ Unlimited audio processing</li>

                    <li>✔ AI noise reduction</li>

                    <li>✔ Audio enhancement tools</li>
                    
                    <li>✔ Download processed files</li>
                    
                    <li>✔ Email support</li>
                    
                    <li>✔ Email Save more</li>

                </ul>

                <form method="POST"
                    action="{{ route('subscription.buy', '4month') }}">
                    @csrf

                    <button type="submit"
                            class="plan-btn btn-primary-plan">
                        Subscribe Now
                    </button>
                </form>

            </div>

        </div>

    </div>

    <div class="bottom-note">

        All plans include a 7-day money-back guarantee

        <br>

        Cancel anytime • Secure payment • No hidden fees

    </div>

</div>

@endsection