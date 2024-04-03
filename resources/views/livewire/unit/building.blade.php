<div class="main-building">
    <div @class([
         "block-image",
         "type-{$unit['type']}"
         ])
         data-counterid="{{ $unit['id'] }}">

        <div class="name">{{ Str::upper($unit['name']) }}</div>

        <div class="gold">{{ $unit['gold'] }}</div>
        <div class="mana">{{ $unit['mana'] }}</div>

        @if($unit['art'])
            <div class="art" style="background-image: url('{{ Vite::asset($unit['art']) }}')"></div>
        @endif
    </div>

    <div id="counter-{{ $unit['id'] }}"></div>
</div>
