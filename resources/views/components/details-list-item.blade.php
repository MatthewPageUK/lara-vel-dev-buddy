@props([
    'optional' => false,
    'title' => '',
])
@if (! $optional || ! $slot->isEmpty())
    <div class="px-0 py-3 grid grid-cols-3 gap-4">
        <dt class="font-light leading-6 text-sky-900 dark:text-zinc-500">{{ $title }}</dt>
        <dd class="mt-1 leading-6 text-gray-700 col-span-2 mt-0 dark:text-zinc-200">{{ $slot }}</dd>
    </div>
@endif
