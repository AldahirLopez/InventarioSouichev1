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
    public function index()
    {

        $planos = Planos::paginate(5);
        return view('planos.index', compact('planos'));
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

        // Obtener el archivo subido
        $archivoSubido = $request->file('archivo');

        // Leer el contenido del archivo y convertirlo a base64
        $contenidoArchivo = base64_encode(file_get_contents($archivoSubido->getRealPath()));

        // Crear una nueva instancia del modelo Planos
        $plano = new Planos();

        // Establecer los valores de los campos
        $plano->usuario_id = $usuarioId; // Asignar el ID del usuario
        $plano->obra_id = $obraId; // Asignar el ID de la obra
        $plano->nombre = $request->nombre;
        $plano->descripcion = $request->descripcion;
        $plano->plano = $contenidoArchivo; // Guardar el contenido del archivo en la base de datos

        // Guardar la nueva entrada en la base de datos
        $plano->save();

        $obra = Obras::findOrFail($obraId);
        $planos = Planos::paginate(5);
        return view('planos.index', compact('planos'), ['obra' => $obra]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obra = Obras::findOrFail($id); // Obtener la obra por su ID
        $planos = Planos::paginate(5);
        return view('planos.index', compact('planos'), ['obra' => $obra]);
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
