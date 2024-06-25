@props(['title' => 'Code snippet'])
<div class="w-full">
    {{-- <p class="text-xs uppercase text-sky-400 mb-1">{{ $title }}</p> --}}
    <div {!! $attributes->merge(['class' => 'mt-2 text-xs bg-white rounded-lg p-4 text-green-700 dark:bg-black dark:text-green-600']) !!}>
        <code class="whitespace-pre">{{ $slot }}</code>
    </div>
</div>