<?php

use App\Enums\UserRole;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;


new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        // if(Auth::user()->role == UserRole::Admin) {
           
        //    return redirect()->route('admin.dashboard')->with('success', 'Login in successfully Admin Dashboard');
        // }

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="h-screen bg-white flex items-center justify-center">

    <div class="w-full max-w-md border border-gray-200 shadow-lg rounded-2xl p-8 bg-white">
        <!-- Logo -->
        <img src="{{ asset('images/logoin.png') }}" alt="Logo" class="mx-auto mb-4 w-20 h-20">

        <!-- Title -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-blue-600">{{ __('Log in to your account') }}</h2>
            <p class="text-sm text-gray-500 mt-1">{{ __('Enter your email and password below') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center text-sm text-blue-600" :status="session('status')" />

        <!-- Login Form -->
        <form wire:submit.prevent="login" class="space-y-5">
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    placeholder="you@example.com"
                    required
                    class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input
                    id="password"
                    type="password"
                    wire:model="password"
                    placeholder="••••••••"
                    required
                    class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
                @if (Route::has('password.request'))
                    <div class="text-right mt-2">
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input
                    wire:model="remember"
                    type="checkbox"
                    id="remember"
                    class="rounded text-blue-600 border-gray-300 shadow-sm focus:ring-blue-500"
                />
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition">
                {{ __('Log in') }}
            </button>
        </form>

        <!-- Sign Up -->
        @if (Route::has('register'))
            <div class="mt-6 text-center text-sm text-gray-600">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                    {{ __('Sign up') }}
                </a>
            </div>
        @endif
    </div>

</div>