<x-guest-layout>

    @if (session('status'))

        <div class="alert alert-success mx-4 mt-4">
            {{ session('status') }}
        </div>

    @endif

    <div class="auth-header">

        <h1>Reset Password</h1>

        <p>
            Don't worry. We'll send you a reset link to recover your account.
        </p>

    </div>

    <div class="auth-info">

        <h5>Forgot Your Password?</h5>

        <p>
            Enter the email address associated with your account and we'll
            send you a secure link to reset your password.
        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.email') }}">

        @csrf

        <div class="mb-4">

            <label class="form-label">
                Email Address
            </label>

            <input
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

        <button
            type="submit"
            class="btn-register">

            Send Reset Link →

        </button>

    </form>

    <div class="auth-links">

        <a href="{{ route('login') }}">
            ← Back to Login
        </a>

    </div>

    <div class="back-home">

        <a href="/">
            ← Back to Home
        </a>

    </div>

</x-guest-layout>
