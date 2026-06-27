<?php

use Livewire\Component;
use App\Models\StudentClass;
use Google\Service\Directory;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Auth;
use Google\Service\Calendar\Event;
use App\Models\Event as EventModel;
use Google\Service\Calendar\EventDateTime;

new class extends Component
{
    // public StudentClass $class;
    public string $title = '';
    public string $description = '';
    public string $start_date = '';
    public string $start_time = '';
    public string $end_date = '';
    public string $end_time = '';
    public string $visibility = '';

    public function mount()
    {
        // $this->class = $class;
    }

    public function addEvent()
    {
        $this->authorize('add-event');
        $this->dispatch('open-modal', id: 'add-event-modal');
    }

    public function submit()
    {
        // dd($this->start_date, $this->start_time, $this->end_date, $this->end_time);
        $this->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:200'],
            // date time
            'start_date' => ['required', 'string', 'date_format:Y-m-d'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_date' => ['required', 'string', 'date_format:Y-m-d'],
            'end_time' => ['required', 'date_format:H:i'],
            // 'visibility' => ['required', 'in:default,public,private'],
        ]);
        $user = Auth::user();
        // $client = new Google_Client();
        // $client->setAuthConfig(config('google.service_account_credentials_path'));
        // $client->setScopes([Directory::ADMIN_DIRECTORY_USER_READONLY, Calendar::CALENDAR_EVENTS]);
        // $client->setSubject(config('google.super_admin_email'));
        // $directoryService = new Directory($client);
        // $user = $directoryService->users->get($user->google_user_id);
        // \App\Models\User::updateOrCreate(
        //     ['google_user_id' => $user->getId()],
        //     [
        //         'is_super_admin' => $user->getIsAdmin(),
        //     ]
        // );
        $this->authorize('add-event');
        // $calendarService = new Calendar($client);
        // $event = new Event();
        // $event->setSummary($this->title);
        // $event->setDescription($this->description);
        // $start = new EventDateTime();
        // $start->setDateTime($this->start_time);
        // $start->setTimeZone(config('app.timezone'));
        // $event->setStart($start);
        // $end = new EventDateTime();
        // $end->setDateTime($this->end_time);
        // $end->setTimeZone(config('app.timezone'));
        // $event->setEnd($end);
        // $event->setVisibility($this->visibility);
        // $event = $calendarService->events->insert($this->class->google_calendar_id, $event);
        // join date and time
        $this->visibility = 'default';
        EventModel::create([
            // 'google_calendar_event_id' => $event->getId(),
            'google_calendar_event_id' => '',
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $this->start_date . ' ' . $this->start_time,
            'end_time' => $this->end_date . ' ' . $this->end_time,
            'visibility' => $this->visibility,
        ]);
        $this->dispatch('notify', 
            type: 'success',
            content: __('Event added successfully!'),
            duration: 4000
        );
        $this->dispatch('close-modal', id: 'add-event-modal');
    }
};