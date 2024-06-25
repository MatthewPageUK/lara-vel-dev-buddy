<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        @include('lvdb::modules.commands.menu')
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
                <x-lvdb::dl-item title="Name">{{ $instance->getName() }}</x-lvdb::dl-item>
                <x-lvdb::dl-item title="Description">
                    @if ($instance->getDescription() !== '')
                        {{ $instance->getDescription() }}
                    @else
                        <x-lvdb::code-suggestion>Add the 'protected $description' property to this command</x-lvdb::code-suggestion>
                    @endif
                </x-lvdb::dl-item>
                <x-lvdb::dl-item title="Help">
                    @if ($instance->getHelp() !== '')
                        {{ $instance->getHelp() }}
                    @else
                        <x-lvdb::code-suggestion>Add the 'protected $help' property to this command</x-lvdb::code-suggestion>
                    @endif
                </x-lvdb::dl-item>
                <x-lvdb::dl-item title="Synopsis">{{ $instance->getSynopsis() }}</x-lvdb::dl-item>
                <x-lvdb::dl-item title="Is hidden">{{ $instance->isHidden() ? 'Yes' : 'No' }}</x-lvdb::dl-item>
            </x-lvdb::dl>
        </x-lvdb::card>

        {{-- Schedule --}}
        <x-lvdb::card>
            <x-slot name="title">Schedule</x-slot>
            @foreach ($schedule as $event)
                <div class="py-1 px-4 rounded-xl bg-sky-800 text-white font-medium dark:bg-zinc-600">
                    {{ $event->command }}
                </div>
                <x-lvdb::dl>
                    <x-lvdb::dl-item title="Environments">{{ $event->environments }}</x-lvdb::dl-item>
                    <x-lvdb::dl-item title="Cron Expression"><x-lvdb::cron-table :expression="$event->expression" /></x-lvdb::dl-item>
                    <x-lvdb::dl-item title="Next run">
                        <div class="flex">
                            <span>{{ $event->nextRunDate }}</span>
                            <span class="flex-1 text-right">{{ $event->nextRunDiff }}</span>
                        </div>
                    </x-lvdb::dl-item>
                    <x-lvdb::dl-item title="Previous run">
                        <div class="flex">
                            <span>{{ $event->previousRunDate }}</span>
                            <span class="flex-1 text-right">{{ $event->previousRunDiff }}</span>
                        </div>
                    </x-lvdb::dl-item>
                </x-lvdb::dl>
            @endforeach
        </x-lvdb::card>

        {{-- Methods --}}
        <x-lvdb::methods-card :reflection="$reflection" :methods="$methods" :methodSignatures="$methodSignatures" :methodTraits="$methodTraits" />

        <x-lvdb::card>
            <x-slot name="title">To Do</x-slot>
            <p>Methods</p>
            <p>Traits</p>
            <p>Is scheduled</p>
            <p>Run command ?</p>
            <p>What does it do?</p>
        </x-lvdb::card>

    </x-slot>
</x-lvdb::layout>
