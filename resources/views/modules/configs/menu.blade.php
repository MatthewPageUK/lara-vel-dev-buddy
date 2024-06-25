<ul>
    @foreach ($configs as $name => $configItem)
        <li>
            <x-lvdb::menu-button
                :title="$name"
                :url="$module::getRoute('show', $name)"
                :active="$name === $config || str_starts_with($config, $name . '.')"
            >{{ ucwords($name) }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>