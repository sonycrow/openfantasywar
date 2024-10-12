<div class="main-card">
    <div @class([
         "block-image",
         "card-location",
         "card-location-{$location['terrain']}" => !empty($location['terrain'])
         ])
         data-locationid="{{ $location['id'] }}">

        <div class="art" style="background-image: url('{{ Vite::asset($location['art']) }}')"></div>

        <div class="name">{{ $location['name'] }}</div>

        @if($location['gold'])
            <div @class(["gold", "one" => $location['gold'] == 1])>{{ $location['gold'] }}</div>
        @endif
        @if($location['mana'])
            <div @class(["mana", "one" => $location['mana'] == 1])>{{ $location['mana'] }}</div>
        @endif

        <div class="type">{{ Str::upper(__('general.location')) }}</div>
        <div class="text">
            <div class="terrain-icon"></div>
            <div class="desc">{{ $location['text'] }}</div>
            <div class="lore"><div>{{ $location['lore'] }}</div></div>
        </div>

        <div class="terrain"></div>
        <div @class(["entrance", "entrance-one" => $location['entrance'] == 1])>{{ $location['entrance'] }}</div>
    </div>

    <script>
        // Formateamos los textos en listados
        for (let elem of document.getElementsByTagName('td')) {
            elem.innerHTML = elem.innerHTML
                .replaceAll(/\{(.*?)\|(.*?)}/gmi, "<span class='keyword keywork-td keyword-$1'>$2</span>")
                .replaceAll(/\[(.*?)\|(.*?)]/gmi, "<span class='keyword-icon keyword-icon-td keyword-icon-$1'>$2</span>")
                .replaceAll(/\*(.*?)\*/gmi, "<span class='bold bold-td'>$1</span>")
            ;
        }

        // Formateamos textos en cajas de texto de cartas
        for (let elem of document.getElementsByClassName('desc')) {
            elem.innerHTML = elem.innerHTML
                .replaceAll(/\{(.*?)\|(.*?)}/gmi, "<span class='keyword keyword-$1'>$2</span>")
                .replaceAll(/\[(.*?)]/gmi, "<span class='keyword-icon keyword-icon-$1'>&nbsp;&nbsp;</span>")
                .replaceAll(/\*(.*?)\*/gmi, "<span class='bold'>$1</span>")
                .replaceAll(/\+/gmi, "<span class='plus'>+</span>")
                .replaceAll(/\\n/gmi, "<br/>")
        }
    </script>

    <div id="card-location-{{ $location['id'] }}"></div>
</div>

