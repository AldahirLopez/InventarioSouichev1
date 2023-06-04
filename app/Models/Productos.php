<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'Id_persona',
        'Nombre_persona',
        'Apellido1',
        'Apellido2',
        'Correo_electronico',
        'Id_usuario',
        'Nombre_usuario',
        'Contrasena',
        'Id_rol',
        'Matricula',
        'Id_nivel',
    ];
}
