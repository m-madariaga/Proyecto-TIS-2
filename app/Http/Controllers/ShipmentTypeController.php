<?php

namespace App\Http\Controllers;

use App\Models\ShipmentType;
use Illuminate\Http\Request;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class ShipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipment_types = ShipmentType::all();
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

        $shipment_type = new ShipmentType([

            'nombre' => $request->get('nombre'),
        ]);

        $shipment_type->save();

        $action = new Action();
            $action->name = 'Creación Tipo de Envío';
            $action->user_fk = Auth::User()->id;
        $action->save();


        return redirect('admin/shipment_types')->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShipmentType  $shipment_type
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentType $shipment_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipmentType  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipment_type = ShipmentType::find($id);




        return response(view('shipment_types.edit', compact('shipment_types')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipmentType  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nombre' => 'required',

        ]);

        $shipment_type = ShipmentType::find($id);

        $shipment_type->nombre = $request->get('nombre');

        $shipment_type->save();

        $action = new Action();
            $action->name = 'Edición Tipo de Envío';
            $action->user_fk = Auth::User()->id;
        $action->save();


        return redirect('admin/shipment_types')->with('success', 'Tipo de envío actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipmentType  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipment_types = ShipmentType::find($id);
        $shipment_types->delete();

        $action = new Action();
            $action->name = 'Borrado Tipo de Envío';
            $action->user_fk = Auth::User()->id;
        $action->save();

        //return response()->json(['success' => true]);
        return response()->json(['success' => true]);
    }

}
