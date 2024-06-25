<ul>
    {{-- Sub Menu of Models --}}
    @foreach($models as $model)
        <li>
            <x-lvdb::menu-button
                :title="$model->getName()"
                :url="$module::getRoute('show', $model->getName())"
                :active="$model->getName() === (isset($reflection) ? $reflection->getName() : '')"
            >{{ str_replace('App\\Models\\', '', $model->getName()) }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>
