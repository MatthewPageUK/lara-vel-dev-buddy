<ul>
    @foreach($enums as $enum)
        <li>
            <x-lvdb::menu-button
                :title="$enum->getName()"
                :url="$module::getRoute('show', $enum->getName())"
                :active="$enum->getName() === (isset($reflection) ? $reflection->getName() : '')"
            >{{ str_replace('App\\Enums\\', '', $enum->getName()) }}</x-lvdb::menu-button>
        </li>
    @endforeach
</ul>

<p class="px-2 py-2 my-4 mx-2 font-medium border-t border-b">Enum Traits</p>
<ul>
    @foreach($enumTraits as $enumTrait)
        <x-lvdb::menu-button
            :title="$enumTrait->getShortName()"
        >{{ $enumTrait->getShortName() }}</x-lvdb::menu-button>
    @endforeach
</ul>
<p class="px-2 py-2 my-4 mx-2 font-medium border-t border-b">Enum Interfaces</p>
<ul>
    @foreach($enumInterfaces as $enumInterface)
        <x-lvdb::menu-button
            :title="$enumInterface->getShortName()"
        >{{ $enumInterface->getShortName() }}</x-lvdb::menu-button>
    @endforeach
</ul>