<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        @include('lvdb::modules.middleware.menu')
    </x-slot>
    <x-slot name="page">

        {{-- Global Middleware --}}
        <x-lvdb::card>
            <x-slot name="title">Global Middleware</x-slot>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>Middleware</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($middlewareGlobal as $global)
                    <x-lvdb::tr>
                        <x-lvdb::td>
                            @if ($global->url)
                                <x-lvdb::a href="{{ $global->url }}">{{ $global->name }}</x-lvdb::a>
                            @else
                                {{ $global->name }}
                            @endif
                        </x-lvdb::td>
                    </x-lvdb::tr>
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>

        {{-- Middleware Groups --}}
        <x-lvdb::card>
            <x-slot name="title">Middleware Groups</x-slot>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>Group</x-lvdb::th>
                    <x-lvdb::th>Middleware</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($middlewareGroups as $group => $groupMiddlewares)
                    @foreach ($groupMiddlewares as $middlewareName)
                        <x-lvdb::tr>
                            <x-lvdb::td>{{ $group }}</x-lvdb::td>
                            <x-lvdb::td>
                                {{ $middlewareName }}
                            </x-lvdb::td>
                        </x-lvdb::tr>
                    @endforeach
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>



        {{-- Middleware Alias --}}
        <x-lvdb::card>
            <x-slot name="title">Middleware Aliases</x-slot>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>Alias</x-lvdb::th>
                    <x-lvdb::th>Middleware</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($middlewareAlias as $alias => $middlewareName)
                    <x-lvdb::tr>
                        <x-lvdb::td>{{ $alias }}</x-lvdb::td>
                        <x-lvdb::td>{{ $middlewareName }}</x-lvdb::td>
                    </x-lvdb::tr>
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>

    </x-slot>
</x-lvdb::layout>
