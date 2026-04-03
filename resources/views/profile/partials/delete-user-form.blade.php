<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-bold text-slate-900">
            {{ __('Delete account') }}
        </h2>

        <p class="mt-2 text-sm text-slate-600">
            {{ __('This permanently removes your account and related data. Enter your password only if you are sure.') }}
        </p>
    </header>

    <div class="rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-sm text-red-700">
        {{ __('Once deleted, this account cannot be recovered.') }}
    </div>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-slate-900">
                {{ __('Confirm account deletion') }}
            </h2>

            <p class="mt-3 text-sm text-slate-600">
                {{ __('Please enter your password to confirm that you want to permanently delete this account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="sm:max-w-md"
                    placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>