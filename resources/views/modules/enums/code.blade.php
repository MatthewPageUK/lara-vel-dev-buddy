
namespace {{ $namespace }};

enum {{ $name }}@if($returnType !== '-'): {{ $returnType }}@else @endif

{
@foreach($cases as $case)
    {{ $case['label'] }}@if($returnType !== '-') = @if($returnType === 'string')'@endif{{ $case['value'] }}@if($returnType === 'string')'@endif @endif;
@endforeach

}
