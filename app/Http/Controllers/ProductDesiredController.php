<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_desired;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;

class ProductDesiredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $producto_mas_deseado = DB::table('product_desireds')
            ->join('users', 'product_desireds.user_id', '=', 'users.id')
            ->select('product_desireds.product_id', DB::raw('COUNT(*) as count'))
            ->groupBy('product_desireds.product_id')
            ->orderBy('count', 'desc')
            ->first();

        if ($producto_mas_deseado)
        {
            $product = Product::find($producto_mas_deseado->product_id);
            $count = $producto_mas_deseado->count;
        }
        else
        {
            $product = null;
            $count = null;
        }
        return view('product_desired.index', compact('users', 'product', 'count'));
    }
    public function generate_pdf(User $id)
    {
        $usuario = $id;
        $productos = Product_desired::all()->where('user_id', $usuario->id);
        // Mail::to('fparedesp@ing.ucsc.cl')->send(new ProofPayment($users, $fecha_actual));
        $pdf = PDF::loadView('receipt.product_desired', compact('usuario', 'productos'));

        return $pdf->stream('ProductosDeseados.pdf');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_and_delete(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
        ]);
        //si existe el producto que se intenta agregar, entonces se debe borrar
        $existe_producto = Product_desired::where('user_id', $request->get('user_id'))
            ->where('product_id', $request->get('product_id'))
            ->exists();
        if ($existe_producto)
        {
            $p = Product_desired::all()
                ->where('user_id', $request->get('user_id'))
                ->where('product_id', $request->get('product_id'));
            foreach ($p as $key => $value)
            {
                $value->delete();
            }
            return back();
        }
        $prod_desired = new Product_desired([
            'user_id' => $request->get('user_id'),
            'product_id' => $request->get('product_id'),
        ]);
        $prod_desired->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_desired  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $productos_deseados = $user->product_desired;
        return view('profile_products_desired', compact('productos_deseados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_desired  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_desired $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_desired  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_desired $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_desired  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_desired $id)
    {
    }
}
