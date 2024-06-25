@props(['reflection', 'methods', 'methodSignatures', 'methodTraits'])

{{-- Methods --}}
<x-lvdb::card>
    <x-slot:title>Methods</x-slot:title>

    <div class="grid gap-2 flex-1" x-data="{
        open: false,
        declaringClass: '{{ str_replace('\\', '/', $reflection->getName()) }}',
        visibility: 'public',
    }">
        <div class="flex items-center gap-4 mb-4">
            <div class="flex items-center gap-2">
                Declaring class
                <select x-model="declaringClass" class="rounded-sm p-2 border dark:bg-black">
                    <option value="">From all classes</option>
                    @foreach (collect($methods)->map(fn($method) => $method->getDeclaringClass()->getName())->unique() as $class)
                        <option value="{{ str_replace('\\', '/', $class) }}">{{ $class }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-2">
                Visibility
                <select x-model="visibility" class="rounded-sm p-2 border dark:bg-black">
                    <option value="">Any</option>
                    <option value="public">Public</option>
                    <option value="protected">Protected</option>
                    <option value="private">Private</option>
                    <option value="static">Static</option>
                </select>
            </div>
        </div>
        @foreach ($methods as $method)
        @php
            if ($method->isPublic()) {
                $visibility = 'public';
            } elseif ($method->isProtected()) {
                $visibility = 'protected';
            } elseif ($method->isPrivate()) {
                $visibility = 'private';
            } else {
                $visibility = '';
            }
        @endphp
            <div
                x-show="(! declaringClass || declaringClass == '{{ str_replace('\\', '/', $method->getDeclaringClass()->getName()) }}') && (! visibility || visibility == '{{ $visibility }}')"
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
                    <span class="font-light">
                        {{ $visibility }}
                        <span class="font-medium">{{ $methodSignatures[$method->getShortName()] }}</span>: {{ $method->getReturnType() }}
                    </span>
                    <span class="flex-1 text-right text-sm text-white">{{ $methodTraits[$method->getShortName()]?->getName() }}</span>
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