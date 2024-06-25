<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.configs.menu')
    </x-slot:menu>
    <x-slot:page>

        {{-- Details --}}
        <x-lvdb::card>
            <x-slot:title>Config</x-slot:title>
            {{-- Linked path --}}
            <div class="flex py-1 px-4 rounded-xl bg-sky-800 text-white font-medium dark:bg-zinc-600">
                @php($baseKey = null)
                @foreach (explode('.', $config) as $key)
                    @php($baseKey = $baseKey .= ($baseKey ? '.' : '') . $key)
                    <div>{{ $loop->first ? '' : '.' }}</div>
                    <x-lvdb::a href="{{ $module::getRoute('show', $baseKey) }}" class="hover:underline">{{ $key }}</x-lvdb::a>
                @endforeach
            </div>

            {{-- Sub configs --}}
            <div class="mt-2">
                @foreach ($values as $key => $value)
                    @if (is_array($value))
                        <div class="flex items-center mt-1">
                            <span class="material-symbols-outlined">arrow_right</span> <a href="{{ $module::getRoute('show', $config . '.' . $key) }}"
                                class="hover:underline">{{ $key }}</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </x-lvdb::card>

        {{-- Config values --}}
        <x-lvdb::card>
            <x-slot:title>Values</x-slot:title>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>Key</x-lvdb::th>
                    <x-lvdb::th>Value</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($flattened as $key => $value)
                    <x-lvdb::tr>
                        <x-lvdb::td>{{ $config }}.{{ $key }}</x-lvdb::td>
                        <x-lvdb::td>{{ $value }}</x-lvdb::td>
                    </x-lvdb::tr>
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>

        <x-lvdb::card>
            <x-slot:title>To Do</x-slot:title>
            <p>Find usage of values...</p>
            <p>xxx</p>
            <p>xxx</p>
            <p>xxxx</p>
        </x-lvdb::card>

    </x-slot:page>
</x-lvdb::layout>
