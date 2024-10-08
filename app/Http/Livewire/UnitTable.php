<?php

namespace App\Http\Livewire;

use App\Providers\UnitServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Vite;
use Livewire\Component;
use Livewire\Livewire;

class UnitTable extends Component
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
        return view('livewire.unit-table');
    }

    /**
     * Genera las cabeceras de la tabla
     */
    private function loadHeaders(): void
    {
        $this->headers = array(
            array("key" => "id",       "value" => "ID"),
            array("key" => "sticker",  "value" => "Sticker"),
            array("key" => "name",     "value" => "Name"),
            array("key" => "universe", "value" => "Universe"),
            array("key" => "type",     "value" => "Type"),
            array("key" => "faction",  "value" => "Faction"),
            array("key" => "ticon",    "value" => "Icon"),
            array("key" => "terrain",  "value" => "Terrain"),
            array("key" => "speed",    "value" => "Speed"),
            array("key" => "move",     "value" => "Move"),
            array("key" => "atk",      "value" => "Attack"),
            array("key" => "range",    "value" => "Range"),
            array("key" => "cost",     "value" => "Cost"),
            array("key" => "gold",     "value" => "Gold"),
            array("key" => "mana",     "value" => "Mana"),
            array("key" => "symbol",   "value" => "Symbol"),
            array("key" => "exp",      "value" => "Expansion"),
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
        foreach (UnitServiceProvider::getUnits() as $item)
        {
            // TODO Para montar un componente Livewire en el controlador de otro componente, usamos Livewire::mount
            // Livewire::mount('unit', ['id' => $item['id']])->html(),

            $unit = array(
                "id"        => $item['id'],
                "sticker"   => file_exists(__DIR__ . "../../../../{$item['image']}") ? "img:" . Vite::asset($item['image']) . ",w:64" : null,
                "name"      => ucwords($item['name']) . ($item['wounded'] ? " (Wounded)" : null),
                "universe"  => $item['universe'],
                "type"      => ucfirst($item['type']),
                "faction"   => isset($item['faction']) ? ucfirst($item['faction']) : null,
                "ticon"     => isset($item['terrain']) ? "img:" . Vite::asset("resources/img/icon/terrain_{$item['terrain']}.png") . ",w:24" : null,
                "terrain"   => isset($item['terrain']) ? ucfirst($item['terrain']) : null,
                "speed"     => $item['speed'] ?? null,
                "move"      => $item['move']  ?? null,
                "atk"       => $item['atk']   ?? null,
                "range"     => $item['range'] ?? null,
                "cost"      => $item['cost']  ?? null,
                "gold"      => $item['gold']  ?? null,
                "mana"      => $item['mana']  ?? null,
                "symbol"    => isset($item['symbol']) ? strtoupper($item['symbol']) : null,
                "exp"       => ucfirst($item['expansion']),
            );

            // Genera el elemento final
            $this->elements[] = $unit;
        }
    }

}
