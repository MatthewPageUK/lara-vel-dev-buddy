<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.factories.menu')
    </x-slot:menu>
    <x-slot:page>

        <x-lvdb::file-info-slide-over :file="$file" />

        {{-- Details --}}
        <x-lvdb::card>
            <x-slot:title>Details</x-slot:title>

            <div class="py-1 px-4 rounded-xl bg-sky-800 text-white font-medium dark:bg-zinc-600">
                {{ $reflection->getName() }}
            </div>

            <x-lvdb::comment-recommended :comment="$comment" />

            <x-lvdb::dl>
                <x-lvdb::dl-item title="Model">
                    <x-lvdb::a href="{{ $model->url }}">
                        {{ $model->class }}
                    </x-lvdb::a>
                </x-lvdb::dl-item>
            </x-lvdb::dl>
        </x-lvdb::card>

        <x-lvdb::card>
            <x-slot:title>Output</x-slot:title>
            <x-lvdb::dl>
                @foreach ($output as $key => $value)
                    <x-lvdb::dl-item title="{{ $key }}">{{ is_string($value) || is_int($value) ? $value : 'unkown type' }}</x-lvdb::dl-item>
                @endforeach
            </x-lvdb::dl>

        </x-lvdb::card>

        <x-lvdb::card>
            <x-slot:title>To Do</x-slot:title>
            <p>Show output - json, enum</p>
            <p>Methods ?</p>
            <p>xxx</p>
            <p>xxx</p>
        </x-lvdb::card>

    </x-slot:page>
</x-lvdb::layout>
