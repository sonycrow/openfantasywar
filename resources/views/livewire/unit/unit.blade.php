<div class="main-counter">
    <div @class([
         "block-image",
         "type-{$unit['type']}",
         "type-{$unit['type']}-{$unit['faction']}" => !empty($unit['faction'])
         ])
         data-counterid="{{ $unit['id'] }}">

        <div @class(['name', 'name-wounded' => $unit['wounded']])>{{ Str::upper($unit['name']) }}</div>
{{--        @if($unit['wounded'])--}}
{{--            <div class="wounded">WOUNDED</div>--}}
{{--        @endif--}}

        <div class="line-left"></div>
            <div @class(['cost'])>{{ $unit['cost'] }}</div>
            <div class="speed">
                @for($i = 1; $i <= $unit['speed']; $i++)
                    <div></div>
                @endfor
            </div>
            <div class="terrain terrain-{{ $unit['terrain'] }}"></div>
{{--            <div class="symbol">{{ (isset($unit['symbol']) ? Str::upper($unit['symbol']) : null) }}</div>--}}

        <div class="line-bottom"></div>
{{--            <div @class(['attack', 'attack-wounded' => $unit['wounded']])>{{ $unit['atk'] }}</div>--}}
{{--            <div @class(['move',   'move-wounded'   => $unit['wounded']])>{{ $unit['move'] }}</div>--}}
{{--            <div @class(['range',  'range-wounded'  => $unit['wounded']])>{{ $unit['range'] }}</div>--}}

            <div @class(['stats', 'stats-wounded' => $unit['wounded']])>{{ $unit['atk'] . '-' . $unit['move'] . '-' . $unit['range'] }}</div>

        <div class="art" style="background-image: url('{{ Vite::asset($unit['art']) }}')"></div>
{{--            <div class="art"></div>--}}
    </div>

    <div id="counter-{{ $unit['id'] }}"></div>
</div>
