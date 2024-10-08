<div class="main-card">
    <div @class([
         "block-image",
         "type-location",
         "type-location-{$location['terrain']}" => !empty($location['terrain'])
         ])
         data-locationid="{{ $location['id'] }}">

        <div class="art" style="background-image: url('{{ Vite::asset($location['art']) }}')"></div>

        <div class="name">{{ $location['name'] }}</div>

        @if($location['gold'])
            <div class="gold">{{ $location['gold'] }}</div>
        @endif
        @if($location['mana'])
            <div class="mana">{{ $location['mana'] }}</div>
        @endif

        <div class="type">{{ Str::upper(__('general.location')) }}</div>
        <div class="text">
            <div class="terrain-icon"></div>
            <div class="desc">{{ $location['text'] }}</div>
            <div class="lore"><div>{{ $location['lore'] }}</div></div>
        </div>

        <div class="entrance">{{ $location['entrance'] }}</div>
        <div class="terrain"></div>
    </div>

    <div id="card-location-{{ $location['id'] }}"></div>
</div>
