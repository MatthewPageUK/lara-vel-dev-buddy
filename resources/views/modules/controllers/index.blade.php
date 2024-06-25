<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.controllers.menu')
    </x-slot:menu>
    <x-slot:page></x-slot:page>
</x-lvdb::layout>
