<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\Productos;
class ProductosController extends Controller
{
    function __construct()
    {
        $this -> middleware('permission:ver-productos|crear-productos|editar-productos|borrar-productos')->only('index');
        $this -> middleware('permission:crear-productos', ['only' => ['create','store'] ]);
        $this -> middleware('permission:editar-productos',['only' => ['edit', 'update'] ]);
        $this -> middleware('permission:borrar-productos',['only' => ['destroy'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       return view('productos.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categorias::all();
        return view('productos.crear', compact('categorias')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'cantidad' => 'required',
            'precio' => 'required'
        ]);

        $input = $request->all();

        $producto = Productos::create($input);
    
        return redirect()->route('productos.listar_inventario');
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
        return  view('productos.editar', compact('producto')); 
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
        $this->validate($request, ['nombre' => 'required', 'descripcion' => 'required', 'categoria' => 'required', 'cantidad' => 'required', 'precio' => 'required']);
        $producto->update($request->all());

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $producto)
    {
        $producto->delete();
        return redirect()->route('productos.listar_inventario')->with('eliminar','ok');
    }

    public function listar(){

        $productos = Productos::paginate(5);
        $categorias = Categorias::all();
        return view('productos.listar_inventario', compact('productos','categorias'));
     }

}
