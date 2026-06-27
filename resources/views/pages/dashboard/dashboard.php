<?php

use Livewire\Component;
use Google\Service\Directory;

new class extends Component
{
    public function mount()
    {
        // $client = new Google_Client();
        // $client->setAuthConfig(config('google.service_account_path'));
        // $client->setScopes([
        //     Directory::ADMIN_DIRECTORY_USER_READONLY
        // ]);
        // $client->setSubject(env('GOOGLE_SUPER_ADMIN_EMAIL'));
        // $directory = new Directory($client);
        // // user with email ''
        // $user = $directory->users->get(env('GOOGLE_SUPER_ADMIN_EMAIL'));
        // dd($user);
    }
};