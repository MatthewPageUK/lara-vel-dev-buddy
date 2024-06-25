<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.factories.menu')
    </x-slot:menu>
    <x-slot:page></x-slot:page>
</x-lvdb::layout>
