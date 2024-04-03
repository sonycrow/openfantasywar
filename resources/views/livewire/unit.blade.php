@if($unit['type'] == "titan")
    @include('livewire.unit.titan')
@elseif($unit['type'] == "building")
    @include('livewire.unit.building')
@else
    @include('livewire.unit.unit')
@endif
