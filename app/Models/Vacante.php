<?php

namespace App\Models;

use App\Models\Salario;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacante extends Model
{
    use HasFactory;

    //* Convertir la variable en un atributo date
    protected $casts = ["ultimo_dia" => "date"];

    protected $fillable = [
        "titulo",
        "salario_id",
        "categoria_id",
        "empresa",
        "ultimo_dia",
        "descripcion",
        "imagen",
        "user_id"
    ];

    //* Una vacante se asocia con una categoria, el belongsTo se utiliza para referenciar a la clave foranea que esta en vacantes
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    //* Una vacante solo tiene un salario
    public function salario() {
        return $this->belongsTo(Salario::class);
    }

    //* Una vacante tiene muchos candidatos
    public function candidatos() {
        return $this->hasMany(Candidato::class)->orderBy("created_at", "DESC");
    }

    //* Una vacante pertenece a un usuario
    public function reclutador() {
        return $this->belongsTo(User::class, "user_id");
    }
}
