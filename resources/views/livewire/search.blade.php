<div>
    <input wire:model.debounce.500ms="query" type="text">

    @foreach($results as $result)
        <p>{{ $result }}</p>
    @endforeach

    {{ $test }}
</div>
