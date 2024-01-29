<div>
    @if($getState())
    <div class="text-xs flex flex-col">
    @foreach($getState() as $state)
        <span
            @style([
                'border-width: 1px',
                'border-radius: 0.375rem',
                'padding: 0.125rem 0.25rem',
                'margin:0.25rem 0',
                'border-color: #fb923c' => $state->default,
                'border-color: #d1d5db' => !$state->default
            ])
        >
            {{ money($state->amount) }} / {{ $state->unit->name }}
        </span>
    @endforeach
    </div>
    @endif
</div>
