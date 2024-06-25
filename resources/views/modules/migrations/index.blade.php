<x-lvdb::layout :title="$title">
    {{-- <x-slot name="menu"> --}}
        {{-- @include('lvdb::modules.factories.menu') --}}
    {{-- </x-slot> --}}
    <x-slot name="page">

        <x-lvdb::card>

            <x-lvdb::migrations.table :migrations="$migrations" />

        </x-lvdb::card>

    </x-slot>
</x-lvdb::layout>
