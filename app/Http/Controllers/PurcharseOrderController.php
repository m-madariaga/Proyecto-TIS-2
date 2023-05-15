<?php

namespace App\Http\Controllers;

use App\Models\Purchase_order;
use Illuminate\Http\Request;

class PurcharseOrderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Purchase_order::all();
        return view('purchase_order.index', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('purchase_order.create');
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
            'total' => 'required',            
        ]);       
        $orden = new Purchase_order([
            'total' => $request->get('total'),
        ]);       
        $orden->save();
        return redirect()->route('orden_compra')->with('success:', 'Orden de compra ingresada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase_order  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase_order $purchase_order)
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
        $ordenes = Purchase_order::all();
        $orden = $ordenes->find($id);
        return view('purchase_order.edit', compact('orden'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase_order  $Purchase_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase_order $id)
    {
        $request->validate([
            'total' => 'required',        
        ]);
        $ordenes = Purchase_order::all();
        $orden = $ordenes->find($id);
        $orden->total = $request->total;$orden->save();
        return redirect()->route('orden_compra')->with('success:', 'Orden actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase_order  $Purchase_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase_order $id)
    {
        $ordenes = Purchase_order::all();
        $orden = $ordenes->find($id);
        $orden->delete();
        return redirect()->route('orden_compra')->with('success:', 'Orden eliminada correctamente.');
    }
}
