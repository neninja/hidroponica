<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name'))</title>

        {{ \Illuminate\Support\Facades\Vite::useBuildDirectory('/webapp-assets') }}
        @vite(['resources/sass/webapp/app.scss', 'resources/js/webapp/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased h-full">
        @auth
            <div class="min-h-full">
                <div class="bg-gray-800 pb-32">
                    <nav class="bg-gray-800">
                        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div class="border-b border-gray-700">
                                <div class="flex h-16 items-center justify-between px-4 sm:px-0">
                                    <div class="flex items-center">
                                        <div class="block">
                                            <div class="flex items-baseline space-x-4">
                                                @php
                                                    $defaultClasses = "rounded-md px-3 py-2 text-sm font-medium";
                                                    $inactiveClasses = "text-gray-300 hover:bg-gray-700 hover:text-white";
                                                    $activeClasses = "bg-gray-900 text-white";
                                              @endphp
                                              <a wire:navigate href="/app/texts" class="{{ $defaultClasses }} {{ request()->routeIs('texts.*') ? $activeClasses : $inactiveClasses }}">Textos</a>
                                              {{--<a wire:navigate href="/app/cards" class="{{ $defaultClasses }} {{ request()->routeIs('cards.*') ? $activeClasses : $inactiveClasses }}">Cartões</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block">
                                        <div class="ml-4 flex items-center md:ml-6">
                                            {{--<button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">--}}
                                                {{--<span class="absolute -inset-1.5"></span>--}}
                                                {{--<span class="sr-only">View notifications</span>--}}
                                                {{--<x-heroicon-o-bell class="inline h-6"></x-heroicon-o-bell>--}}
                                            {{--</button>--}}

                                            <!-- Profile dropdown -->
                                            <div class="relative ml-3" x-data="{open: false}">
                                                <div>
                                                    <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open">
                                                        <span class="absolute -inset-1.5"></span>
                                                        <span class="sr-only">Ações</span>
                                                        <x-heroicon-o-user class="inline h-6 text-white"></x-heroicon-o-user>
                                                    </button>
                                                </div>

                                                <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-show="open" x-transition @click.away="open = false">
                                                    <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">Sair</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <main class="-mt-32">
                    <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                        <div class="rounded-lg bg-white">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        @endauth
        @guest
            {{ $slot }}
        @endguest

        @livewireScripts
    </body>
</html>
