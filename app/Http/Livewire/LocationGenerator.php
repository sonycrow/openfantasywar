<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LocationGenerator extends Component
{
    public string $terrain = "";

    public bool $tts      = false;
    public bool $toimage  = false;
    public bool $download = false;

    /**
     * Vista del componente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.location-generator');
    }

}
