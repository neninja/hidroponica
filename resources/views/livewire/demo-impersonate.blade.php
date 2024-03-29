<div class="flex min-h-full flex-col justify-center items-center text-gray-300" x-data>
    <div class="w-full max-w-2xl">
        <p class="mb-10 text-gray-300">Caso só esteja querendo ver a nivel tecnico como foi feito o sistema, escolha um dos acessos de leitura abaixo</p>
        <ul role="list" class="divide-y divide-gray-600 bg-slate-700">
            @foreach($platforms as $action => $platform)
            <li class="relative py-5 hover:bg-slate-800 cursor-pointer">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto flex max-w-4xl justify-between gap-x-6">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6">
                                <a role="link" @click="$dispatch('{{$action}}')" aria-label="{{$platform['name']}}">
                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                    {{$platform['name']}}
                                </a>
                                </p>
                                <p class="mt-1 flex text-xs leading-5">{{$platform['description']}}</p>
                            </div>
                        </div>
                        <div class="flex shrink-0 items-center gap-x-4">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6">{{implode('/', $platform['stack'])}}</p>
                            </div>
                            <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
