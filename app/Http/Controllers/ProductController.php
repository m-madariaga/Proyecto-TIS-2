<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Images;
use App\Models\Product;
use App\Models\Review;
use App\Models\Section;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $sections = Section::all();
        $productos = Product::all();
        return view('product.index', compact('productos', 'sections', 'socialnetworks', 'images'));
    }

    public function women_product()
    {
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $sections = Section::all();
        $productos = Product::all();
        return view('women', compact('productos', 'sections', 'socialnetworks', 'images'));
    }

    public function men_product()
    {
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $sections = Section::all();
        $productos = Product::all();
        return view('men', compact('productos', 'sections', 'socialnetworks', 'images'));
    }
    public function kids_product()
    {
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $sections = Section::all();
        $productos = Product::all();
        return view('kids', compact('productos', 'sections', 'socialnetworks', 'images'));
    }
    public function accesorie_product()
    {
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $sections = Section::all();
        $productos = Product::all();
        return view('accesorie', compact('productos', 'sections', 'socialnetworks', 'images'));
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
                $rutaGuardarImg = 'assets/images/images-products';
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

            $action = new Action();
            $action->name = 'Creación Producto';
            $action->user_fk = Auth::User()->id;
            $action->save();

            return response()->json(['success' => true]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['success' => false, 'errors' => $errors]);
        }
    }
    public function store_static(Request $request)
    {
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
            $rutaGuardarImg = 'assets/images/images-products';
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

        $action = new Action();
        $action->name = 'Creación Producto';
        $action->user_fk = Auth::User()->id;
        $action->save();

        return redirect()->route('productos')->with('success','Producto ingresado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        $sections = Section::all();
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $product = Product::findOrFail($productId);
        $reviews = Review::where('product_fk', $productId)->get();
        foreach ($reviews as $review) {
            $review->username = User::find($review->user_fk)->name;
            error_log($review->username);
        }

        $recommendedProducts = $this->getRecommendedProducts($productId);
        return view('product.show', compact('product', 'reviews', 'recommendedProducts', 'sections', 'socialnetworks', 'images'));
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
        if ($image = $request->file('imagen')) {
            $rutaGuardarImg = 'assets/images/images-products';
            $imagenUser = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imagenUser);
            $product->imagen = $imagenUser;
        } else {
        }
        $product->save();

        $action = new Action();
        $action->name = 'Edición Producto';
        $action->user_fk = Auth::User()->id;
        $action->save();

        return redirect()
            ->route('productos')
            ->with('success', 'Producto editado correctamente.');
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

        $action = new Action();
        $action->name = 'Borrado Producto';
        $action->user_fk = Auth::User()->id;
        $action->save();

        return response()->json(['success' => true]);
    }
    public function getRecommendedProducts($productId)
    {
        // Obtener el producto actual
        $product = Product::findOrFail($productId);

        // Obtener todos los productos excepto el actual
        $recommendedProducts = Product::where('id', '!=', $productId)
            ->inRandomOrder()
            ->get();

        return $recommendedProducts;
    }
}
