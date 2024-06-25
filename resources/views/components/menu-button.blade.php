@props([
    'icon' => null,
    'active' => false,
    'title' => '',
    'route' => 'lara-vel-dev-buddy.home',
    'url' => null,
])

<a
    @if ($active)
        id="selecteditem"
    @endif
    href="{{ $url ?: route($route) }}"
    title="{{ $title }}"
    @class([
        'hover:bg-gradient-to-br flex gap-2 items-center block px-3 py-2',
        'text-white XXfrom-sky-900 XXto-sky-900 hover:from-sky-500 hover:to-sky-700' => ! $active,
        'XXtext-yellow-400 font-medium bg-yellow-400' => $active,
    ])
>
    @if ($icon)
        <span class="text-lg material-symbols-outlined">{{ $icon }}</span>
    @endif
    {{ $slot }}
</a>
