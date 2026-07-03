<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
// layout
use Livewire\Attributes\Layout;
use Google\Service\Calendar;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

new #[Layout('layouts::auth')] class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $score = RecaptchaV3::verify(request()->input('gRecaptchaResponse'), 'login');
        if($score > 0.5)
        {
            $this->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
                // 'gRecaptchaResponse' => ['required', 'recaptchav3:login,0.5']
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
        else
        {
            $this->dispatch('notify', 
                type: 'error',
                content: __('reCAPTCHA verification failed. Please try again.'),
                timeout: 4000
            );
        }
    }
};