<?php

namespace App\Http\Livewire;

use App\Models\Categorias;
use App\Models\Productos;
use Livewire\Component;
use Illuminate\Http\Request;

class MaterialList extends Component
{
        public $digitos;
        public function render()
        {
          $productos = Productos::where('nombre', 'like', '%' . $this->digitos . '%')
          ->orWhere('categoria', 'like', '%' . $this->digitos . '%')
          ->get();
         return view('livewire.material-list', ['productos'=>$productos]);
        }
}
