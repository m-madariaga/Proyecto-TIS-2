<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Models\User;
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
        $cart = $request->input('cart_id');
        $userId = auth()->id();
        $user = User::find($userId);
        
        $cart = Cart::content();
        $shipment_type = $request->input('shipment_type_id');
        $paymentMethodId = $request->input('paymentMethod');
        $paymentMethod = PaymentMethod::find($paymentMethodId);
        
        $paymentMethodName = $paymentMethod->name;
        return view('resume', compact('paymentMethodName', 'cart', 'shipment_type'));
    }

    public function orderConfirmation()
    {
        return view('order_confirmation');
    }
}
