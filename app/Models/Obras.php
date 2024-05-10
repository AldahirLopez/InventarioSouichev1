<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obras extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'direccion', 'estacionservicio'];
    public function planos()
    {
        return $this->hasMany(Planos::class, 'obra_id');
    }
}
