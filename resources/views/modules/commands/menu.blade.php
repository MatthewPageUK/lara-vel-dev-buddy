<ul>
    @foreach($commands as $commandItem)
        <li>
            <x-lvdb::menu-button
                :title="$commandItem->newInstance()->getDescription()"
                :url="$module::getRoute('show', $commandItem->getName())"
                :active="$commandItem->getName() === (isset($reflection) ? $reflection->getName() : '')"
            >{{ str_replace('App\\Console\\Commands\\', '', $commandItem->getName()) }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>