
<div class="flex flex-col gap-6">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />
        <form wire:submit.prevent="login" class="flex flex-col gap-6">
            <!-- Email Address -->
            <x-ui.field>
                <x-ui.label>{{ __('Email address') }}</x-ui.label>
                <x-ui.input
                    wire:model="email"
                    type="text"
                    placeholder="john@example.com"
                />
                <x-ui.error name="email" />
            </x-ui.field>
            {{-- <x-mary-input :label="__('Username or email address')" type="text" autofocus autocomplete="email" placeholder="email@example.com" wire:model="email" /> --}}

            <!-- Password -->
            <div class="relative">
                <x-ui.field>
                    <x-ui.label>{{ __('Password') }}</x-ui.label>
                    <x-ui.input 
                        wire:model="password"
                        type="password"
                    />
                    <x-ui.error name="password" />
                </x-ui.field>
            </div>

            <!-- Remember Me -->
            {{-- <x-mary-checkbox wire:model="remember" :label="__('Remember me')" /> --}}
            <x-ui.checkbox 
                wire:model="remember"
                :label="__('Remember me')"
                />

            <div class="flex items-center justify-end">
                {{-- <x-mary-button type="submit" class="w-full btn-primary" :label="__('Log in')"/> --}}
                <x-ui.button type="submit">
                    {{ __('Log in') }}
                </x-ui.button>
            </div>
            
        </form>
    </div>