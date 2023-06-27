<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Shipment;
use App\Models\shipment_status;
use App\Models\ShipmentType;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Region;
use App\Models\Product;
use App\Models\Order;
use App\Models\PaymentMethod;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\statusChangeEmail;
use App\Mail\statusChangeAdmin;
use Illuminate\Support\Facades\DB;
use App\Models\Action;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $shipments = Shipment::all();

        foreach ($shipments as $shipment) {
            $user = User::find($shipment->user_fk);
            $country = Country::find($user->country_fk);
            $region = Region::find($user->region_fk);
            $city = City::find($user->city_fk);
            $address = $user->address . ', ' . $city->name . ', ' . $region->name . ', ' . $country->name;
            $shipment->address = $address;
            error_log($address);

            $statuses = DB::table('shipment_statuses')->where('shipment_fk', $shipment->id)->orderBy('created_at', 'asc')->get();
            $shipment->statuses = $statuses;

            foreach ($statuses as $status) {
                if ($statuses->last() == $status) {
                    $shipment->last = $status->nombre_estado;
                    error_log($shipment->last);
                }
            }
        }

        return response(view('shipments.index', compact('shipments')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sections = Section::all();

        if (Auth::check()) {
            $order = json_decode($request->input('order')); 
            
            $shipment = new Shipment();
            $shipment->user_fk = Auth::user()->id;
            $shipment->shipment_type_fk = $request->input('shipment_type_id');
            $shipment->order_fk = $order->id; // Utilizar la variable $order
            $shipment->save();

            $products = Cart::content();
            $shipmentProducts = [];

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

            $paymentMethods = PaymentMethod::all();
            $cart = Cart::content();
            $shipment_type_id = $request->shipment_type_id;
            $shipment_type = ShipmentType::find($shipment_type_id)->nombre;
            $shipmentStatus = new shipment_status();
                $shipmentStatus->nombre_estado = 'pendiente';
                $shipmentStatus->shipment_fk = $shipment->id;
            $shipmentStatus->save();

            return view('paymentmethod_landing', compact('paymentMethods','sections', 'cart', 'shipment_type','order'));
      }
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

    public function status_edit($id)
    {
        $shipment = Shipment::find($id);

        return view('shipments.status_edit', compact('shipment'));
    }

    public function status_update($id, $last)
    {
        error_log("function start");

        $shipment = Shipment::find($id);
        // $shipment->status = $request->status;
        // $shipment->save();
        $user = User::find($shipment->user_fk);
        $order = Order::find($shipment->order_fk);



        // $indexes=DB::table('shipment_statuses')->where('shipment_fk', $shipment->id)->orderBy('created_at', 'desc')->get();
//aqui esto es como se cambia el estado.
        $index = DB::table('shipment_statuses')->where('shipment_fk', $id)->orderBy('created_at', 'desc')->first();

        switch ($last) {
            case ('pendiente'):
                $shipment_status = new shipment_status();
                    $shipment_status->shipment_fk = $id;
                    $shipment_status->nombre_estado = 'pagado';
                $shipment_status->save();

                $status = 'pagado';

                break;
            case ('pagado'):
                $shipment_status = new shipment_status();
                    $shipment_status->shipment_fk = $id;
                    $shipment_status->nombre_estado = 'enviado';
                $shipment_status->save();

                $status = 'enviado';
                $order->estado = 1;
                $order->save();


                break;
            default:
                $shipment_status = new shipment_status();
                    $shipment_status->shipment_fk = $id;
                    $shipment_status->nombre_estado = 'pendiente';
                $shipment_status->save();

                $status = 'pendiente';
        }
        // foreach($indexes as $index){
        //     error_log($index->nombre_estado);
        //     error_log($index->created_at);
        // }
        $traceability = DB::table('shipment_statuses')->where('shipment_fk', $shipment->id)->orderBy('created_at', 'asc')->get();

        Mail::to($user)->queue(new statusChangeEmail($user->name, $status, $id, $traceability));
        Mail::to('admin@test.cl')->queue(new statusChangeAdmin($user->name, $status, $id, $traceability));

        $action = new Action();
            $action->name = 'Progresado estado de envío';
            $action->user_fk = Auth::User()->id;
        $action->save();

        return redirect('/admin/shipments')->with('success', 'Estado del envío actualizado exitosamente!');
    }

    public function status_cancel($id, $last)
    {
        error_log('function start');
        error_log($last);

        if ($last == 'cancelado') {
            return redirect('/admin/shipments')->with('error', 'Este envío ya fué cancelado');
        } elseif ($last == 'enviado') {
            return redirect('/admin/shipments')->with('error', 'Este envío ya fué completado');
        } else {
            $shipment = Shipment::find($id);
            $shipment_status = new shipment_status();
                $shipment_status->shipment_fk = $shipment->id;
                $shipment_status->nombre_estado = 'cancelado';
            $shipment_status->save();

            $user = User::find($shipment->user_fk);
            $traceability = DB::table('shipment_statuses')->where('shipment_fk', $shipment->id)->orderBy('created_at', 'asc')->get();

            Mail::to($user)->queue(new statusChangeEmail($user->name, 'cancelado', $id, $traceability));
            Mail::to('admin@test.cl')->queue(new statusChangeAdmin($user->name, 'cancelado', $id, $traceability));

            $action = new Action();
                $action->name = 'Cancelación de envío';
                $action->user_fk = Auth::User()->id;
            $action->save();
        }



        return redirect('/admin/shipments')->with('success', 'Envío cancelado exitosamente!');
    }
}