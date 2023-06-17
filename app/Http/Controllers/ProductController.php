<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Notifications\lowStockNotif;

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

    public function men_product()
    {
        $productos = Product::all();
        return view('men', compact('productos'));
    }
    public function kids_product()
    {
        $productos = Product::all();
        return view('kids', compact('productos'));
    }
    public function accesorie_product()
    {
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
        try {
            $validatedData = $request->validate(
                [
                    'marca_id' => 'required|exists:brands,id',
                    'categoria_id' => 'required|exists:categories,id',
                    'nombre' => 'required|string',
                    'precio' => 'required|numeric|gt:0',
                    'color' => 'required|string',
                    'talla' => 'required|string|max:10',
                    'stock' => 'required|numeric|gte:0',
                    'visible' => 'required|numeric|in:0,1',
                    'imagen' => 'required|image|mimes:jpeg,png,jpg,svg',
                ],
                [
                    'nombre.required' => 'El campo nombre es obligatorio.',
                    'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
                    'marca_id.required' => 'El campo marca es obligatorio.',
                    'marca_id.exists' => 'La marca seleccionada no existe.',
                    'categoria_id.required' => 'El campo categoria es obligatorio.',
                    'categoria_id.exists' => 'La categoría seleccionada no existe.',
                    'precio.required' => 'El campo precio es obligatorio.',
                    'precio.numeric' => 'El campo precio debe ser un número.',
                    'precio.gt' => 'El campo precio debe ser mayor a 0.',
                    'color.required' => 'El campo color es obligatorio.',
                    'color.string' => 'El campo color debe ser una cadena de texto.',
                    'talla.required' => 'El campo talla es obligatorio.',
                    'talla.string' => 'El campo talla debe ser una cadena de texto.',
                    'talla.max' => 'El campo talla no debe exceder los 10 caracteres.',
                    'stock.required' => 'El campo stock es obligatorio.',
                    'stock.numeric' => 'El campo stock debe ser un número.',
                    'stock.gte' => 'El campo stock debe ser mayor o igual a 0.',
                    'visible.required' => 'El campo visible es obligatorio.',
                    'visible.numeric' => 'El campo visible debe ser un número.',
                    'visible.in' => 'El campo visible solo puede tener los valores 0 o 1.',
                    'imagen.required' => 'Debe subir una imagen.',
                    'imagen.image' => 'El archivo subido debe ser una imagen.',
                    'imagen.mimes' => 'El archivo debe ser de tipo JPEG, PNG, JPG o SVG.',
                ],
            );

            $imagenUser = '';
            if ($image = $request->file('imagen')) {
                $rutaGuardarImg = 'imagen/';
                $imagenUser = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move($rutaGuardarImg, $imagenUser);
            }
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

            return response()->json(['success' => true]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['success' => false, 'errors' => $errors]);
        }
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
        $reviews = Review::where('product_fk', $productId)->get();
        foreach($reviews as $review){
            $review->username = User::find($review->user_fk)->name;
            error_log($review->username);
        }
        $admin= User::find(1);
        $admin->notify(new lowStockNotif("blusa"));


        

        return view('product.show', compact('product', 'reviews'));
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
