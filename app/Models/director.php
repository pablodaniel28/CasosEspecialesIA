<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class director extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'codigo', 'celular', 'carrera_id'];
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
