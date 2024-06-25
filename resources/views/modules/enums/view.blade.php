<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        @include('lvdb::modules.enums.menu')
    </x-slot>
    <x-slot name="page">
        {{-- Main Page --}}

        {{-- File info slide over --}}
        <div class="mb-2">
            <x-lvdb::file-info-slide-over :file="$file" />
        </div>

        <x-lvdb::card>
            <x-slot name="title">Details</x-slot>

            <div class="py-1 px-4 rounded-xl bg-sky-800 text-white font-medium dark:bg-zinc-600">
                {{ $reflection->getName() }}
            </div>

            <x-lvdb::comment-recommended :comment="$comment" />

            <x-lvdb::details-list>
                @if ($reflection->isBacked())
                    <x-lvdb::details-list-item title="Backed">{{ $reflection->getBackingType()->getName() }}</x-lvdb::details-list-item>
                @endif
            </x-lvdb::details-list>
        </x-lvdb::card>


    <x-lvdb::card>
        <x-slot name="title">Cases</x-slot>

        <div class="grid gap-2 flex-1" x-data="{ open: false }">
            @foreach ($cases as $case)
                <div
                    x-data="{
                        label: '{{ $case->name }}',
                        hasContent: {{ $getters->count() > 0 ? 'true' : 'false' }},
                        get isOpen() { return this.open == this.label },
                    }"
                >
                    <div
                        class="flex items-center gap-2 py-1 px-4 rounded-xl bg-sky-800 text-white dark:bg-zinc-600"
                        :class="{
                            'cursor-pointer hover:bg-sky-700': hasContent,
                            'bg-sky-700': isOpen
                        }"
                        x-on:click="if (hasContent) open = isOpen ? '' : label"
                    >
                        <span class="font-medium">{{ $case->name }}</span>
                        @if ($reflection->isBacked())
                            <span class="text-sm material-symbols-outlined">arrow_right_alt</span>
                            <span>{{ $case->value }}</span>
                        @endif
                        <span class="flex-1 text-right text-sm">{{ $reflection->getShortName() }}::{{ $case->name }}</span>

                        <span class="material-symbols-outlined" x-show="hasContent" x-text="isOpen ? 'expand_circle_up' : 'expand_circle_down'"></span>
                        <span class="material-symbols-outlined" x-show="! hasContent">horizontal_rule</span>
                    </div>

                    <div x-show="isOpen">
                        @if ($getters->count() > 0)
                            <div class="ml-2 mr-2 mt-1">
                                @foreach ($getters as $getter)
                                    <div class="text-sm flex gap-1 p-0.5 px-2 rounded-md">
                                        <span class="font-medium min-w-48">{{ $getter->name }}()</span>
                                        <span class="text-sm material-symbols-outlined">arrow_right_alt</span>
                                        <span class="flex-1">{{ $enumClass::tryFrom($case->value)?->{$getter->name}() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </x-lvdb::card>

    @if (count($references) > 0)
        <x-lvdb::card>
            <x-slot name="title">Used in</x-slot>
            <div class="flex flex-wrap gap-2">
                @foreach ($references as $reference)
                    <div class="w-full flex items-center gap-2 py-1 px-4 rounded-xl bg-sky-800 text-white dark:bg-zinc-600">
                        <span class="font-medium">{{ $reference }}</span>
                    </div>
                @endforeach
            </div>
        </x-lvdb::card>
    @endif

    @if (count($interfaces) > 0)
        <x-lvdb::card>
            <x-slot name="title">Interfaces</x-slot>
            <div class="flex flex-wrap gap-2">
                @foreach ($interfaces as $interface)
                    <div class="w-full flex items-center gap-2 py-1 px-4 rounded-xl bg-sky-800 text-white dark:bg-zinc-600">
                        <span class="font-medium">{{ $interface->name }}</span>
                    </div>
                @endforeach
            </div>
        </x-lvdb::card>
    @endif

    @if (count($traits) > 0)
        <x-lvdb::card>
            <x-slot name="title">Traits</x-slot>
            <div class="flex flex-wrap gap-2">
                @foreach ($traits as $trait)
                    <div class="w-full flex items-center gap-2 py-1 px-4 rounded-xl bg-sky-800 text-white font-medium dark:bg-zinc-600">
                        <span class="font-medium">{{ $trait->name }}</span>
                    </div>
                @endforeach
            </div>
        </x-lvdb::card>
    @endif

    <x-lvdb::card>
        <x-slot name="title">Methods</x-slot>
        <div class="grid gap-2 flex-1" x-data="{ open: false }">
            @foreach ($methods as $method)
                <div
                    x-data="{
                        label: '{{ $method['method']->getShortName() }}',
                        hasContent: {{ $method['method']->getDocComment() ? 'true' : 'false' }},
                        get isOpen() { return this.open == this.label },
                    }"
                >
                    <div
                        class="flex items-center gap-2 py-1 px-4 rounded-xl bg-sky-800 text-white dark:bg-zinc-600"
                        :class="{
                            'cursor-pointer hover:bg-sky-700': hasContent,
                            'bg-sky-700': isOpen
                        }"
                        x-on:click="if (hasContent) open = isOpen ? '' : label"
                    >
                        <span>
                            {{ $method['method']->isPublic() ? 'public ' : '' }}
                            {{ $method['method']->isProtected() ? 'protected ' : '' }}
                            {{ $method['method']->isPrivate() ? 'private ' : '' }}
                            {{ $method['method']->isStatic() ? 'static ' : '' }}
                            <span class="font-medium">{{ $method['signature'] }}</span>: {{ $method['method']->getReturnType() }}
                        </span>
                        <span class="flex-1 text-right text-sm text-white">{{ $method['trait']?->getName() }}</span>

                        <span class="material-symbols-outlined" x-show="hasContent" x-text="isOpen ? 'expand_circle_up' : 'expand_circle_down'"></span>
                        <span class="material-symbols-outlined" x-show="! hasContent">horizontal_rule</span>
                    </div>

                    <div x-show="isOpen">
                        <x-lvdb::code>
                            {{ $method['method']->getDocComment() }}
                        </x-lvdb::code>
                    </div>

                </div>

            @endforeach
        </div>
    </x-lvdb::card>

    </x-slot>
</x-lvdb::layout>