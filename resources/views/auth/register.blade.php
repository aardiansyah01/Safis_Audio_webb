<x-guest-layout>

    <div class="auth-header">

        <h1>Welcome to SafisAudio</h1>

        <p>Transform your audio with AI</p>

    </div>

    <div class="auth-tabs">

        <a href="{{ route('login') }}" class="auth-tab">
            Login
        </a>

        <button class="auth-tab active">
            Register
        </button>

    </div>

    <div class="google-btn">
        Continue with Google
    </div>

    <div class="divider">
        <span>or</span>
    </div>

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <!-- NAME -->

        <div class="mb-3">

            <label class="form-label">
                Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control auth-input"
                placeholder="Your Full Name"
                required>

            @error('name')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- EMAIL -->

        <div class="mb-3">

            <label class="form-label">
                Email Address
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control auth-input"
                placeholder="you@example.com"
                required>

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

        <!-- CONFIRM PASSWORD -->

        <div class="mb-4">

            <label class="form-label">
                Confirm Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control auth-input"
                placeholder="••••••••"
                required>

        </div>

        <button type="submit" class="btn-register">

            Create Account

        </button>

    </form>

    <div class="back-home">

        <a href="/">
            ← Back to Home
        </a>

    </div>

</x-guest-layout>
