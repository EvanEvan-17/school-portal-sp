<?php

use Livewire\Component;
use Google\Service\Directory;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Collection;

new class extends Component
{
    public int $eventsCount = 0;
    public int $studentsCount = 0;
    public int $adminsCount = 0;
    public Collection $upcomingEvents;
    public function mount()
    {
        $this->eventsCount = Event::count();
        $this->studentsCount = User::where('is_super_admin', false)->count();
        $this->adminsCount = User::where('is_super_admin', true)->count();
        $this->upcomingEvents = Event::where('start_time', '>=', now())->orderBy('start_time', 'asc')->get();
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