<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{

    public $termino;
    public $categoria;
    public $salario;

    //* El listener escuchara el evento que se esta emitiendo en FiltrarVacantes
    //* Lo escuchara con el nombre terminosBusqueda y cuando el evento ocurra llamara a la funcion "buscar"
    protected $listeners = ["terminosBusqueda" => "buscar"];

    public function buscar($termino, $categoria, $salario) {

        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;

    }

    public function render()
    {

        // $vacantes = Vacante::all();

        //* When: Se ejecutara cuando uno de los valores tenga algo, si estan vacios no pasara nada
        //* Si tiene algo ejecutara el callback y buscara en el titulo (tabla vacantes) el termino, similar a un select con where en sql
        $vacantes = Vacante::when($this->termino, function($query){

            //* Con el operador %(inicio y final) no importa si esta al inicio o al final, si esta el termino lo encontrara
            $query->where("titulo", "LIKE", "%" . $this->termino . "%");
        })
        ->when($this->termino, function($query){ //* Si no encuentra el termino en titulo lo buscara en empresa (aplicar orWhere)
            $query->orWhere("empresa", "LIKE", "%" . $this->termino . "%");
        })
        ->when($this->categoria, function($query){
            $query->where("categoria_id", $this->categoria);
        })
        ->when($this->salario, function($query){
            $query->where("salario_id", $this->salario);
        })
        ->orderBy("created_at", "DESC")->paginate(20); //* Obtener todos los registros si el campo esta vacio

        return view('livewire.home-vacantes', [
            "vacantes" => $vacantes
        ]);
    }
}
