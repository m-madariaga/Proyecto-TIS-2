<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca_producto;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca_producto::all();
        $categorias = Categoria::all();
        return view('producto.create', compact('marcas', 'categorias'));
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
            'marca_id' => 'required',
            'categoria_id' => 'required',
            'nombre' => 'required',
            'precio' => 'required',
            'color' => 'required',
            'talla' => 'required',
            'stock' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,svg,bmp',
        ]);
        $producto = new Producto([
            'marca_id' => $request->get('marca_id'),
            'categoria_id' => $request->get('categoria_id'),
            'nombre' => $request->get('nombre'),
            'precio' => $request->get('precio'),
            'color' => $request->get('color'),
            'talla' => $request->get('talla'),
            'stock' => $request->get('stock'),
        ]);
        if ($image = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenUser = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imagenUser);
        }
        $producto->imagen = $imagenUser;
        $producto->save();
        return redirect()->route('productos')->with('success:', 'Producto ingresado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $id)
    {
        $producto = Producto::find($id);
        $marcas = Marca_producto::all();
        $categorias = Categoria::all();
        return view('producto.edit', compact('producto','marcas','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $id)
    {
        $request->validate([
            'marca_id' => 'required',
            'categoria_id' => 'required',
            'nombre' => 'required',
            'precio' => 'required',
            'color' => 'required',
            'talla' => 'required',
            'stock' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,svg,bmp',
        ]);
        $product = Producto::find($id);
        $product->marca_id = $request->marca_id;
        $product->categoria_id = $request->categoria_id;
        $product->nombre = $request->nombre;
        $product->precio = $request->precio;
        $product->color = $request->color;
        $product->talla = $request->talla;
        $product->stock = $request->stock;
        if ($image = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenUser = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imagenUser);
            $product->imagen = $imagenUser;
        } else {
            unset($product->imagen);
        }
        $product->save();
        return redirect()->route('productos')->with('success:', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $id)
    {
        $product = Producto::find($id);
        $product->delete();
        return redirect()->route('productos')->with('success:', 'Producto eliminado correctamente.');
    }
}
