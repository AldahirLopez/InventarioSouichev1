<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;
    protected $table = 'operacion';
    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}