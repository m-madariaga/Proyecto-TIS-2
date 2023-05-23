<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Brand::all();
        return view('brand.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg',
        ],[
            'logo.required' => 'El campo logo es requerido.',
            'logo.image' => 'El archivo seleccionado debe ser un logo.',
            'logo.mimes' => 'El archivo seleccionado debe tener uno de los siguientes formatos: jpeg, png, jpg o svg.',
    ]);
            $imagenUser = '';
            if ($image = $request->file('logo')) {
                $rutaGuardarImg = 'imagen/';
                $imagenUser = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($rutaGuardarImg, $imagenUser);
            }
        $marca = new Brand([
            'nombre' => $request->get('nombre'),
            'logo' => $imagenUser,
        ]);
        $marca->save();
        return redirect()->route('marcas')->with('success', 'Marca ingresada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $Brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $id)
    {
        $marcas = Brand::all();
        $marca = $marcas->find($id);
        return view('brand.edit',compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $id)
    {
        $request->validate([
            'nombre' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,svg,bmp',
        ]);
        $marcas = Brand::all();
        $marca = $marcas->find($id);
        $marca->nombre = $request->nombre;
        if ($image = $request->file('logo')) {
            $rutaGuardarImg = 'imagen/';
            $imagenUser = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imagenUser);
            $marca->logo = $imagenUser;
        } else {
            unset($marca->logo);
        }
        $marca->save();
        return redirect()->route('marcas')->with('success', 'Marca actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $id)
    {
        $marcas = Brand::all();
        $marca = $marcas->find($id);
        $marca->delete();
        return response()->json(['success' => true]);
    }
}
