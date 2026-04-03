<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-sky-100 text-sky-700 shadow-sm">
            <i class="bi bi-shield-lock text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ __('Choose a new password') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('Set a secure password to restore access to your account.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('New password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Choose a secure password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm new password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            {{ __('Reset password') }}
        </x-primary-button>
    </form>
</x-guest-layout>