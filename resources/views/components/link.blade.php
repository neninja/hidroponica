@props(['href' => '#'])

<a href="{{ $href }}" class="font-semibold leading-6 text-indigo-400 hover:text-indigo-300">
    {{ $slot }}
</a>
