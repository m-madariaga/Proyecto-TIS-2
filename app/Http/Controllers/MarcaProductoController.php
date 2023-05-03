<?php

namespace App\Http\Controllers;

use App\Models\Marca_producto;
use Illuminate\Http\Request;

class MarcaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca_producto::all();
        return view('marca.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        $marca = new Marca_producto([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
        ]);
        $marca->save();
        return redirect()->route('marcas')->with('success:', 'Marca ingresada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca_producto  $marca_producto
     * @return \Illuminate\Http\Response
     */
    public function show(Marca_producto $marca_producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca_producto  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca_producto $id)
    {
        $marcas = Marca_producto::all();
        $marca = $marcas->find($id);
        return view('marca.edit',compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca_producto  $marca_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca_producto $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        $marcas = Marca_producto::all();
        $marca = $marcas->find($id);
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->save();
        return redirect()->route('marcas')->with('success:', 'Marca actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca_producto  $marca_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca_producto $id)
    {
        $marcas = Marca_producto::all();
        $marca = $marcas->find($id);
        $marca->delete();
        return redirect()->route('marcas')->with('success:', 'Marca eliminada correctamente.');
    }
}
