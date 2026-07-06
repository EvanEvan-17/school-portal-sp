<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Event as EventModel;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;

new class extends Component
{
    // public StudentClass $class;
    use WithFileUploads;
    public string $title = '';
    public string $description = '';
    public string $start_date = '';
    public string $start_time = '';
    public string $end_date = '';
    public string $end_time = '';
    public string $visibility = '';
    public ?UploadedFile $attachment = null;

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
        dd($this->start_date);
        // dd($this->start_date, $this->start_time, $this->end_date, $this->end_time);
        $this->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:200'],
            // date time
            'start_date' => ['required', 'string', 'date_format:Y-m-d'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_date' => ['required', 'string', 'date_format:Y-m-d'],
            'end_time' => ['required', 'date_format:H:i'],
            'attachment' => ['nullable', 'file', 'max:10240'], // max 10MB
            // 'visibility' => ['required', 'in:default,public,private'],
        ]);
        $user = Auth::user();
        $this->authorize('add-event');
        if(!empty($this->attachment))
        {
            $path = $this->attachment->store('attachments', 'public');
        }
        $this->visibility = 'default';
        EventModel::create([
            // 'google_calendar_event_id' => $event->getId(),
            'google_calendar_event_id' => '',
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $this->start_date . ' ' . $this->start_time,
            'end_time' => $this->end_date . ' ' . $this->end_time,
            'visibility' => $this->visibility,
            'attachment' => !empty($path) ? $path : null,
        ]);
        $this->dispatch('notify', 
            type: 'success',
            content: __('Event added successfully!'),
            duration: 4000
        );
        $this->dispatch('close-modal', id: 'add-event-modal');
    }
};