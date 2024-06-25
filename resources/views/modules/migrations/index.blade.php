<x-lvdb::layout :title="$title">
    {{-- <x-slot:menu> --}}
        {{-- @include('lvdb::modules.factories.menu') --}}
    {{-- </x-slot:menu> --}}
    <x-slot:page>

        <x-lvdb::card>

            <x-lvdb::migrations.table :migrations="$migrations" />

        </x-lvdb::card>

    </x-slot:page>
</x-lvdb::layout>
