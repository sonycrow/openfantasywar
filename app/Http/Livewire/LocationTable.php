<?php

namespace App\Http\Livewire;

use App\Providers\LocationServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Vite;
use Livewire\Component;

class LocationTable extends Component
{
    // Propiedades de Datatable
    public array $props = [
        "allowSelection" => false
    ];

    public array $headers = array();
    public array $elements = array();

    /**
     * Constructor del componente
     */
    public function mount()
    {
        $this->loadHeaders();
        $this->loadElements();
    }

    /**
     * Vista del componente
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.location-table');
    }

    /**
     * Genera las cabeceras de la tabla
     */
    private function loadHeaders(): void
    {
        $this->headers = array(
            array("key" => "id",             "value" => "ID"),
            array("key" => "image",          "value" => "Image"),
            array("key" => "name",           "value" => "Name"),
            array("key" => "universe",       "value" => "Universe"),
            array("key" => "type",           "value" => "Type"),
            array("key" => "ticon",          "value" => "Icon"),
            array("key" => "terrain",        "value" => "Terrain"),
            array("key" => "entrance",       "value" => "Entrance"),
            array("key" => "reinforcements", "value" => "Reinforcements"),
            array("key" => "gold",           "value" => "Gold"),
            array("key" => "mana",           "value" => "Mana"),
            array("key" => "symbol",         "value" => "Symbol"),
            array("key" => "exp",            "value" => "Expansion"),
        );
    }

    /**
     * Obtiene los elementos de la tabla y rellena las filas.
     */
    private function loadElements(): void
    {
        // Init
        $this->elements = array();

        // Unidades
        foreach (LocationServiceProvider::getLocations() as $item)
        {
            // TODO Para montar un componente Livewire en el controlador de otro componente, usamos Livewire::mount
            // Livewire::mount('unit', ['id' => $item['id']])->html(),

            // TODO Para las locales
            // $locale = App::currentLocale();
            // if (App::isLocale('en')) {

            $location = array(
                "id"             => $item['id'],
                "image"          => file_exists(__DIR__ . "../../../../{$item['image']}") ? "img:" . Vite::asset($item['image']) . ",w:64" : null,
                "name"           => $item['name'],
                "universe"       => $item['universe'],
                "type"           => __("general.{$item['type']}"),
                "ticon"          => isset($item['terrain']) ? "img:" . Vite::asset("resources/img/icon/terrain_{$item['terrain']}.png") . ",w:24" : null,
                "terrain"        => isset($item['terrain']) ? ucfirst($item['terrain']) : null,
                "entrance"       => $item['entrance'] ?? null,
                "reinforcements" => $item['reinforcements'] ?? null,
                "gold"           => $item['gold'] ?? null,
                "mana"           => $item['mana'] ?? null,
                "symbol"         => isset($item['symbol']) ? strtoupper($item['symbol']) : null,
                "exp"            => ucfirst($item['expansion']),
            );

            // Genera el elemento final
            $this->elements[] = $location;
        }
    }

}
