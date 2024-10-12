<div>
    <div x-data class="border border-gray-300 p-4 mb-5 rounded-lg flex">
        <div class="mr-4">
            <label>
                <select
                    wire:model="terrain"
                    x-on:change.debounce="generateImages"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                >
                    <option>·· Fantasy Locations ··</option>
                    <option value="city">City</option>
                    <option value="desert">Desert</option>
                    <option value="forest">Forest</option>
                    <option value="mountain">Mountain</option>
                    <option value="plains">Plains</option>
                    <option value="water">Water</option>
                </select>
            </label>
        </div>

        <div class="mr-4"><label><input wire:model="tts" type="checkbox" class="mr-1"/><span>Formato TTS</span></label></div>
        <div class="mr-4"><label><input wire:model="toimage"  id="toimage"  type="checkbox" class="mr-1"/><span>Generar imágenes</span></label></div>
        <div class="mr-4"><label><input wire:model="download" id="download" type="checkbox" class="mr-1"/><span>Descargar imágenes</span></label></div>

        <button x-on:click="generateImages" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 p-1">
            Generar
        </button>
    </div>

{{--    {{ $terrain = 'forest' }}--}}

    <div class="grid grid-cols-2" style="width: {{ ($tts ? 288*4 : 756*2) }}px;">
        {{-- Livewire --}}
        @foreach (\App\Providers\LocationServiceProvider::getLocationsByTerrain($terrain) as $item)
            @livewire('location', ['id' => $item['id'], 'tts' => $tts], key($item['id']))
        @endforeach
    </div>

    <script>
        function generateImages(e) {
            // Recorremos los bloques y generamos las imágenes
            let nodes = document.getElementsByClassName('block-image');

            Array.from(nodes).forEach((node) => {
                // Configuración
                let locationId = node.getAttribute("data-locationid");

                // Si hay que generar las imagenes
                if (document.getElementById('toimage').checked) {
                    htmltoimage.toPng(node)
                        .then(function (dataUrl) {
                            let img = new Image();
                            img.src = dataUrl;

                            // Descarga de imagenes
                            if (document.getElementById('download').checked) {
                                img.onclick = function () {
                                    let link = document.createElement('a');
                                    link.download = locationId + '.png';
                                    link.href = dataUrl;
                                    link.click();
                                };
                            }

                            document.getElementById("card-location-" + locationId).appendChild(img);
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
