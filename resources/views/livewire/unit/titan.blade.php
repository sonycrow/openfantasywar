<div class="main-counter">
    <div @class([
         "block-image",
         "type-{$unit['type']}"
         ])
         data-counterid="{{ $unit['id'] }}">

        <div @class(['name', 'name-wounded' => $unit['wounded']])>{{ Str::upper($unit['name']) }}</div>

        @if($unit['wounded'])
            <div class="wounded">WOUNDED</div>
        @endif

        <div @class(['cost'])>{{ $unit['cost'] }}</div>
        <div @class(['attack', 'attack-wounded' => $unit['wounded']])>{{ $unit['atk'] }}</div>
        <div @class(['move',   'move-wounded'   => $unit['wounded']])>{{ $unit['move'] }}</div>
        <div @class(['range',  'range-wounded'  => $unit['wounded']])>{{ $unit['range'] }}</div>
        <div class="symbol">{{ Str::upper($unit['symbol']) }}</div>

        <div class="speed">
            <div class="value">{{ Str::upper($unit['speed']) }}</div>
            <div class="terrain terrain-{{ $unit['terrain'] }}"></div>
        </div>

        @if($unit['art'])
            <div class="art" style="background-image: url('{{ Vite::asset($unit['art']) }}')"></div>
        @endif
    </div>

    <div id="counter-{{ $unit['id'] }}"></div>
</div>
