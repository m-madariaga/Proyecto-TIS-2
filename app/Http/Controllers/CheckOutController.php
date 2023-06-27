<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\SocialNetwork;
use App\Models\User;

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CheckOutTransfer(Request $request)
    {
        $sections = Section::all();
        $socialnetworks = SocialNetwork::all();
        $cart = $request->input('cart_id');
        $userId = auth()->id();
        $user = User::find($userId);

        $cart = Cart::content();
        $shipment_type = $request->input('shipment_type');
        $paymentMethodId = $request->input('paymentMethod');
        $paymentMethod = PaymentMethod::find($paymentMethodId);

        if ($paymentMethod) {
            $dataBankTransfers = $paymentMethod->dataBankTransfers;

            if ($dataBankTransfers->count() > 0) {
                $selectedAccount = $dataBankTransfers->where('selected', 1)->first();
            } else {
                $selectedAccount = null;
            }
        } else {
            $selectedAccount = null;
        }

        if ($selectedAccount) {
            $name = $selectedAccount->name;
            $run = $selectedAccount->run;
            $email = $selectedAccount->email;
            $bank = $selectedAccount->bank;
            $accountType = $selectedAccount->account_type;
            $accountNumber = $selectedAccount->account_number;
        } else {
            $name = 'Nombre desconocido';
            $run = 'RUN desconocido';
            $email = 'Email desconocido';
            $bank = 'Banco desconocido';
            $accountType = 'Tipo de cuenta desconocido';
            $accountNumber = 'Número de cuenta desconocido';
        }

        $order = json_decode($request->input('order'));

        return view('checkout_transfer', compact('cart','sections', 'shipment_type', 'name', 'run', 'email', 'bank', 'accountType', 'accountNumber', 'order','socialnetworks'));
    }

    // Funcion comprobar transferencia bancaria
}
