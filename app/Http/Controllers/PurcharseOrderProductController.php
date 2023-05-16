<?php

namespace App\Http\Controllers;

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
        $request->validate([            
            'purchase_order_id' => 'required',
            'products_id' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',       
        ]);       
        $orden_product = new Purchase_order_product([
            'purchase_order_id' => $request->get('purchase_order_id'),
            'products_id' => $request->get('products_id'),
            'cantidad' => $request->get('cantidad'),
            'precio' => $request->get('precio'),            
        ]);       
        $orden_product->save();
        return redirect()->route('orden_producto')->with('success:', 'Orden de compra ingresada correctamente.');
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
