<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <title>{{ $title ?? config('app.name') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:100,200,300,400,500,600,900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style type="text/tailwindcss">
            @layer utilities {
              .content-auto {
                content-visibility: auto;
              }
            }
          </style>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
          </script>
    </head>
    <body class="bg-white text-black dark:bg-zinc-900 dark:text-white" style="font-family: figtree">
        <div class="h-screen flex">
            {{-- Main menu --}}
            <nav class="bg-sky-900 w-64 flex-none dark:bg-zinc-900">
                <ul>
                    <li>
                        <x-lvdb::menu-button
                            title="Home"
                            icon="home"
                            route="lara-vel-dev-buddy.home"
                            :active="request()->routeIs('lara-vel-dev-buddy.home')"
                        >Home</x-lvdb::menu-button>
                    </li>
                    @foreach ($config::getModules() as $module)
                        <li>
                            <x-lvdb::menu-button
                                title="{{ $module::getName() }}"
                                icon="{{ $module::getIcon() }}"
                                route="{{ $module::getRouteName('index') }}"
                                :active="request()->routeIs($module::getRouteName('*'))"
                            >{{ $module::getName() }}</x-lvdb::menu-button>
                        </li>
                    @endforeach
                </ul>
            </nav>
            {{-- Sub menu --}}
            @if (isset($menu))
                <nav class="h-screen overflow-y-auto text-sm bg-sky-700 flex-shrink min-w-64 dark:bg-zinc-800">
                    {{ $menu }}
                </nav>
            @endif
            {{-- Page --}}
            <main class="h-screen overflow-y-auto bg-gradient-to-r from-sky-200 to-white flex-grow p-8 dark:bg-none dark:bg-black">
                {{ $page }}
            </main>
        </div>
    </body>
</html>
