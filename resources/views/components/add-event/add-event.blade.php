<div>
    <x-ui.button wire:click="addEvent" wire:loading.attr="disabled">
        {{ __('Add event') }}
    </x-ui.button>

    <x-ui.modal 
        id="add-event-modal"
        :heading="__('Add event')"
        >
        <x-ui.field>
            <x-ui.label>{{ __('Title') }}</x-ui.label>
            <x-ui.input 
                wire:model.defer="title" 
                type="text" 
                placeholder="{{ __('Event title') }}"
            />
            <x-ui.error name="title" />
        </x-ui.field>
        {{-- description --}}
        <x-ui.field>
            <x-ui.label>{{ __('Description') }}</x-ui.label>
            <x-ui.input
                wire:model.defer="description" 
                type="text"
                placeholder="{{ __('Event description') }}"
            />
            <x-ui.error name="description" />
        </x-ui.field>
        {{-- start date --}}
        <x-ui.field>
            <x-ui.label>{{ __('Start date') }}</x-ui.label>
            <x-ui.date-picker mode="single" wire:model="start_date" />
            <x-ui.error name="start_date" />
        </x-ui.field>
        {{-- start time --}}
        <x-ui.field>
            <x-ui.label>{{ __('Start time') }}</x-ui.label>
            <x-ui.time-picker wire:model="start_time" />
            <x-ui.error name="start_time" />
        </x-ui.field>
        {{-- end date --}}
        <x-ui.field>
            <x-ui.label>{{ __('End date') }}</x-ui.label>
            <x-ui.date-picker mode="single" wire:model="end_date" />
            <x-ui.error name="end_date" />
        </x-ui.field>
        {{-- end time --}}
        <x-ui.field>
            <x-ui.label>{{ __('End time') }}</x-ui.label>
            <x-ui.time-picker wire:model="end_time" />
            <x-ui.error name="end_time" />
        </x-ui.field>
        {{-- attachment --}}
        <x-ui.field>
            <x-ui.label>{{ __('Attachment') }}</x-ui.label>
            <x-ui.input type="file" wire:model="attachment" />
            <x-ui.error name="attachment" />
        </x-ui.field>
        {{-- visibility --}}
        {{-- <x-ui.field>
            <x-ui.label>{{ __('Visibility') }}</x-ui.label>
            <x-ui.select placeholder="{{ __('Select visibility') }}" wire:model="visibility">
                <x-ui.select.option value="default">{{ __('Default') }}</x-ui.select.option>
                <x-ui.select.option value="public">{{ __('Public') }}</x-ui.select.option>
                <x-ui.select.option value="private">{{ __('Private') }}</x-ui.select.option>
            </x-ui.select>
            <x-ui.error mame="visibility" />
        </x-ui.field> --}}
        <x-ui.button wire:click="submit" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-ui.button>
    </x-ui.modal>
</div>