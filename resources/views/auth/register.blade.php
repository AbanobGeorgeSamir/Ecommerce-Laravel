<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--store-primary)] text-white shadow-lg">
            <i class="bi bi-stars text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ __('Create your account') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('Join the store to save time at checkout and keep your orders in one place.') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full name')" class="font-semibold text-slate-700" />
            <x-text-input id="name" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white/80 px-4 py-3 focus:border-slate-400 focus:ring-slate-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email address')" class="font-semibold text-slate-700" />
            <x-text-input id="email" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white/80 px-4 py-3 focus:border-slate-400 focus:ring-slate-300" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="font-semibold text-slate-700" />
            <x-text-input id="password" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white/80 px-4 py-3 focus:border-slate-400 focus:ring-slate-300" type="password" name="password" required autocomplete="new-password" placeholder="Choose a secure password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm password')" class="font-semibold text-slate-700" />
            <x-text-input id="password_confirmation" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white/80 px-4 py-3 focus:border-slate-400 focus:ring-slate-300" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold uppercase tracking-[0.22em] text-white transition hover:bg-slate-700">
            {{ __('Create account') }}
        </x-primary-button>
    </form>

    <div class="mt-8 border-t border-slate-200 pt-6 text-center text-sm text-slate-600">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="font-bold text-[color:var(--store-primary)] hover:opacity-80">
            {{ __('Sign in') }}
        </a>
    </div>
</x-guest-layout>