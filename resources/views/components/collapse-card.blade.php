@props([
    'title',
    'count' => 0,
])

<div x-data="{ open: false }" class="rounded-3xl p-4 shadow-sm bg-sky-50 mb-8 dark:bg-zinc-800">
    <h3 class="flex text-2xl cursor-pointer" x-on:click="open = !open">
        <span class="flex-1">{{ $title }}</span>
        @if($count > 0)
            <span x-show="! open" class="bg-sky-300 text-white rounded-full px-4 dark:bg-zinc-700">{{ $count }}</span>
        @endif
    </h3>
    <div x-show="open" class="my-4">
        {{ $slot }}
    </div>
</div>
