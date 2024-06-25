<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        @include('lvdb::modules.factories.menu')
    </x-slot>
    <x-slot name="page">

        <x-lvdb::file-info-slide-over :file="$file" />

        {{-- Details --}}
        <x-lvdb::card>
            <x-slot name="title">Details</x-slot>

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
            <x-slot name="title">Output</x-slot>
            <x-lvdb::dl>
                @foreach ($output as $key => $value)
                    <x-lvdb::dl-item title="{{ $key }}">{{ is_string($value) || is_int($value) ? $value : 'unkown type' }}</x-lvdb::dl-item>
                @endforeach
            </x-lvdb::dl>

        </x-lvdb::card>

        <x-lvdb::card>
            <x-slot name="title">To Do</x-slot>
            <p>Show output - json, enum</p>
            <p>Methods ?</p>
            <p>xxx</p>
            <p>xxx</p>
        </x-lvdb::card>

    </x-slot>
</x-lvdb::layout>
