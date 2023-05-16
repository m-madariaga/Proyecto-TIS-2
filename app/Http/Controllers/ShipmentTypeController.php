<?php

namespace App\Http\Controllers;

use App\Models\shipment_type;
use Illuminate\Http\Request;

class ShipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipment_types = shipment_type::all();
        return response(view('shipment_types.index',compact('shipment_types')));
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
        $request->validate([

            'nombre' => 'required|string',
        ]);

        $shipment_type = new shipment_type([

            'nombre' => $request->get('nombre'),
        ]);

        $shipment_type->save();


        return redirect('admin/shipment_types')->with('success', 'Tipo de envío creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shipment_type  $shipment_type
     * @return \Illuminate\Http\Response
     */
    public function show(shipment_type $shipment_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shipment_type  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipment_type = shipment_type::find($id);




        return response(view('shipment_types.edit', compact('shipment_types')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shipment_type  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nombre' => 'required',

        ]);

        $shipment_type = shipment_type::find($id);

        $shipment_type->nombre = $request->get('nombre');

        $shipment_type->save();


        return redirect('admin/shipment_types')->with('success', 'Tipo de envío actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipment_type  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipment_types = shipment_type::find($id);
        $shipment_types->delete();

        //return response()->json(['success' => true]);
        return redirect('admin/shipment_types')->with('success', 'Tipo de envío eliminado exitosamente!');
    }

}
