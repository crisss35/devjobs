<?php

namespace App\Livewire;

use Livewire\Component;

class MostrarAlerta extends Component
{

    //! Registrar el mensaje de error
    public $message;

    public function render()
    {
        return view('livewire.mostrar-alerta');
    }
}
