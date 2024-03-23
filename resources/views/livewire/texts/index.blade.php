<div class="divide-y divide-gray-200 overflow-hidden rounded-lg shadow sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">
    @foreach($texts as $text)
    <div class="rounded-tl-lg rounded-tr-lg sm:rounded-tr-none group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 hover:bg-gray-200">
        <h3 class="text-base font-semibold leading-6 text-gray-900">
            <a href="{{route('texts.read', $text->id)}}" class="focus:outline-none">
                <span class="absolute inset-0" aria-hidden="true"></span>
                {{$text->name}}
            </a>
        </h3>
    </div>
    @endforeach
</div>
