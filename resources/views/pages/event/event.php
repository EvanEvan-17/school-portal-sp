<?php

use Livewire\Component;

use Google\Service\Calendar;
use App\Models\StudentClass;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Event;

new class extends Component
{
    // public StudentClass $class;
    public Collection $events;
    public Collection $allEvents;
    public ?string $selectedDate = null;
    public $listeners = ['modal-closed' => 'onModalClosed'];
    public function mount()
    {
        // $this->class = $class;
        $this->events = collect();
    }
    public function onModalClosed(string $id = '')
    {
        if($id == 'event-modal')
        {
            $this->selectedDate = null;
        }
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
            
            $this->events = Event::query()
            ->where('start_time', '<=', $dayEnd)
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

    public function delete(Event $event)
    {
        $this->authorize('delete-event');
        $event->delete();
        if(!empty($this->selectedDate))
        {
            $this->loadEventsForDate($this->selectedDate);
        }
        $this->dispatch('notify', 
            type: 'success',
            content: __('Event deleted successfully!'),
            duration: 4000
        );
    }
};