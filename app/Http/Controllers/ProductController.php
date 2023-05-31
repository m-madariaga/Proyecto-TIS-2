<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::all();
        return view('product.index', compact('productos'));
    }

    public function women_product()
    {
        $productos = Product::all();
        return view('women', compact('productos'));
    }

    public function men_product(){

        $productos = Product::all();
        return view('men', compact('productos'));

    }
    public function kids_product(){

        $productos = Product::all();
        return view('kids', compact('productos'));

    }
    public function accesorie_product(){

        $productos = Product::all();
        return view('accesorie', compact('productos'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Brand::all();
        $categorias = Category::all();
        return view('product.create', compact('marcas', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        @error_log('entrando a store');
        $request->validate(
            [
                'marca_id' => 'required|exists:brands,id',
                'categoria_id' => 'required|exists:categories,id',
                'nombre' => 'required',
                'precio' => 'required',
                'color' => 'required',
                'talla' => 'required',
                'stock' => 'required',
                'visible' => 'required',
                'imagen' => 'required|image|mimes:jpeg,png,jpg,svg',
            ],
            [
                'marca_id.required' => 'El campo marca es requerido.',
                'marca_id.exists' => 'La marca seleccionada no existe en nuestra base de datos.',
                'categoria_id.required' => 'El campo categoría es requerido.',
                'categoria_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
                'nombre.required' => 'El campo nombre es requerido.',
                'precio.required' => 'El campo precio es requerido.',
                'color.required' => 'El campo color es requerido.',
                'talla.required' => 'El campo talla es requerido.',
                'stock.required' => 'El campo stock es requerido.',
                'imagen.required' => 'El campo imagen es requerido.',
                'imagen.image' => 'El archivo seleccionado debe ser una imagen.',
                'imagen.mimes' => 'El archivo seleccionado debe tener uno de los siguientes formatos: jpeg, png, jpg o svg.',
            ],
        );
        @error_log('despues de validar');
        $imagenUser = '';
        if ($image = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenUser = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imagenUser);
        }
        @error_log('despues de imagen');
        $producto = new Product([
            'marca_id' => $request->get('marca_id'),
            'categoria_id' => $request->get('categoria_id'),
            'nombre' => $request->get('nombre'),
            'precio' => $request->get('precio'),
            'color' => $request->get('color'),
            'talla' => $request->get('talla'),
            'stock' => $request->get('stock'),
            'visible' => $request->get('visible'),
            'imagen' => $imagenUser,
        ]);
        $producto->save();
        if ($request->__isset('control-hidden')) {
            $productos = Product::all();
            $marcas = Brand::all();
            $categorias = Category::all();
            return redirect()
                ->route('orden-compra-create', compact('productos', 'marcas', 'categorias'))
                ->with('success', 'Producto nuevo ingresado correctamente.');
        }
        return redirect()
            ->route('productos')
            ->with('success', 'Producto ingresado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
{
    $product = Product::findOrFail($productId);

    return view('product.show', compact('product'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $id)
    {
        $productos = Product::all();
        $producto = $productos->find($id);
        $marcas = Brand::all();
        $categorias = Category::all();
        return view('product.edit', compact('producto', 'marcas', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $id)
    {
        error_log('test');
        $request->validate([
            'marca_id' => 'required',
            'categoria_id' => 'required',
            'nombre' => 'required',
            'precio' => 'required',
            'color' => 'required',
            'talla' => 'required',
            'stock' => 'required',
            'visible' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,svg,bmp',
        ]);
        error_log('test');
        $productos = Product::all();
        $product = $productos->find($id);
        $product->marca_id = $request->marca_id;
        $product->categoria_id = $request->categoria_id;
        $product->nombre = $request->nombre;
        $product->precio = $request->precio;
        $product->color = $request->color;
        $product->talla = $request->talla;
        $product->stock = $request->stock;
        $product->visible = $request->visible;
        if ($image = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenUser = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imagenUser);
            $product->imagen = $imagenUser;
        } else {
            unset($product->imagen);
        }
        $product->save();
        return redirect()
            ->route('productos')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $id)
    {
        $productos = Product::all();
        $producto = $productos->find($id);
        $producto->delete();
        return response()->json(['success' => true]);
    }
}
