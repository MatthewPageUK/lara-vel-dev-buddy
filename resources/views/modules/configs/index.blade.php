<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        @include('lvdb::modules.configs.menu')
    </x-slot>
    <x-slot name="page"></x-slot>
</x-lvdb::layout>
