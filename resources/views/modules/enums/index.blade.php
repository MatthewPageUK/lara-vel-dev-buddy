<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.enums.menu')
    </x-slot:menu>
    <x-slot:page>
        <x-lvdb::card>
            <x-slot:title>About Enums</x-slot:title>
            <ul>
                <li><a href="https://www.php.net/manual/en/language.enumerations.php" target="_blank" class="text-sky-800 hover:text-sky-500 dark:text-blue-300 dark:hover:text-blue-500">PHP Enumerations</a></li>
                <li><a href="https://laravel.com/docs/10.x/routing#implicit-enum-binding" target="_blank" class="text-sky-800 hover:text-sky-500 dark:text-blue-300 dark:hover:text-blue-500">Laravel implicit enum route binding</a></li>
                <li><a href="https://laravel.com/docs/10.x/eloquent-mutators#enum-casting" target="_blank" class="text-sky-800 hover:text-sky-500 dark:text-blue-300 dark:hover:text-blue-500">Laravel Enum Casting</a></li>
                <li><a href="https://laravel.com/docs/10.x/validation#rule-enum" target="_blank" class="text-sky-800 hover:text-sky-500 dark:text-blue-300 dark:hover:text-blue-500">Laravel Enum Validation</a></li>
                <li><a href="https://laravel.com/docs/10.x/requests#retrieving-enum-input-values" target="_blank" class="text-sky-800 hover:text-sky-500 dark:text-blue-300 dark:hover:text-blue-500">Laravel retrieving request Enum input values</a></li>
            </ul>
        </x-lvdb::card>

        {{-- <p class="mt-64">Testing...</p>
        <x-lvdb::enum-maker /> --}}

    </x-slot:page>
</x-lvdb::layout>
