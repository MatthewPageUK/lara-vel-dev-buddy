@props(['file' => ''])
<div class="mb-4">
    <div x-data="{
            slideOverOpen: false
        }"
        class="relative z-50 w-auto h-auto">
        <button @click="slideOverOpen=true"
            class="w-full inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 disabled:opacity-50 disabled:pointer-events-none
                dark:bg-black dark:text-white dark:border-none dark:hover:text-yellow-400
            ">
            {{ $file->name }}
        </button>
        <template x-teleport="body">
            <div
                x-show="slideOverOpen"
                @keydown.window.escape="slideOverOpen=false"
                class="relative z-[99]">
                <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false" class="fixed inset-0 bg-black bg-opacity-10"></div>
                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                            <div
                                x-show="slideOverOpen"
                                @click.away="slideOverOpen = false"
                                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                                x-transition:enter-start="translate-x-full"
                                x-transition:enter-end="translate-x-0"
                                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                                x-transition:leave-start="translate-x-0"
                                x-transition:leave-end="translate-x-full"
                                class="w-screen max-w-md">
                                <div class="flex flex-col h-full py-5 overflow-y-scroll bg-white border-l shadow-lg border-zinc-500 dark:bg-black">
                                    <div class="px-4 sm:px-5">
                                        <div class="flex items-start justify-between pb-1">
                                            <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-white" id="slide-over-title">
                                                File Information
                                            </h2>
                                            <div class="flex items-center h-auto ml-3">
                                                <button @click="slideOverOpen=false" class="absolute top-0 right-2 z-30 flex items-center justify-center px-2 py-1 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100 dark:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                        <div class="absolute inset-0 px-4 sm:px-5">
                                            <div class="relative h-full overflow-hidden">



                                                <div class="divide-y divide-zinc-500 text-sm">
                                                    <p class="py-2 flex items-center gap-1">
                                                        <span class="flex-1">Open in Bitbucket</span>
                                                        <span class="flex-none text-xs bg-zinc-500 py-1 px-2 rounded-md hover:bg-yellow-400 hover:text-black">Master</span>
                                                        <span class="flex-none text-xs bg-zinc-500 py-1 px-2 rounded-md hover:bg-yellow-400 hover:text-black">Staging</span>
                                                    </p>
                                                    <p class="py-2">View commit history @todo api</p>
                                                    <p class="py-2">Open in local editor @todo</p>
                                                    <p class="py-2">File size - {{ $file->size }}</p>
                                                    <p class="py-2">File type - @todo</p>
                                                    <p class="py-2 flex items-center">
                                                        <span class="flex-1">Line count - {{ $file->lineCount }}</span>
                                                        <span x-data="{ lineCount: {{ $file->lineCount }} }" class="text-xs flex-none">
                                                            <span class="bg-green-500 p-1 rounded-md" x-show="lineCount <= 100">Good line count</span>
                                                            <span class="bg-orange-500 p-1 rounded-md" x-show="lineCount > 100 && lineCount < 250">Medium line count</span>
                                                            <span class="bg-red-500 p-1 rounded-md" x-show="lineCount > 249 && lineCount < 500">High line count</span>
                                                            <span class="bg-red-500 p-1 rounded-md" x-show="lineCount > 499">Crazy line count</span>
                                                        </span>
                                                    </p>
                                                    <p class="py-2 flex items-center" x-data="{longestLine: {{ $file->longestLine }}}">
                                                        <span class="flex-1">Longest line - {{ $file->longestLine }} characters</span>
                                                        <span
                                                            :class="{
                                                                'bg-green-500': longestLine <= 80,
                                                                'bg-orange-500': longestLine > 80 && longestLine < 120,
                                                                'bg-red-500': longestLine > 119
                                                            }"
                                                            class="text-xs p-1 rounded-md flex-none"
                                                        >
                                                            <span x-text=" longestLine <= 80 ? 'Good line length' : longestLine > 80 && longestLine < 120 ? 'Medium line length' : 'Long line length'"></span>
                                                        </span>
                                                    </p>
                                                    <p class="py-2 flex gap-4">Variables<span>
                                                        @foreach ($file->variables as $variable)
                                                            <span class="block">{{ $variable }}</span>
                                                        @endforeach
                                                        </span>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>