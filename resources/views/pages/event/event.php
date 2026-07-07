<?php

use Livewire\Component;

use Google\Service\Calendar;
use App\Models\StudentClass;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Event;
// use App\Livewire\Concerns\WithSearch;

new class extends Component
{
    // use WithSearch;
    // public StudentClass $class;
    public Collection $selectedEvents;
    public Collection $events;
    public ?string $selectedDate = null;
    public $listeners = ['modal-closed' => 'onModalClosed'];
    // special days
    public function mount()
    {
        // $this->class = $class;
        $this->selectedEvents = collect();
        $this->loadEvents();
    }
    public function onModalClosed(string $id = '')
    {
        if($id == 'event-modal')
        {
            $this->selectedDate = null;
        }
    }
    public function loadEvents()
    {
        $this->events = Event::query()
            // ->when(filled($this->searchQuery), function ($query) {
            //     return $query->where('title', 'like', '%' . $this->searchQuery . '%');
            // })
            ->orderBy('start_time')
            ->get();
    }

    public function getSpecialDaysProperty()
    {
        return [
            'containevent' => $this->events
                ->pluck('start_time')
                ->map(fn ($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))
                ->toArray(),
        ];
    }

    public function loadEventsForDate(?string $date = null)
    {
        if(!empty($date))
        {
            try
            {
                $carbonDate = Carbon::parse($date);
            }
            catch(Exception $e)
            {
                $this->dispatch('notify', 
                    type: 'error',
                    content: 'Invalid date format. Please use YYYY-MM-DD.'
                );
                return;
            }
            $dayStart = $carbonDate->copy()->startOfDay();
            $dayEnd = $carbonDate->copy()->endOfDay();
            
            $this->selectedEvents = Event::where('start_time', '<=', $dayEnd)
            ->where('end_time', '>=', $dayStart)
            ->orderBy('start_time')
            ->get();
            
        }
    }
    // on change
    public function updatedSelectedDate(?string $value = null)
    {
        if(!empty($value))
        {
            $this->dispatch('close-modal', id: 'event-modal');
            // dd($carbonDate);
            $this->loadEventsForDate($value);
            $this->dispatch('open-modal', id: 'event-modal');

            // $this->dispatch('notify', 
            //     type: 'success',
            //     content: __('You selected date: :date', ['date' => $carbonDate->format('F j, Y')]),
            //     duration: 4000
            // );
        }
    }

    public function downloadFile(Event $event)
    {
        if(!empty($event->file_path))
        {
            return response()->download(storage_path('app/public/' . $event->file_path));
        }
        else
        {
            $this->dispatch('notify', 
                type: 'error',
                content: __('No file attached to this event.'),
                duration: 4000
            );
        }
    }
    public function delete(Event $event)
    {
        $this->authorize('delete-event');
        $event->delete();
        $this->loadEvents();
        $this->dispatch('notify', 
            type: 'success',
            content: __('Event deleted successfully!'),
            duration: 4000
        );
    }
};