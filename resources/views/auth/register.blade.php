<x-layouts.auth :title="__('Sign up')">
    <div class="space-y-6">
        {{-- Page header --}}
        <x-auth-header :title="__('Create an account')"
            :description="__('Enter your details below to create your account')" />

        {{-- Session Status --}}
        <x-auth-session-status class="text-center" :status="session('status')" />

        {{-- Form --}}
        <x-form method="post" :action="route('register')" class="space-y-6">
            {{-- name --}}
            <x-input type="text" :label="__('Full name *')" name="name" required autofocus autocomplete="name" />

            {{-- email --}}
            <x-input type="email" :label="__('Email address *')" name="email" required autocomplete="email" />

            {{-- password --}}
            <x-input type="password" :label="__('Password *')" name="password" required autocomplete="new-password" />

            {{-- confirm password --}}
            <x-input type="password" :label="__('Confirm password *')" name="password_confirmation" required
                autocomplete="new-password" />

            {{-- account type --}}
            <x-radio-options-custom name='account_type' :radioOptions="['client', 'freelancer']" />

            {{-- legal --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                {{-- terms & conditions --}}
                <x-checkbox name='terms_and_conditions' label='Terms & Conditions *' link='/terms_and_conditions' required />

                {{-- privacy policy --}}
                <x-checkbox name='privacy_policy' label='Privacy Policy *' link='/privacy_policy' required />
            </div>

            {{-- submit btn --}}
            <x-button class="w-full">{{ __('Create account') }}</x-button>
        </x-form>

        {{-- Login nav link --}}
        <div class="space-x-1 text-center text-sm text-gray-600 dark:text-gray-400">
            {{ __('Already have an account?') }}
            <x-link :href="route('login')">
                Log in
            </x-link>
        </div>
    </div>
</x-layouts.auth>