<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //* Usar policy para que los devs no puedan crear vacantes
        $this->authorize("viewAny", Vacante::class);
        return view("vacantes.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        
        $this->authorize("create", Vacante::class);
        return view("vacantes.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view("vacantes.show", [
            "vacante" => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {

        //* Usar el policy para restringir, si el user_id es el mismo del usuario autenticado se concede el acceso
        $this->authorize("update", $vacante);

        //* Pasar la informacion de vacante para hacer la edicion
        return view("vacantes.edit", [
            "vacante" => $vacante
        ]);
    }

}
