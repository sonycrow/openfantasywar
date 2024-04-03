<div>
    <div x-data class="border border-gray-300 p-4 mb-5 rounded-lg flex">
        <div class="mr-4">
            <label>
                <select
                    wire:model="faction"
                    x-on:change.debounce="generateImages"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                >
                    <option>·· Fantasy Counters ··</option>
                    <option value="titan">Titans</option>
                    <option value="mercenaries">Mercenaries</option>
                    <option value="building">Buildings</option>

                    <option>·· Fantasy Factions ··</option>
                    <option value="amazons">Amazons</option>
                    <option value="barbarians">Barbarians</option>
                    <option value="daemons">Daemons</option>
                    <option value="dwarves">Dwarves</option>
                    <option value="elves">Elves</option>
                    <option value="orcs">Orcs</option>
                    <option value="undead">Undead</option>
                </select>
            </label>
        </div>

        <div class="mr-4"><label><input wire:model="tts" type="checkbox" class="mr-1" /><span>Formato TTS</span></label></div>
        <div class="mr-4"><label><input wire:model="toimage"  id="toimage"  type="checkbox" class="mr-1" /><span>Generar imágenes</span></label></div>
        <div class="mr-4"><label><input wire:model="download" id="download" type="checkbox" class="mr-1" /><span>Descargar imágenes</span></label></div>

        <button x-on:click="generateImages" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 p-1">Generar</button>
    </div>

    <div class="grid grid-cols-3" style="width: {{ ($tts ? 288*4 : 512*3) }}px;">
        {{-- Livewire --}}
        @if(in_array($faction, array('titan', 'building')))
            @foreach (\App\Providers\CodexServiceProvider::getUnitsByType($faction) as $item)
                @livewire('unit', ['id' => $item['id'], 'tts' => $tts], key($item['id']))
            @endforeach
        @else
            @foreach (\App\Providers\CodexServiceProvider::getUnitsByFaction($faction) as $item)
                @livewire('unit', ['id' => $item['id'], 'tts' => $tts], key($item['id']))
            @endforeach
        @endif
    </div>

    <script>
        function generateImages(e) {
            // Recorremos los bloques y generamos las imágenes
            let nodes = document.getElementsByClassName('block-image');

            Array.from(nodes).forEach((node) => {
                // Configuración
                let counterId = node.getAttribute("data-counterid");

                // Si hay que generar las imagenes
                if (document.getElementById('toimage').checked) {
                    htmltoimage.toPng(node)
                        .then(function (dataUrl) {
                            let img = new Image();
                            img.src = dataUrl;

                            // Descarga de imagenes
                            if (document.getElementById('download').checked) {
                                img.onclick = function() {
                                    let link = document.createElement('a');
                                    link.download = counterId + '.png';
                                    link.href = dataUrl;
                                    link.click();
                                };
                            }

                            document.getElementById("counter-" + counterId).appendChild(img);
                            node.remove();
                        })
                        .catch(function (error) {
                            console.error('oops, something went wrong!', error);
                        });
                }
            });
        }
    </script>
</div>


