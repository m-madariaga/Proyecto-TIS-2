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

    public function CheckOutTransfer(Request $request)
    {
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
                // Acceder al primer registro de transferencia bancaria (puedes ajustar esto según tus necesidades)
                $dataBankTransfer = $dataBankTransfers->first();
                $name = $dataBankTransfer->name;
                $run = $dataBankTransfer->run;
                $email = $dataBankTransfer->email;
                $bank = $dataBankTransfer->bank;
                $accountType = $dataBankTransfer->account_type;
                $accountNumber = $dataBankTransfer->account_number;
            } else {
                // Manejar el caso en que no se encontraron datos de transferencia bancaria
                $name = 'Nombre desconocido';
                $run = 'RUN desconocido';
                $email = 'Email desconocido';
                $bank = 'Banco desconocido';
                $accountType = 'Tipo de cuenta desconocido';
                $accountNumber = 'Número de cuenta desconocido';
            }
        } else {
            // Manejar el caso en que no se encontró el método de pago
            $name = 'Nombre desconocido';
            $run = 'RUN desconocido';
            $email = 'Email desconocido';
            $bank = 'Banco desconocido';
            $accountType = 'Tipo de cuenta desconocido';
            $accountNumber = 'Número de cuenta desconocido';
        }



        return view('checkout_transfer', [
            'cart' => $cart,
            'shipment_type' => $shipment_type,
            'name' => $name,
            'run' => $run,
            'email' => $email,
            'bank' => $bank,
            'accountType' => $accountType,
            'accountNumber' => $accountNumber
        ]);
    }





}