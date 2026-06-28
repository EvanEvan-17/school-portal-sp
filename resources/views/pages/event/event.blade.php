<div>
    {{-- add event --}}
    @can('add-event')
        <livewire:add-event/>
    @endcan

    <x-ui.tabs variant="pills">
        <x-ui.tab.group>
            <x-ui.tab name="calendar-mode" :label="__('Calendar mode')" />
            <x-ui.tab name="table-mode" :label="__('Table mode')" />
        </x-ui.tab.group>
        <x-ui.tab.panel name="calendar-mode">
            {{-- calendar mode --}}
            <div
                class="**:data-[special~=containevent]:text-yellow-600 "
                wire:loading.class="pointer-events-none opacity-50"
                wire:target="selectedDate"
            >
                <x-ui.calendar
                    mode="single"
                    wire:model.live="selectedDate"
                    :special-days="$this->specialDays"
                />
            </div>
            <x-ui.modal 
                id="event-modal"
                width="md"
                :heading="__('Events on :date', ['date' => Carbon\Carbon::parse($selectedDate)->format('F j, Y')])"
                >
                @if($selectedEvents->isEmpty())
                    <p>{{ __('No events on this date.') }}</p>
                @else
                    {{-- <ul>
                        @foreach($selectedEvents as $event)
                            <li class="list-disc list-inside mt-2">{{ $event->title . ', '. __(':start until :end', ['start' => $event->start_time->format('F j, Y g:i A'), 'end' => $event->end_time->format('F j, Y g:i A')]) }}</li>
                        @endforeach
                    </ul> --}}
                        @foreach($selectedEvents as $selectedEvent)
                            {{-- <div class="border rounded-lg p-4">
                                <h3 class="font-bold">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                                <p class="text-xs text-gray-500 mt-2">
                                    {{ $event->start_time->format('F j, Y g:i A') }} - {{ $event->end_time->format('F j, Y g:i A') }}
                                </p>
                            </div> --}}
                            <x-ui.card size="sm" class="p-4 mt-4">
                                <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
                                    <span>{{ $selectedEvent->title }}</span>
                                </x-ui.heading>
                                <p>{{ $selectedEvent->description }}</p>
                                {{ $selectedEvent->start_time->format('F j, Y g:i A') }} - {{ $selectedEvent->end_time->format('F j, Y g:i A') }}
                            </x-ui.card>
                        @endforeach
                @endif
            </x-ui.modal>
        </x-ui.tab.panel>
        <x-ui.tab.panel name="table-mode">
            <x-ui.table>
                <x-ui.table.header>
                    <x-ui.table.columns>
                        <x-ui.table.head>{{ __('#') }}</x-ui.table.head>
                        <x-ui.table.head>{{ __('Details') }}</x-ui.table.head>
                        <x-ui.table.head>{{ __('Start') }}</x-ui.table.head>
                        <x-ui.table.head>{{ __('End') }}</x-ui.table.head>
                        @can('delete-event')
                            <x-ui.table.head>{{ __('Actions') }}</x-ui.table.head>
                        @endcan
                    </x-ui.table.columns>
                </x-ui.table.header>

                <x-ui.table.rows>
                    @forelse($events as $event)
                        <x-ui.table.row :key="$event->id">
                            <x-ui.table.cell sticky class="dark:bg-neutral-950 bg-neutral-50">
                                {{ $loop->iteration }}
                            </x-ui.table.cell>
                            
                            <x-ui.table.cell>
                                <div class="max-w-xs">
                                    <div class="font-medium text-neutral-900 dark:text-neutral-100">
                                        {{ $event->title }}
                                    </div>
                                    <div class="text-xs text-neutral-500 dark:text-neutral-400 mt-1 line-clamp-2">
                                        {{ $event->description }}
                                    </div>
                                </div>
                            </x-ui.table.cell>
                            
                            <x-ui.table.cell>
                                <div class="text-sm text-neutral-700 dark:text-neutral-300">
                                    {{ $event->start_time->format('F j, Y g:i A') }}
                                </div>
                            </x-ui.table.cell>

                            <x-ui.table.cell>
                                <div class="text-sm text-neutral-700 dark:text-neutral-300">
                                    {{ $event->end_time->format('F j, Y g:i A') }}
                                </div>
                            </x-ui.table.cell>

                            @can('delete-event')
                                <x-ui.table.cell>
                                    <div class="flex gap-2">
                                        <x-ui.button size="sm" color="red" wire:click="delete({{ $event->id }})">
                                            {{ __('Delete') }}
                                        </x-ui.button>
                                    </div>
                                </x-ui.table.cell>
                            @endcan
                            
                        </x-ui.table.row>
                    @empty
                        <x-ui.table.row>
                            <x-ui.table.cell colspan="4" class="text-center text-muted-foreground">
                                {{ __('No events found.') }}
                            </x-ui.table.cell>
                        </x-ui.table.row>
                    @endforelse
                </x-ui.table.rows>
            </x-ui.table>
        </x-ui.tab.panel>
    </x-ui.tabs>
</div>