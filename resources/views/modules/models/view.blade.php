<x-lvdb::layout :title="$title">
    <x-slot:menu>
        @include('lvdb::modules.models.menu')
    </x-slot:menu>
    <x-slot:page>
        {{-- Main Page --}}

        {{-- File info slide over --}}
        <div class="mb-2">
            <x-lvdb::file-info-slide-over :file="$file" />
        </div>

        <x-lvdb::card>
            <x-slot:title>Details</x-slot:title>

            <div class="py-1 px-4 rounded-xl bg-sky-800 text-white font-medium dark:bg-zinc-600">
                {{ $reflection->getName() }}
            </div>

            <x-lvdb::comment-recommended :comment="$comment" />

            <x-lvdb::details-list>
                <x-lvdb::details-list-item title="Parent">{{ $parent->name }}</x-lvdb::details-list-item>
                <x-lvdb::details-list-item title="Table">{{ $table }}</x-lvdb::details-list-item>
                <x-lvdb::details-list-item title="Primary key">{{ $primary_key }}</x-lvdb::details-list-item>
                <x-lvdb::details-list-item title="Primary key type">{{ $primary_key_type }}</x-lvdb::details-list-item>
                <x-lvdb::details-list-item title="Primary key incrementing">{{ $incrementing ? 'Yes' : 'No' }}</x-lvdb::details-list-item>
            </x-lvdb::details-list>
        </x-lvdb::card>

        {{-- Casts --}}
        <x-lvdb::card>
            <x-slot:title>Casts</x-slot:title>
            <table class="w-full">
                <tr class="text-zinc-500 text-left border-zinc-500 border-b">
                    <th class="py-1 pr-4 font-light">Column</th>
                    <th class="py-1 px-4 font-light">Type</th>
                </tr>
                @foreach ($casts as $name => $type)
                    <tr class="text-left">
                        <td class="py-1 pr-4">{{ $name }}</td>
                        <td class="py-1 pl-4">{{ $type }}</td>
                    </tr>
                @endforeach
            </table>
        </x-lvdb::card>

        <x-lvdb::card>
            <x-slot:title>Scopes</x-slot:title>
            <div class="flex flex-wrap gap-2">
                @foreach ($scopes as $method)

                    <div class="flex items-center gap-2 border border-sky-300 py-1 px-4 rounded-xl hover:bg-green-200 dark:border-zinc-500 dark:hover:bg-slate-700">
                        <span class="font-medium">{{ lcfirst(str_replace('scope', '', $method->name)) }}(@foreach(collect($method->getParameters())->filter(fn ($parameter) => $parameter->name !== 'query') as $parameter)
                            ${{ $parameter->name }}{{ $loop->last ? '' : ', ' }}
                        @endforeach
                        )</span>
                    </div>
                @endforeach
            </div>
        </x-lvdb::card>

        <x-lvdb::collapse-card title="Fillables" :count="count($fillables)">
            @foreach ($fillables as $fillable)
                <span class="p-1 px-6 bg-green-200 rounded-full">{{ $fillable }}</span>
            @endforeach
        </x-lvdb::collapse-card>













        {{-- Fields --}}
        <x-lvdb::card>
            <x-slot:title>Table Fields</x-slot:title>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>Field</x-lvdb::th>
                    <x-lvdb::th>Type</x-lvdb::th>
                    <x-lvdb::th>Null</x-lvdb::th>
                    <x-lvdb::th>Key</x-lvdb::th>
                    <x-lvdb::th>Default</x-lvdb::th>
                    <x-lvdb::th>Extra</x-lvdb::th>
                    <x-lvdb::th>Fillable</x-lvdb::th>
                    <x-lvdb::th>Cast</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($fields as $field)
                    <x-lvdb::tr>
                        <x-lvdb::td>{{ $field->Field }}</x-lvdb::td>
                        <x-lvdb::td>{{ $field->Type }}</x-lvdb::td>
                        <x-lvdb::td>{{ $field->Null }}</x-lvdb::td>
                        <x-lvdb::td>{{ $field->Key }}</x-lvdb::td>
                        <x-lvdb::td>{{ $field->Default }}</x-lvdb::td>
                        <x-lvdb::td>{{ $field->Extra }}</x-lvdb::td>
                        <x-lvdb::td>{{ $fillables->contains($field->Field) ? 'Yes' : '-' }}</x-lvdb::td>
                        <x-lvdb::td>{{ $casts[$field->Field] ?? '-' }}</x-lvdb::td>
                    </x-lvdb::tr>
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>


        {{-- Relationships --}}
        <x-lvdb::card>
            <x-slot:title>Relationships</x-slot:title>
            <x-lvdb::table>
                <x-lvdb::tr>
                    <x-lvdb::th>Method</x-lvdb::th>
                    <x-lvdb::th>Relationship</x-lvdb::th>
                    <x-lvdb::th>Model</x-lvdb::th>
                </x-lvdb::tr>
                @foreach ($relationships as $method)
                    <x-lvdb::tr>
                        <x-lvdb::td>{{ $method['method'] }}</x-lvdb::td>
                        <x-lvdb::td>{{ $method['type'] }}</x-lvdb::td>
                        <x-lvdb::td>{{ $method['model'] }}</x-lvdb::td>
                    </x-lvdb::tr>
                @endforeach
            </x-lvdb::table>
        </x-lvdb::card>

        {{-- Migrations --}}
        <x-lvdb::card>
            <x-slot:title>Migrations</x-slot:title>
            <x-lvdb::migrations.table :migrations="$migrations" />
        </x-lvdb::collapse-card>


        <x-lvdb::collapse-card title="Traits" :count="count($traits)">
            @foreach ($traits as $trait => $value)
                <div x-data="{ open: false }">
                    <h3 class="text-xl cursor-pointer" @click="open = !open">{{ $trait }}</h3>
                    <div x-show="open" class="mb-4">
                        <table>
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Return Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($value->getMethods() as $method)
                                    <tr>
                                        <td class="pr-4">{{ $method->isPublic() ? 'Public' : '' }}</td>
                                        <td class="pr-4">{{ $method->name }}</td>
                                        <td class="pr-4">{{ $method->class }}</td>
                                        <td class="pr-4">{{ $method->getReturnType() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @endforeach
        </x-lvdb::collapse-card>

        <x-lvdb::collapse-card title="Methods" :count="count($methods)">
            <table>
                <thead>
                    <tr>
                        <th> </th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Return Type</th>
                        {{-- <th>Trait</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($methods as $method)
                        <tr>
                            <td class="pr-4">{{ $method->isPublic() ? 'Public' : '' }}</td>
                            <td class="pr-4">{{ $method->name }}</td>
                            <td class="pr-4">{{ $method->class }}</td>
                            <td class="pr-4">{{ $method->getReturnType() }}</td>
                            {{-- <td>{{ dump($method) }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-lvdb::collapse-card>




        <x-lvdb::collapse-card title="Properties" :count="count($properties)">
            <h2 class="text-2xl mb-4">Properties</h2>
            <table>
                <thead>
                    <tr>
                        <th> </th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Return Type</th>
                        <th>Trait</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr>
                            {{-- <td class="pr-4">{{ $property->isPublic() ? 'Public' : '' }}</td>
                            <td class="pr-4">{{ $property->name }}</td>
                            <td class="pr-4">{{ $property->class }}</td>
                            <td class="pr-4">{{ $property->getReturnType() }}</td> --}}
                            <td>@php dump($property) @endphp</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-lvdb::collapse-card>





    </x-slot:page>

</x-lvdb::layout>
