<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    //* Comunicar con livewire, incluir wire:model en el input
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    //* Habilitar la subida de archivos en livewire
    use WithFileUploads;

    //* Reglas de validacion
    protected $rules = [
        "titulo" => "required|string",
        "salario" => "required",
        "categoria" => "required",
        "empresa" => "required",
        "ultimo_dia" => "required",
        "descripcion" => "required",
        "imagen" => "required|image|max:1024"
    ];

    //* Se manda a llamar desde el formulario
    public function crearVacante() {

        $datos = $this->validate();

        //* Almacenar la imagen
        $imagen = $this->imagen->store("public/vacantes"); //* Guardar en el disco
        
        //? Buscas algo en un string y lo reemplazas por algo mas, en este caso quito la ruta public/vacantes/
        //? Se reescribira la posicion de imagen
        $datos["imagen"] = str_replace("public/vacantes/", "", $imagen); 

        //* Crear la vacante
        Vacante::create([
            "titulo" => $datos["titulo"],
            "salario_id" => $datos["salario"],
            "categoria_id" => $datos["categoria"],
            "empresa" => $datos["empresa"],
            "ultimo_dia" => $datos["ultimo_dia"],
            "descripcion" => $datos["descripcion"],
            "imagen" => $datos["imagen"],
            "user_id" => auth()->user()->id,
        ]);

        //* Crear un mensaje
        session()->flash("mensaje", "La Vacante se Publico Correctamente");

        //* Redireccionar al usuario
        return redirect()->route("vacantes.index");
    }

    public function render()
    {

        //* Consultar DB
        $salario = Salario::all();
        $categoria = Categoria::all();

        return view('livewire.crear-vacante', [
            "salarios" => $salario,
            "categorias" => $categoria
        ]);
    }
}
