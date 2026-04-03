<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100 text-amber-700 shadow-sm">
            <i class="bi bi-key text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ __('Reset your password') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('Enter your account email and we will send you a reset link.') }}</p>
    </div>

    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            {{ __('Email password reset link') }}
        </x-primary-button>

        <div class="text-center text-sm text-slate-600">
            <a href="{{ route('login') }}" class="font-semibold text-[color:var(--store-primary)] hover:opacity-80">{{ __('Back to login') }}</a>
        </div>
    </form>
</x-guest-layout>