<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        @include('lvdb::modules.middleware.menu')
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
                <x-lvdb::dl-item title="Namespace">{{ $reflection->getNamespaceName() }}</x-lvdb::dl-item>
            </x-lvdb::dl>

        </x-lvdb::card>

        {{-- Methods --}}
        <x-lvdb::card>
            <x-slot name="title">Methods</x-slot>

            <div class="grid gap-2 flex-1" x-data="{ open: false }">
                @foreach ($methods as $method)
                    <div
                        x-data="{
                            label: '{{ $method->getShortName() }}',
                            hasContent: {{ $method->getDocComment() ? 'true' : 'false' }},
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
                                {{ $method->isPublic() ? 'public ' : '' }}
                                {{ $method->isProtected() ? 'protected ' : '' }}
                                {{ $method->isPrivate() ? 'private ' : '' }}
                                {{ $method->isStatic() ? 'static ' : '' }}
                                <span class="font-medium">{{ $methodSignatures[$method->getShortName()] }}</span>: {{ $method->getReturnType() }}
                            </span>
                            {{-- <span class="flex-1 text-right text-sm text-white">{{ $methodTraits[$method->getShortName()]?->getName() }}</span> --}}
                            <span class="flex-1 text-right text-sm text-white">{{ $method->getDeclaringClass()?->getName() }}</span>
                            <span class="material-symbols-outlined" x-show="hasContent" x-text="isOpen ? 'expand_circle_up' : 'expand_circle_down'"></span>
                            <span class="material-symbols-outlined" x-show="! hasContent">horizontal_rule</span>
                        </div>

                        <div x-show="isOpen">
                            <x-lvdb::code>
                                {{ $method->getDocComment() }}
                            </x-lvdb::code>
                        </div>

                    </div>

                @endforeach
            </div>
        </x-lvdb::card>

        <x-lvdb::card>
            <x-slot name="title">To Do</x-slot>
            <p>Methods</p>
            <p>Where is it applied</p>
            <p>What does it do?</p>
            <p>Global middleware</p>
            <p>Route middleware / alias</p>
            <p>Group middleware</p>
        </x-lvdb::card>

    </x-slot>
</x-lvdb::layout>

