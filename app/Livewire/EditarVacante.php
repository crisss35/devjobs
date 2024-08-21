<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{

    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    public $imagen_nueva;
    
    use WithFileUploads;

    protected $rules = [
        "titulo" => "required|string",
        "salario" => "required",
        "categoria" => "required",
        "empresa" => "required",
        "ultimo_dia" => "required",
        "descripcion" => "required",
        //? Nullable: El campo puede ir vacio pero si tiene algo debe ser una imagen
        "imagen_nueva" => "nullable|image|max:1024"
    ];

    //* Un hook de livewire, se ejecuta una vez que el componente es instanciado
    public function mount(Vacante $vacante) {

        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format("Y-m-d");
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;

    }

    public function editarVacante() {

        $datos = $this->validate();

        //* Si hay una nueva imagen
        if($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store("public/vacantes");

            //? Crear una nueva posicion en el arreglo, eliminar el public/vacantes, la imagen anterior
            $datos["imagen"] = str_replace("public/vacantes/", "", $imagen);
        }
        
        //* Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);


        //* Asignar/sobrescribir los valores
        $vacante->titulo = $datos["titulo"];
        $vacante->salario_id = $datos["salario"];
        $vacante->categoria_id = $datos["categoria"];
        $vacante->empresa = $datos["empresa"];
        $vacante->ultimo_dia = $datos["ultimo_dia"];
        $vacante->descripcion = $datos["descripcion"];

        //? Reescribir sobre la vacante, si el usuario sube una nueva imagen se asigna $datos["imagen"]
        //? de lo contrario se mantiene la imagen actual
        $vacante->imagen = $datos["imagen"] ?? $vacante->imagen;

        //* Guardar la vacante
        $vacante->save();

        //* Redireccionar
        session()->flash("mensaje", "La Vacante se Actualizo Correctamente");
        return redirect()->route("vacantes.index");
    }

    public function render()
    {

        $salario = Salario::all();
        $categoria = Categoria::all();

        return view('livewire.editar-vacante', [
            "salarios" => $salario,
            "categorias" => $categoria
        ]);
    }
}
