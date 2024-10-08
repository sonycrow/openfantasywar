<?php

namespace App\Http\Livewire;

use App\Providers\LocationServiceProvider;
use Livewire\Component;

class Location extends Component
{
    public array $location;

    /**
     * Constructor del componente
     */
    public function mount(string $id)
    {
        // Datos de la carta
        $this->location = LocationServiceProvider::getLocation($id);
    }

    /**
     * Vista del componente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.location');
    }

}
