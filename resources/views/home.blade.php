<x-lvdb::layout :title="$title">
    <x-slot:menu>
        <div class="text-white p-8">
            <h2 class="text-2xl mb-2">{{ $appName }}</h2>
            <p>Laravel Version : {{ $laravelVersion }}</p>
            <p>PHP Version : {{ $phpVersion }}</p>
        </div>
    </x-slot:menu>
    <x-slot:page></x-slot:page>
</x-lvdb::layout>
