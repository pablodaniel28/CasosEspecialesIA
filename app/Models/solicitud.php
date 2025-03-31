<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitud extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'codigo', 'gestion', 'estado', 'user_id', 'carrera_id'];

    // Relación: una solicitud pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: una solicitud pertenece a una carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    // Relación: una solicitud tiene muchas materias
    public function materias()
    {
        return $this->hasMany(Materia::class);
    }
}
