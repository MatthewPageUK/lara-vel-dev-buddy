@props(['migrations' => []])
<x-lvdb::table>
    <x-lvdb::tr>
        <x-lvdb::th>Created</x-lvdb::th>
        <x-lvdb::th>Age</x-lvdb::th>
        <x-lvdb::th>Name</x-lvdb::th>
        <x-lvdb::th>Table</x-lvdb::th>
        <x-lvdb::th>Path</x-lvdb::th>
        <x-lvdb::th>Batch</x-lvdb::th>
    </x-lvdb::tr>
    @foreach ($migrations as $migration)
        <x-lvdb::tr :class="$migration->batch ? '' : 'text-red-500'">
            <x-lvdb::td>{{ $migration->date->format('Y-m-d h:m:s') }}</x-lvdb::td>
            <x-lvdb::td>{{ $migration->date->diffForHumans() }}</x-lvdb::td>
            <x-lvdb::td>{{ $migration->name }}</x-lvdb::td>
            <x-lvdb::td>{{ $migration->table }}</x-lvdb::td>
            <x-lvdb::td>{{ $migration->path }}</x-lvdb::td>
            <x-lvdb::td>{{ $migration->batch ?: 'Not run' }}</x-lvdb::td>
        </x-lvdb::tr>
    @endforeach
</x-lvdb::table>