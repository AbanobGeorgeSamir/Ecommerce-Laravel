<x-guest-layout>
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-900 text-white shadow-lg">
            <i class="bi bi-person-check text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ __('Welcome back') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('Sign in to review orders, manage your cart, and continue shopping.') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-slate-700" />
            <x-text-input id="email" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white/80 px-4 py-3 focus:border-slate-400 focus:ring-slate-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" class="font-semibold text-slate-700" />
                @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-[color:var(--store-primary)] hover:opacity-80" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
                @endif
            </div>
            <x-text-input id="password" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white/80 px-4 py-3 focus:border-slate-400 focus:ring-slate-300" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-600">
            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-slate-900 shadow-sm focus:ring-slate-400" name="remember">
            <span>{{ __('Keep me signed in on this device') }}</span>
        </label>

        <x-primary-button class="w-full justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold uppercase tracking-[0.22em] text-white transition hover:bg-slate-700">
            {{ __('Log in') }}
        </x-primary-button>
    </form>

    <div class="mt-8 border-t border-slate-200 pt-6 text-center text-sm text-slate-600">
        {{ __("Don't have an account?") }}
        <a href="{{ route('register') }}" class="font-bold text-[color:var(--store-primary)] hover:opacity-80">
            {{ __('Create one now') }}
        </a>
    </div>
</x-guest-layout>