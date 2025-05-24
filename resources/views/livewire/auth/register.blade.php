<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-white px-4">
    <div class="w-full max-w-md border border-gray-200 shadow-lg rounded-2xl p-8">
 <img src="{{ asset('images/logoin.png') }}" alt="Logo" class="mx-auto mb-4 w-20 h-20">
        <!-- Header -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-blue-600">{{ __('Create an account') }}</h2>
            <p class="text-sm text-gray-500 mt-1">{{ __('Enter your details below to create your account') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center text-sm text-blue-600" :status="session('status')" />

        <!-- Register Form -->
        <form wire:submit="register" class="space-y-5">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input
                    id="name"
                    type="text"
                    wire:model="name"
                    placeholder="Full name"
                    required
                    autofocus
                    class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    placeholder="email@example.com"
                    required
                    autocomplete="email"
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
                    autocomplete="new-password"
                    class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                <input
                    id="password_confirmation"
                    type="password"
                    wire:model="password_confirmation"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                    class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition">
                {{ __('Create account') }}
            </button>
        </form>

        <!-- Already have an account -->
        <div class="mt-6 text-center text-sm text-gray-600">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">
                {{ __('Log in') }}
            </a>
        </div>
    </div>
</div>
