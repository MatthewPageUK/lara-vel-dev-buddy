<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.routes.menu')
    </x-slot:menu>
    <x-slot:page></x-slot:page>
</x-lvdb::layout>
