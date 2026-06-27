<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-background font-sheaf h-full dark:bg-neutral-950">
        <x-ui.toast />
        <x-ui.layout>
            <x-ui.sidebar>
                <x-slot:brand>
                    <x-ui.brand :name="config('app.name')" href="/" />
                </x-slot:brand>
                <x-ui.navlist>
                    <x-ui.navlist.item :label="__('Dashboard')" icon="home" href="/" wire:navigate />
                    @auth
                    {{-- logout --}}
                        <x-ui.navlist.item :label="__('Events')" icon="calendar" href="{{ route('events') }}" />
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-ui.navlist.item 
                                :label="__('Log Out')" 
                                icon="arrow-left-on-rectangle" 
                                href="#"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            />
                        </form>
                    @else
                        <x-ui.navlist.item :label="__('Login')" icon="user" href="{{ route('login') }}" />
                    @endauth
                </x-ui.navlist>
                <x-ui.theme-switcher variant="stacked" />
            </x-ui.sidebar>
            <x-ui.layout.main>
                <x-ui.layout.header>
                    @auth
                        @php
                            $user = Auth::user();
                        @endphp
                        <x-ui.text>{{ __('Welcome :name (:email)', ['name' => $user->name, 'email' => $user->email]) }}</x-ui.text>
                    @endauth
                </x-ui.layout.header>
                
                <!-- Page content -->
                <div class="p-6 min-h-screen dark:bg-neutral-950 bg-white">
                    {{ $slot }}
                </div>
            </x-ui.layout.main>
        </x-ui.layout>

        @include('partials.scripts')
    </body>
</html>
