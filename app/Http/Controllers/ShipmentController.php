<?php

namespace App\Http\Controllers;

use App\Models\shipment;
use App\Models\shipment_type;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Region;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        $users = User::all();
        $shipment_types = shipment_type::all();
        $shipments = shipment::all();
        $products = Product::all();

        return response(view('shipments.index',compact('shipment_types','users','cities','regions','countries','products','shipments')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {

            $user = Auth::user();

            $shipment = new Shipment();
            $shipment->user_fk = $user->id;
            $shipment->status = 'pending';
            $shipment->save();


            $products = Cart::content();

            foreach ($products as $item) {
                $product = Product::find($item->id);


                $shipment->products()->attach($product, ['quantity' => $item->qty]);
                $shipmentProducts[] = [
                    'name' => $product->nombre,
                    'quantity' => $item->qty,

                ];
            }
            $shipment_types = shipment_type::all();
            $shipment->products = $shipmentProducts;
            // //if(user->city->name == 'chillan' || san fernando){

            //     agregar shimpent retiro en mall
            // // }
            // else {
            //     agregar el metodo de despacho(starken)
            // }
            //shipment-> asignar el metodo de entrega
            $shipment->save();

            //Cart::destroy();


            return view('shippingmethod');
        }


        return redirect()->route('login')->with('error', 'Please log in to continue.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(shipment $shipment)
    {
        //
    }
}
