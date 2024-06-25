<ul>
    @foreach($controllers as $controller)
        <li>
            <x-lvdb::menu-button
                :name="$controller->getName()"
                :url="$module::getRoute('show', $controller->getName())"
                :active="$controller->getName() === (isset($reflection) ? $reflection->getName() : '')"
            >{{ str_replace('App\\Http\\Controllers\\', '', $controller->getName()) }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>
