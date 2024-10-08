<?php

namespace App\Http\Livewire;

use App\Providers\UnitServiceProvider;
use Livewire\Component;

class Unit extends Component
{
    public array $unit;

    /**
     * Constructor del componente
     */
    public function mount(string $id)
    {
        // Datos de la unidad
        $this->unit = UnitServiceProvider::getUnit($id);
    }

    /**
     * Vista del componente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.unit');
    }

}
