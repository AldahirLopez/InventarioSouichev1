<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;

class ObrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obras = Obras::paginate(5);
        return view('obras.index', compact('obras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obras.crear');
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

        $obras = Obras::paginate(5);
        return view('obras.index', compact('obras'));
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
        // Busca la obra por su ID
        $obra = Obras::findOrFail($id);

        // Retorna la vista del formulario de edición con los datos de la obra
        return view('obras.editar', compact('obra'));
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
        $obra = Obras::findOrFail($id);

        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'estacionservicio' => 'required',
        ]);
    
        // Actualizar los valores de los campos
        $obra->nombre = $request->nombre;
        $obra->direccion = $request->direccion;
        $obra->estacionservicio = $request->estacionservicio;
    
        // Guardar los cambios en la base de datos
        $obra->save();
    
        // Redirigir a la vista de índice de obras (o a donde desees después de la actualización)
        $obras = Obras::paginate(5);
        return view('obras.index', compact('obras'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
