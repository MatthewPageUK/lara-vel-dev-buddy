<div class="rounded-xl p-4 shadow-sm shadow-sky-800/30 bg-sky-50 mb-8 dark:shadow-none dark:bg-zinc-800">
    @if (isset($title))
        <div class="flex gap-8">
            <h3 class="w-48 flex-none text-2xl border-r border-sky-200 pr-8 mr-4 font-light overflow-hidden dark:border-zinc-500">{{ $title }}</h3>
            <div class="flex-grow">
                {{ $slot }}
            </div>
        </div>
    @else
        {{ $slot }}
    @endif
</div>

