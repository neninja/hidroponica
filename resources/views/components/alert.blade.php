<div class="rounded-md bg-blue-50 p-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <x-heroicon-s-information-circle class="w-4 text-blue-400" />
        </div>
        <div class="ml-3 flex-1 md:flex md:justify-between">
            <p class="text-sm text-blue-700">{{$title}}</p>
            <p class="mt-3 text-sm md:ml-6 md:mt-0">
            <a href="{{$href}}" class="whitespace-nowrap font-medium text-blue-700 hover:text-blue-600">
                Acesse
                <span aria-hidden="true"> &rarr;</span>
            </a>
            </p>
        </div>
    </div>
</div>
