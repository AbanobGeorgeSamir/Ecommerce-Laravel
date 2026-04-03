<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">
            {{ __('Profile information') }}
        </h2>

        <p class="mt-2 text-sm text-slate-600">
            {{ __("Update your name and email so orders and account messages stay accurate.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                <p class="font-medium">{{ __('Your email address is not verified yet.') }}</p>
                <button form="send-verification" class="mt-2 font-semibold text-amber-900 underline underline-offset-4 hover:opacity-80">
                    {{ __('Resend verification email') }}
                </button>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 text-emerald-700">{{ __('A new verification link has been sent to your email address.') }}</p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-primary-button>{{ __('Save changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm font-medium text-emerald-700">{{ __('Profile updated successfully.') }}</p>
            @endif
        </div>
    </form>
</section>