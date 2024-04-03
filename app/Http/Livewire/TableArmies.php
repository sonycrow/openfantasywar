<?php

namespace App\Http\Livewire;

use App\Providers\CodexServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TableArmies extends Component
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
        return view('livewire.table-codex');
    }

    /**
     * Genera las cabeceras de la tabla
     */
    private function loadHeaders(): void
    {
        $this->headers = array(
            array("key" => "id",      "value" => "ID"),
            array("key" => "faction", "value" => "Faction"),
            array("key" => "units",   "value" => "Units"),
            array("key" => "cbase",   "value" => "Cost base"),
            array("key" => "cfull",   "value" => "Cost full"),
            array("key" => "list",    "value" => "List")
        );
    }

    /**
     * Obtiene los elementos de la tabla y rellena las filas.
     */
    private function loadElements(): void
    {
        // Init
        $this->elements = array();
        $armies = json_decode(Storage::disk('public')->get("armies.json"), true);

        foreach ($armies['army'] as $army)
        {
            $cbase = 0;
            $cfull = 0;
            $num   = 0;
            $units = '';

            foreach ($army['unit'] as $i) {
                $unit   = CodexServiceProvider::getUnit($i['id']);
                $cbase += $unit['cost'] * $i['amount'];
                $cfull += ($unit['cost'] * $unit['steps']) * $i['amount'];
                $num   += $i['amount'];

                $units .= ucfirst($unit['name']) . " x{$i['amount']}, ";
            }

            $army['units'] = $num;
            $army['cbase'] = $cbase . " GP";
            $army['cfull'] = $cfull . " GP";
            $army['list']  = substr($units, 0, -2);

            // Genera el elemento final
            $this->elements[] = $army;
        }
    }

}
