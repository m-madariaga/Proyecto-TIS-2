<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentType;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Region;
use App\Models\Product;
use App\Models\PaymentMethod;
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
        $shipment_types = ShipmentType::all();
        $shipments = shipment::all();
        $products = Product::all();

        return response(view('shipments.index', compact('shipment_types', 'users', 'cities', 'regions', 'countries', 'products', 'shipments')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $shipment = new Shipment();
            $shipment->user_fk = $user->id;
            $shipment->status = 'pending';
            $shipment->shipment_type_fk = $request->input('shipment_type_id');
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

            $shipment->products = $shipmentProducts;
            $paymentMethods = PaymentMethod::all(); // Reemplaza PaymentMethod con el modelo adecuado para obtener los métodos de pago

            return view('paymentmethod_landing', compact('paymentMethods'));

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