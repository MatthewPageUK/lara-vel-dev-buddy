<ul>
    @foreach($middlewares as $middleware)
        <li>
            <x-lvdb::menu-button
                :title="$middleware->getName()"
                :url="$module::getRoute('show', $middleware->getName())"
                :active="$middleware->getName() === (isset($reflection) ? $reflection->getName() : '')"
            >{{ str_replace('App\\Http\\Middleware\\', '', $middleware->getName()) }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>
