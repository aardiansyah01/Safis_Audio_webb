<x-guest-layout>

    @if (session('status'))
        <div class="alert alert-success mx-4 mt-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="auth-header">

        <h1>Welcome to SafisAudio</h1>

        <p>Transform your audio with AI</p>

    </div>

    <div class="auth-tabs">

        <button class="auth-tab active">
            Login
        </button>

        <a href="{{ route('register') }}" class="auth-tab">
            Register
        </a>

    </div>

    <div class="google-btn">

        Continue with Google

    </div>

    <div class="divider">

        <span>or</span>

    </div>

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <!-- EMAIL -->

        <div class="mb-3">

            <label class="form-label">
                Email Address
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control auth-input"
                placeholder="you@example.com"
                required
                autofocus>

            @error('email')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- PASSWORD -->

        <div class="mb-3">

            <label class="form-label">
                Password
            </label>

            <input
                id="password"
                type="password"
                name="password"
                class="form-control auth-input"
                placeholder="••••••••"
                required>

            @error('password')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- REMEMBER -->

        <div class="form-check mb-4">

            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember">

            <label
                class="form-check-label"
                for="remember">

                Remember me

            </label>

        </div>

        <button type="submit" class="btn-register">

            Login

        </button>

    </form>

    @if (Route::has('password.request'))

        <div class="text-center mt-3">

            <a
                href="{{ route('password.request') }}"
                class="forgot-password">

                Forgot Password?

            </a>

        </div>

    @endif

    <div class="back-home">

        <a href="/">
            ← Back to Home
        </a>

    </div>

</x-guest-layout>
