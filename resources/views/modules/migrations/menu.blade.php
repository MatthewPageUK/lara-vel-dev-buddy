<ul>
    @foreach($factories as $factoryItem)
        <li>
            <x-lvdb::menu-button
                :title="$factoryItem->getName()"
                :url="$module::getRoute('show', $factoryItem->getName())"
                :active="$factoryItem->getName() === (isset($reflection) ? $reflection->getName() : '')"
            >{{ str_replace('Database\\Factories\\', '', $factoryItem->getName()) }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>