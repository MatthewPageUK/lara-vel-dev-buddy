<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        <div class="text-white p-8">
            <h2 class="text-2xl mb-2">{{ $appName }}</h2>
            <p>Laravel Version : {{ $laravelVersion }}</p>
            <p>PHP Version : {{ $phpVersion }}</p>
        </div>
    </x-slot>
    <x-slot name="page"></x-slot>
</x-lvdb::layout>
