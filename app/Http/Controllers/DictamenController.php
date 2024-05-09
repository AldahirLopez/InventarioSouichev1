<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Dictamen;
use App\Models\DictamenArchivos;
use Illuminate\Http\Request;
use App\Models\Productos;

class DictamenController extends Controller
{
    protected $connection = 'second_mysql';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        // Obtener los dictamenes de Operacion y mantenimiento
        // Obtener el usuario autenticado actualmente
        $usuario = auth()->user();

        // Obtener los dictamenes
        $dictamenes = Dictamen::paginate(5);
        // Pasar el usuario y los dictámenes paginados a la vista
        return view('armonia.dictamen.index', ['usuario' => $usuario, 'dictamenes' => $dictamenes]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener el usuario autenticado actualmente
        $usuario = auth()->user();
        return view('armonia.dictamen.crear', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener el usuario autenticado actualmente
        $usuario = auth()->user();

        // Validar los datos del formulario
        $request->validate([
            'numero_dictamen' => 'required',
        ]);

        // Crear una nueva instancia del modelo Planos
        $dictamen = new Dictamen();

        // Establecer los valores de los campos
        $dictamen->usuario_id = auth()->id(); // Obtener el ID del usuario autenticado
        $dictamen->numero_dictamen = $request->numero_dictamen;

        // Guardar la nueva entrada en la base de datos
        $dictamen->save();

        // Redirigir al usuario a la página de lista de planos
        return redirect()->route('dictamen.index')->with('success', 'Documento creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Productos $producto)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productos $producto)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $producto)
    {
    }
}
