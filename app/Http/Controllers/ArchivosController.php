<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use App\Models\Categorias;
use App\Models\Dictamen;
use App\Models\DictamenArchivos;
use Illuminate\Http\Request;
use App\Models\Productos;

class ArchivosController extends Controller
{
    protected $connection = 'second_mysql';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // Obtener el ID del dictamen de la URL
        $dictamen_id = $request->dictamen_id;

        // Obtener el usuario autenticado actualmente
        $usuario = auth()->user();

        // Obtener los archivos relacionados con el dictamen y el usuario logueado
        $archivos = Archivos::where('dictamen_id', $dictamen_id)
            ->where('usuario_id', $usuario->id)
            ->paginate(5);

        // Pasar el usuario, los archivos y el ID del dictamen a la vista
        return view('armonia.archivos.index', [
            'usuario' => $usuario,
            'archivos' => $archivos,
            'dictamen_id' => $dictamen_id
        ]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Obtener el usuario autenticado actualmente
        $usuario = auth()->user();

        // Obtener el dictamen_id de la solicitud (si se pasó)
        $dictamen_id = $request->dictamen_id;

        // Pasar el usuario y el dictamen_id a la vista
        return view('armonia.archivos.crear', compact('usuario', 'dictamen_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener el ID del dictamen de la URL
        $dictamenId = $request->dictamen_id;

        // Obtener el ID del usuario autenticado
        $usuarioId = auth()->id();

        // Validar los datos del formulario
        $request->validate([
            'numero_dictamen' => 'required',
            'archivo' => 'required|file', // Validar que se haya subido un archivo
        ]);

        // Crear una nueva instancia del modelo Archivos
        $archivo = new Archivos();

        // Establecer los valores de los campos
        $archivo->numero_dictamen = $request->numero_dictamen;

        // Guardar el archivo en el sistema de archivos
        $archivoSubido = $request->file('archivo');
        $rutaArchivo = $archivoSubido->store('public/archivos');
        $archivo->rutadoc = str_replace('public/', '', $rutaArchivo); // Guardar la ruta del archivo en la base de datos

        // Asignar el dictamen_id obtenido de la URL
        $archivo->dictamen_id = $dictamenId;

        // Asignar el usuario_id obtenido del usuario autenticado
        $archivo->usuario_id = $usuarioId;

        // Guardar la nueva entrada en la base de datos
        $archivo->save();

        // Redirigir al usuario a la página de lista de archivos con el dictamen_id en la URL
        return redirect()->route('archivos.index', ['dictamen_id' => $dictamenId])->with('success', 'Documento creado exitosamente');
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
