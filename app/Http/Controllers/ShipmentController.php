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
use Cart;
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = shipment::all();
        foreach ($shipments as $shipment) {
            $user = User::find($shipment->user_fk);
            $country = Country::find($user->country_fk);
            $region = Region::find($user->region_fk);
            $city = City::find($user->city_fk);
            $address= $user->address. ', ' .$city->name. ', ' .$region->name.', '.$country->name;
            $shipment->address= $address;
            error_log($address);

        }

        return response(view('shipments.index',compact('shipments')));

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

            $shipment->products = $shipmentProducts;
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

    public function status_edit($id)
    {
        $shipment = Shipment::find($id);

        return view('shipments.status_edit', compact('shipment'));
    }

    public function status_update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $shipment = Shipment::find($id);
        $shipment->status = $request->status;
        $shipment->save();
        $user = User::find($shipment->user_fk);

        Mail::to($user)->queue(new statusChangeEmail($user->name, $request->id, $shipment->status));


        return redirect('/admin/shipments')->with('success', 'Estado del envío actualizado exitosamente!');
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
    public function destroy($id)
    {
        $shipment = Shipment::find($id);
        $shipment->delete();
        error_log("test");

        return response()->json(['success' => true]);
    }
}
