<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 shadow-sm">
            <i class="bi bi-envelope-check text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ __('Verify your email') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('Before you continue, confirm your email using the link we sent you.') }}</p>
    </div>

    @if (session('status') === 'verification-link-sent')
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Resend verification email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm font-semibold text-slate-600 transition hover:text-slate-900">
                {{ __('Log out') }}
            </button>
        </form>
    </div>
</x-guest-layout>