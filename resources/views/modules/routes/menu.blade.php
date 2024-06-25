<ul>
    {{-- Sub Menu of Routes --}}
    @foreach($routes as $routeItem)
        <li>
            <x-lvdb::menu-button
                :title="$routeItem->uri"
                :url="$module::getRoute('show', str_replace('}', ']', str_replace('{', '[' , $routeItem->uri)))"
                :active="$routeItem->uri === (isset($route) ? $route->uri : '')"
            >{{ $routeItem->uri }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>
