<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class FiltrarVacantes extends Component
{

    public $termino;
    public $categoria;
    public $salario;

    public function leerDatosFormulario() {

        //* Emitir un evento para comunicarse con el evento padre (home-vacantes)
        //* Usar dispatch (emit ya no existe)
        $this->dispatch("terminosBusqueda", $this->termino, $this->categoria, $this->salario);

    }

    public function render()
    {

        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.filtrar-vacantes', [
            "salarios" => $salarios,
            "categorias" => $categorias
        ]);
    }
}
