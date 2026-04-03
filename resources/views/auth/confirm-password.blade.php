<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-700 shadow-sm">
            <i class="bi bi-lock text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ __('Confirm your password') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('This protected area needs one more quick confirmation before you continue.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            {{ __('Confirm') }}
        </x-primary-button>
    </form>
</x-guest-layout>