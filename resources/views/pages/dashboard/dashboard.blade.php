
<div>
    <div class="grid grid-cols-3 gap-4 mt-4">
        <x-ui.card size="xs">
            <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
                <span>{{ __('Events') }}</span>
            </x-ui.heading>
            <h2 class="text-4xl">{{ $eventsCount }}</h2>
        </x-ui.card>
        <x-ui.card size="xs">
            <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
                <span>{{ __('Students') }}</span>
            </x-ui.heading>
            <h2 class="text-4xl">{{ $studentsCount }}</h2>
        </x-ui.card>
        <x-ui.card size="xs">
            <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
                <span>{{ __('Admins') }}</span>
            </x-ui.heading>
            <h2 class="text-4xl">{{ $adminsCount }}</h2>
        </x-ui.card>
    </div>
    <x-ui.card class="mt-6" size="xs">
        <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
            <span>{{ __('Upcoming events') }}</span>
        </x-ui.heading>
        @if($upcomingEvents->isEmpty())
            <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ __('No upcoming events.') }}</p>
        @else
            <ul class="list-disc list-inside mt-2">
                @foreach($upcomingEvents as $event)
                    <li class="mt-2">
                        <span class="font-semibold">{{ $event->title }}</span> - 
                        {{ __(':start until :end', ['start' => $event->start_time->format('F j, Y g:i A'), 'end' => $event->end_time->format('F j, Y g:i A')]) }}
                    </li>
                @endforeach
            </ul>
        @endif
    </x-ui.card>
</div>