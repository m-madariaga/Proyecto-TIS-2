<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase_order;
use App\Models\Purchase_order_product;
use Illuminate\Http\Request;

class PurcharseOrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(Request $request)
    {
        $datos = $request->validate([
            'prod_id' => 'required',
            'cantidad' => 'required',
            'valor' => 'required',
            'orden_id' => 'required',
        ]);
        $productos = $datos['prod_id'];
        // reiniciar los indices para que sean consecutivos y quitar los nulls
        $cant = [];
        foreach ($datos['cantidad'] as $key => $value) {
            if ($value != null) {
                array_push($cant, $value);
            }
        }
        $val = [];
        foreach ($datos['valor'] as $key => $value) {
            if ($value != null) {
                array_push($val, $value);
            }
        }
        //agregamos los productos
        $id = $datos['orden_id'];
        for ($i = 0; $i < sizeof($productos); $i++) {
            $prod_id = $datos['prod_id'][$i];
            $cantidad = $cant[$i];
            $valor = $val[$i];
            $orden_product = new Purchase_order_product([
                'purchase_order_id' => $id,
                'products_id' => $prod_id,
                'cantidad' => $cantidad,
                'precio' => $valor,
            ]);
            $orden_product->save();
        }
        //recalcular total de la orden
        $orden = Purchase_order::find($id);
        $aux=0;
        foreach ($orden->product as $prod) {
            $aux += $prod->cantidad * $prod->precio;
        }
        $total = $aux;
        $orden->total = $total;
        $orden->save();
        return redirect()
            ->route('orden-compra-edit',$id)
            ->with('success:', 'Orden de compra ingresada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase_order_product  $Purchase_order_product
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase_order_product $Purchase_order_product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase_order  $Purchase_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase_order $id)
    {
        $orden = $id;
        $orden_productos = $orden->product;
        //se buscan los productos
        $productos = [];
        $productosall = Product::all();
        foreach ($orden_productos as $key => $producto) {
            $aux = Product::find($producto->products_id);
            array_push($productos, $aux);
        }
        return view('purchase_order.edit', compact('orden', 'productos', 'orden_productos', 'productosall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase_order_product  $Purchase_order_product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase_order $id)
    {
        $datos = $request->validate([
            'prod_id' => 'required',
            'cantidad' => 'required',
            'valor' => 'required',
        ]);
        // reiniciar los indices para que sean consecutivos
        $cant = [];
        foreach ($datos['cantidad'] as $key => $value) {
            if ($value != null) {
                array_push($cant, $value);
            }
        }
        $val = [];
        foreach ($datos['valor'] as $key => $value) {
            if ($value != null) {
                array_push($val, $value);
            }
        }
        //se actualizan los productos
        for ($i = 0; $i < sizeof($datos['prod_id']); $i++) {
            $prod_id = $datos['prod_id'][$i];
            $cantidad = $cant[$i];
            $valor = $val[$i];
            $orden_product = Purchase_order_product::find($prod_id);
            $orden_product->cantidad = $cantidad;
            $orden_product->precio = $valor;
            $orden_product->save();
        }
        //se recalcula el total de la orden
        $orden_productos = $id->product;
        $aux = 0;
        foreach ($orden_productos as $producto) {
            $aux += $producto->cantidad * $producto->precio;
        }
        $total = $aux;
        $id->total = $total;
        $id->save();
        $ordenes = Purchase_order::all();
        return redirect()
            ->route('orden-compra', compact('ordenes'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase_order_product  $Purchase_order_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase_order_product $id)
    {
        $n_id = $id->purchase_order_id;
        $id->delete();
        //recalcular total de la orden
        $orden = Purchase_order::find($n_id);
        $aux = 0;
        foreach ($orden->product as $prod) {
            $aux += $prod->cantidad * $prod->precio;
        }
        $total = $aux;
        $orden->total = $total;
        $orden->save();
        $orden_productos = $orden->product;
        $productosall = Product::all();
        return redirect()
            ->route('orden-compra-product-edit', ['id' => $n_id, 'orden' => $orden, 'orden_productos' => $orden_productos, 'productosall' => $productosall])
            ->with('success:', 'Orden eliminada correctamente.');
    }
}
