<?php

namespace App\Http\Controllers;

use App\Models\Documentos;
use Illuminate\Http\Request;
use App\Models\Planos;
use App\Models\Obras;
use App\Models\User;

class DocumentosLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documentos = Documentos::where('obra_id', $request->obra_id)->paginate(5);
        $obra = Obras::findOrFail($request->obra_id); // Obtener la obra relacionada con los planos
        return view('documentos.index', compact('documentos', 'obra'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $obraId = $request->obra_id; // Obtener la obra por su ID
        return view('documentos.crear', compact('obraId'));
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
        $doc = new Documentos();

        // Establecer los valores de los campos
        $doc->usuario_id = auth()->id(); // Obtener el ID del usuario autenticado
        $doc->obra_id = $request->obra_id; // Obtener el ID de la obra de la solicitud
        $doc->nombre = $request->nombre;
        $doc->descripcion = $request->descripcion;

        // Guardar el archivo en el sistema de archivos
        $archivoSubido = $request->file('archivo');
        $rutaArchivo = $archivoSubido->store('public/archivos');
        $doc->rutadoc = str_replace('public/', '', $rutaArchivo); // Guardar la ruta del archivo en la base de datos

        // Guardar la nueva entrada en la base de datos
        $doc->save();

        // Redirigir al usuario a la página de lista de planos
        return redirect()->route('documentos.index', ['obra_id' => $request->obra_id])->with('success', 'Documento creado exitosamente');
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
        // Busca el plano por su ID
        $doc = Documentos::findOrFail($id);

        // Retorna la vista del formulario de edición con los datos del plano y de la obra
        return view('documentos.editar', compact('doc'));
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
            'descripcion' => 'required',
            'archivo' => 'file', // El archivo es opcional en la actualización
        ]);
    
        // Buscar el plano por su ID
        $doc = Documentos::findOrFail($id);
    
        // Actualizar los campos
        $doc->nombre = $request->nombre;
        $doc->descripcion = $request->descripcion;
    
        // Verificar si se proporcionó un nuevo archivo
        if ($request->hasFile('archivo')) {
            // Obtener la ruta del archivo anterior
            $rutaArchivoAnterior = storage_path('app/public/' . $doc->rutaplano);
    
            // Verificar si el archivo anterior existe y eliminarlo
            if (file_exists($rutaArchivoAnterior)) {
                unlink($rutaArchivoAnterior); // Eliminar el archivo anterior del sistema de archivos
            }
    
            // Guardar el nuevo archivo en el sistema de archivos
            $archivoSubido = $request->file('archivo');
            $rutaArchivoNuevo = $archivoSubido->store('public/archivos');
            $doc->rutaplano = str_replace('public/', '', $rutaArchivoNuevo); // Actualizar la ruta del archivo en la base de datos
        }
    
        // Guardar los cambios en la base de datos
        $doc->save();
    
        // Redirigir al usuario a la página de lista de planos
        return redirect()->route('documentos.index', ['obra_id' => $doc->obra_id])->with('success', 'Plano actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el plano por su ID
        $doc = Documentos::findOrFail($id);
    
        // Obtener la ruta del archivo asociado al plano
        $rutaArchivo = storage_path('app/public/' . $doc->rutadoc);
    
        // Verificar si el archivo existe y eliminarlo
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo); // Eliminar el archivo del sistema de archivos
        }
    
        // Eliminar el plano de la base de datos
        $doc->delete();
    
        // Redirigir al usuario a la página de lista de planos
        return redirect()->route('documentos.index', ['obra_id' => $doc->obra_id])->with('success', 'Documentos eliminado exitosamente');
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
