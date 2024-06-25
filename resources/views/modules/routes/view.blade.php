<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.routes.menu')
    </x-slot:menu>
    <x-slot:page>
        {{-- Main Page --}}

        <x-lvdb::card>
            <x-slot:title>Details</x-slot:title>

            <div class="py-1 px-4 rounded-xl bg-sky-800 text-white font-medium dark:bg-zinc-600">
                {{ $route->uri }}
            </div>

            <x-lvdb::details-list>
                <x-lvdb::details-list-item title="Methods">{{ collect($route->methods)->implode(', ') }}</x-lvdb::details-list-item>
                <x-lvdb::details-list-item title="Middleware">
                    {{ collect($route->action['middleware'])->implode(', ') }}
                </x-lvdb::details-list-item>
                <x-lvdb::details-list-item title="Uses">
                    {{ $route->action['uses'] }}
                </x-lvdb::details-list-item>
            </x-lvdb::details-list>


{{--
            Illuminate\Routing\Route {#1855 ▼ // lvdb/src/Http/Controllers/RoutesController.php:24
                +uri: "post/{year}/{month}/{day}/{post}"
                +methods: array:2 [▼
                  0 => "GET"
                  1 => "HEAD"
                ]
                +action: array:7 [▼
                  "middleware" => array:1 [▼
                    0 => "web"
                  ]
                  "uses" => "App\Livewire\Ui\Post\View@__invoke"
                  "controller" => "App\Livewire\Ui\Post\View"
                  "namespace" => null
                  "prefix" => ""
                  "where" => []
                  "as" => "post"
                ]
                +isFallback: false
                +controller: null
                +defaults: []
                +wheres: []
                +parameters: null
                +parameterNames: null
                #originalParameters: null
                #withTrashedBindings: false
                #lockSeconds: null
                #waitSeconds: null
                +computedMiddleware: null
                +compiled: null
                #router:
              Illuminate\Routing
              \
              Router {#26 ▶}
                #container:
              Illuminate\Foundation
              \
              Application {#3 …40}
                #bindingFields: []
              } --}}


        </x-lvdb::card>

        <x-lvdb::card>
            <x-slot:title>To Do</x-slot:title>
            <p>Link to controller</p>
            <p>Examine controller to map parameters to models or types</p>
            <p>Middleware table</p>
            <p>Examine middleware? Auth</p>
            <p>...</p>
        </x-lvdb::card>

    </x-slot:page>

</x-lvdb::layout>
