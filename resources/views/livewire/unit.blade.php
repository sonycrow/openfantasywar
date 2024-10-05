@if($unit['type'] == "building")
    @include('livewire.unit.building')
@else
    @include('livewire.unit.unit')
@endif
