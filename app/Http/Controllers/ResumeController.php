<?php

namespace App\Http\Controllers;
use App\Models\Images;
use App\Models\Section;
use App\Models\SocialNetwork;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

 

    public function showResume(Request $request)
    {
        $sections = Section::all();
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $cart = $request->input('cart_id');
        $userId = auth()->id();
        $user = User::find($userId);
    
        $cart = Cart::content();
        $shipment_type = $request->input('shipment_type');
        $paymentMethodId = $request->input('paymentMethod');
        $order = $request->input('order');
        $paymentMethod = PaymentMethod::find($paymentMethodId);
        $orderid = json_decode($order); // Convert the $order string to an object
        $order = Order::find($orderid->id); // Reemplaza $orderId con la variable que contiene el ID del pedido

        $order->paymentmethod_fk = $paymentMethod->id;
        $order->update(); // Guardar los cambios en la base de datos
    
        return view('resume', compact('paymentMethod','sections' ,'cart', 'shipment_type','order','socialnetworks','images'));
    }
    
    

}
