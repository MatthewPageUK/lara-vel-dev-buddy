@props(['comment' => null])
@if ($comment && $comment !== '')
    <x-lvdb::code>
        {{ $comment }}
    </x-lvdb::code>
@else
    <x-lvdb::code-suggestion>Consider adding a comment block to this file.</x-lvdb::code-suggestion>
@endif