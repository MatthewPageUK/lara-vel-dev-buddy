<x-lvdb::layout :title="$title">
    <x-slot name="menu">
        @include('lvdb::modules.controllers.menu')
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
                <x-lvdb::dl-item title="Extends">{{ $reflection->getParentClass()->getName() }}</x-lvdb::dl-item>
                <x-lvdb::dl-item title="Description">  </x-lvdb::dl-item>
            </x-lvdb::dl>
        </x-lvdb::card>

        {{-- Routes --}}
        <x-lvdb::card>
            <x-slot name="title">Routes</x-slot>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>URI</x-lvdb::th>
                    <x-lvdb::th>Methods</x-lvdb::th>
                    <x-lvdb::th>Middleware</x-lvdb::th>
                    <x-lvdb::th>Uses</x-lvdb::th>
                    <x-lvdb::th>As</x-lvdb::th>
                    <x-lvdb::th>Prefix</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($routes as $route)
                    <x-lvdb::tr>
                        <x-lvdb::td>
                            {{ $route->uri }}
                        </x-lvdb::td>
                        <x-lvdb::td>
                            {{ collect($route->methods)->implode(', ') }}
                        </x-lvdb::td>
                        <x-lvdb::td>
                            {{ collect($route->middleware())->implode(', ') }}
                        </x-lvdb::td>
                        <x-lvdb::td>
                            {{ str_replace($reflection->getName(), '', $route->getActionName()) }}
                        </x-lvdb::td>
                        <x-lvdb::td>
                            {{ $route->action['as'] }}
                        </x-lvdb::td>
                        <x-lvdb::td>
                            {{ $route->action['prefix'] }}
                        </x-lvdb::td>
                    </x-lvdb::tr>
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>

        {{-- Views --}}
        <x-lvdb::card>
            <x-slot name="title">Views</x-slot>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>View</x-lvdb::th>
                    <x-lvdb::th>Returned from</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($views as $view)
                    <x-lvdb::tr>
                        <x-lvdb::td>{{ $view['View'] }}</x-lvdb::td>
                        <x-lvdb::td>{{ $view['Method'] }}()</x-lvdb::td>
                    </x-lvdb::tr>
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>

        {{-- Methods --}}
        <x-lvdb::methods-card :reflection="$reflection" :methods="$methods" :methodSignatures="$methodSignatures" :methodTraits="$methodTraits" />

        <x-lvdb::card>
            <x-slot name="title">To Do</x-slot>
            <p>Public methods</p>
            <p>Routes</p>
            <p>Views returned</p>
            <p>Authorisation</p>
            <p>Middleware</p>
            <p>Traits</p>
            <p>Interfaces</p>
            <p>Model(s)</p>
            <p>Form Requests</p>
            <p>Validation</p>
        </x-lvdb::card>

    </x-slot>
</x-lvdb::layout>
