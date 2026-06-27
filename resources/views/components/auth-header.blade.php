@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <x-ui.heading size="lg">{{ $title }}</x-ui.heading>
    <x-ui.separator class="my-2" vertical />
    <x-ui.heading size="sm">{{ $description }}</x-ui.heading>
</div>
