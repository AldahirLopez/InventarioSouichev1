<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planos;
use App\Models\Obras;

class PlanosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $planos = Planos::where('obra_id', $request->obra_id)->paginate(5);
        $obra = Obras::findOrFail($request->obra_id); // Obtener la obra relacionada con los planos
        return view('planos.index', compact('planos', 'obra'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $obraId = $request->obra_id; // Obtener la obra por su ID
        return view('planos.crear', compact('obraId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $usuarioId = auth()->id();

        // Obtener el ID de la obra de la página anterior
        $obraId = $request->obra_id; // Asumiendo que el ID de la obra se pasa como parámetro en la solicitud

        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|file', // Validar que se haya subido un archivo
        ]);

        // Crear una nueva instancia del modelo Planos
        $plano = new Planos();

        // Establecer los valores de los campos
        $plano->usuario_id = auth()->id(); // Obtener el ID del usuario autenticado
        $plano->obra_id = $request->obra_id; // Obtener el ID de la obra de la solicitud
        $plano->nombre = $request->nombre;
        $plano->descripcion = $request->descripcion;

        // Guardar el archivo en el sistema de archivos
        $archivoSubido = $request->file('archivo');
        $rutaArchivo = $archivoSubido->store('public/archivos');
        $plano->rutaplano = str_replace('public/', '', $rutaArchivo); // Guardar la ruta del archivo en la base de datos

        // Guardar la nueva entrada en la base de datos
        $plano->save();

        // Redirigir al usuario a la página de lista de planos
        return redirect()->route('planos.index', ['obra_id' => $request->obra_id])->with('success', 'Plano creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function mostrarPDF($contenidoPDF)
    {
        // Decodificar el contenido base64 del PDF
        $contenidoPDFDecodificado = base64_decode($contenidoPDF);

        // Guardar el contenido del PDF en un archivo temporal
        $archivoTemporal = tempnam(sys_get_temp_dir(), 'pdf');
        file_put_contents($archivoTemporal, $contenidoPDFDecodificado);

        // Devolver el archivo PDF
        return response()->file($archivoTemporal);
    }
}
