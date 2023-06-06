<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\User;

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

 

    public function CheckOut(Request $request)
{
    $cart = $request->input('cart_id');
    $userId = auth()->id();
    $user = User::find($userId);
    
    $cart = Cart::content();
    $shipment_type = $request->input('shipment_type');
    $paymentMethodId = $request->input('paymentMethod');
    $paymentMethod = PaymentMethod::find($paymentMethodId);
    
    if ($paymentMethod) {
        $paymentMethodName = $paymentMethod->name;
    } else {
        // Manejar el caso en que $paymentMethod es nulo
        $paymentMethodName = 'Nombre de método de pago desconocido';
    }
    
    return view('checkout', [
        'paymentMethodName' => $paymentMethodName,
        'cart' => $cart,
        'shipment_type' => $shipment_type
    ]);
}


   

   
}
