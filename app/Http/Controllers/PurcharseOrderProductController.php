<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $orden_product = Purchase_order_product::all();
        return view('purchase_order_product.index', compact('orden_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase_order_product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->get('datos');
        $id = $request->get('orden_id');
        $all = $request->all();
        // reiniciar los indices para que sean consecutivos
        $cant = array();
        foreach ($datos['cantidad'] as $key => $value) {
            array_push($cant, $value);
        }
        $val = array();
        foreach ($datos['valor'] as $key => $value) {
            array_push($val, $value);
        }
        for ($i=0; $i < sizeof($datos['prod_id']); $i++) {
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
        return redirect()->route('orden-compra')->with('success:', 'Orden de compra ingresada correctamente.');
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
     * @param  \App\Models\Purchase_order_product  $Purchase_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase_order_product $id)
    {
        $ordenes = Purchase_order_product::all();
        $orden = $ordenes->find($id);
        return view('Purchase_order_product.edit', compact('orden'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase_order_product  $Purchase_order_product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase_order_product $id)
    {
        $request->validate([
            'purchase_order_id' => 'required',
            'products_id' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
        ]);
        $ordenes = Purchase_order_product::all();
        $orden = $ordenes->find($id);
        $orden->purchase_order_id = $request->purchase_order_id;
        $orden->products_id = $request->products_id;
        $orden->cantidad = $request->cantidad;
        $orden->precio = $request->precio;
        $orden->save();
        return redirect()->route('orden_compra')->with('success:', 'Orden actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase_order_product  $Purchase_order_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase_order_product $id)
    {
        $ordenes = Purchase_order_product::all();
        $orden = $ordenes->find($id);
        $orden->delete();
        return redirect()->route('orden_producto')->with('success:', 'Orden eliminada correctamente.');
    }
}
