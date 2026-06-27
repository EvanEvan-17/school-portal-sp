<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
// layout
use Livewire\Attributes\Layout;
use Google\Service\Calendar;

new #[Layout('layouts::auth')] class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember))
        {
            session()->regenerate();
            // $serviceAccountClient = new Google_Client();
            // $serviceAccountClient->setAuthConfig(config('google.service_account_credentials_path'));
            // $serviceAccountClient->setScopes([Calendar::CALENDAR_CALENDARLIST]);
            // $serviceAccountClient->setSubject(config('google.super_admin_email'));
            
            return redirect()->intended(route('dashboard'));
        }

        $this->addError('email', __('These credentials do not match our records.'));
    }
};