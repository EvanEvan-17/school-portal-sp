<div>
    {{-- add event --}}
    @can('add-event')
        <livewire:add-event/>
    @endcan

    {{-- calendar mode --}}
    <div
        {{-- class="**:data-[special~=containevent]:text-yellow-600 " --}}
        wire:loading.class="pointer-events-none opacity-50"
        wire:target="selectedDate"
    >
        <x-ui.calendar
            mode="single"
            wire:model.live="selectedDate"
            {{-- :special-days="[
                'containevent'   => ['2026-04-20', '2026-04-21'],
                'birthday'  => ['2026-04-15'],
                'blocked'   => ['2026-04-25', '2026-04-27'],
            ]" --}}
        />
    </div>
    <x-ui.modal 
        id="event-modal"
        width="md"
        :heading="__('Events on :date', ['date' => Carbon\Carbon::parse($selectedDate)->format('F j, Y')])"
        >
        @if($events->isEmpty())
            <p>{{ __('No events on this date.') }}</p>
        @else
            {{-- <ul>
                @foreach($events as $event)
                    <li class="list-disc list-inside mt-2">{{ $event->title . ', '. __(':start until :end', ['start' => $event->start_time->format('F j, Y g:i A'), 'end' => $event->end_time->format('F j, Y g:i A')]) }}</li>
                @endforeach
            </ul> --}}
                @foreach($events as $event)
                    {{-- <div class="border rounded-lg p-4">
                        <h3 class="font-bold">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $event->description }}</p>
                        <p class="text-xs text-gray-500 mt-2">
                            {{ $event->start_time->format('F j, Y g:i A') }} - {{ $event->end_time->format('F j, Y g:i A') }}
                        </p>
                    </div> --}}
                    <x-ui.card size="sm" class="p-4 mt-4">
                        <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
                            <span>{{ $event->title }}</span>
                        </x-ui.heading>
                        <p>{{ $event->description }}</p>
                        {{ $event->start_time->format('F j, Y g:i A') }} - {{ $event->end_time->format('F j, Y g:i A') }}
                    </x-ui.card>
                @endforeach
        @endif
    </x-ui.modal>

    {{-- table mode --}}
    
</div>