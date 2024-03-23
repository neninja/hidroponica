@props([
    'disabled' => false,
    'size' => 'md',
    'labelClass' => ''
])

@php
    $name = $attributes->get('name', $attributes->whereStartsWith('wire:model')->first());
@endphp


<div>
    <div class="flex items-center justify-between">
        <label for="{{ $attributes->get('name') }}" class="block text-sm font-medium leading-6 text-white">{{ $attributes->get('label') }}</label>
    </div>
    <div class="mt-2">
        <input id="password" name="{{ $attributes->get('name') }}" {{ $attributes->merge([
            'type' => 'text',
           'class' => "block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
        ])}}>
    </div>
</div>
