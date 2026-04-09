<div>
    <x-status-messages />
    @foreach($details as $detail)
        <div wire:key="detail-{{ $detail->id }}">
            {{ $detail->name }}
        </div>
    @endforeach
</div>
