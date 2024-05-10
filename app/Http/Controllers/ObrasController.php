<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;
use App\Models\Planos;

class ObrasController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-obras|crear-obras|editar-obras|borrar-obras', ['only' => ['index']]);
        $this->middleware('permission:crear-obras', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-obras', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-obras', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obras = Obras::paginate(5);
        $opcion = "souichi";
        return view('obras.index', compact('obras', 'opcion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opcion = "souichi";
        return view('obras.crear', compact('opcion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'estacionservicio' => 'required',
        ]);

        // Crear una nueva instancia del modelo Obras
        $obra = new Obras();

        // Establecer los valores de los campos
        $obra->nombre = $request->nombre;
        $obra->direccion = $request->direccion;
        $obra->estacionservicio = $request->estacionservicio;

        // Guardar la nueva entrada en la base de datos
        $obra->save();
        $opcion = "souichi";
        $obras = Obras::paginate(5);
        return view('obras.index', compact('obras','opcion'));
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
    public function edit($id)
    {
        $opcion = "souichi";
        // Busca la obra por su ID
        $obra = Obras::findOrFail($id);

        // Retorna la vista del formulario de edición con los datos de la obra
        return view('obras.editar', compact('obra', 'opcion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'estacionservicio' => 'required|numeric',
        ]);

        // Buscar la obra por su ID y actualizar los datos
        $obra = Obras::findOrFail($id);
        $obra->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'estacionservicio' => $request->estacionservicio,
            // Aquí puedes añadir más campos que necesites actualizar
        ]);

        // Agregar el mensaje de éxito a la sesión
        session()->flash('success', 'La obra ha sido actualizada exitosamente');
        $opcion = "souichi";
        // Redirigir a la vista de edición de la obra
        return redirect()->route('obras.index', ['obra' => $obra->id,'obra' => $opcion]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar la obra por su ID
        $obra = Obras::findOrFail($id);

        // Obtener los planos asociados a la obra
        $planos = $obra->planos;

        // Eliminar los archivos y los registros de los planos asociados
        foreach ($planos as $plano) {
            // Obtener la ruta del archivo asociado al plano
            $rutaArchivo = storage_path('app/public/' . $plano->rutaplano);

            // Verificar si el archivo existe y eliminarlo
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo); // Eliminar el archivo del sistema de archivos
            }

            // Eliminar el plano de la base de datos
            $plano->delete();
        }

        // Eliminar la obra
        $obra->delete();

        // Redirigir a la vista de índice de obras (o a donde desees después de la eliminación)
        $obras = Obras::paginate(5);
        $opcion = "souichi";
        return view('obras.index', compact('obras', 'opcion'));
    }
}
