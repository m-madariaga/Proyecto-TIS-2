<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProofPayment;

class TransbankController extends Controller
{
    public function __construct()
    {
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(
                env('WEBPAY_PLUS_CC'),
                env('WEBPAY_PLUS_API_KEY')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function checkOutTransBank(Request $request)
    {
        try {
            $order = json_decode($request->input('order'));

            // Accede a los campos del pedido según sea necesario
            $total = $order->total;
            $orderId = $order->id;

            // Realiza el procesamiento necesario con los datos del carrito
            $amount = round($total);
            // Genera identificadores de compra y sesión
            $buyOrder = uniqid();
            $sessionId = uniqid();
            $previousUrl = url()->previous();
            session()->put('previous_url', $previousUrl);
            $returnUrl = route('confirmationcart', ['orderId' => $orderId]);

            // Crea la transacción en Webpay Plus
            $transaction = (new Transaction)->create(
                $buyOrder,
                $sessionId,
                $amount,
                $returnUrl
            );

            // Obtiene la URL de redirección proporcionada por Transbank
            $redirectUrl = $transaction->getUrl() . '?token_ws=' . $transaction->getToken();

            // Redirige al usuario a la página de pago de Transbank
            return redirect()->away($redirectUrl);
        } catch (\Exception $e) {
            return redirect()->route('webpay.error')->with('error', 'Error al procesar el pago. Por favor, inténtalo nuevamente')->withInput();
        }
    }

    public function confirmOrderTransbank(Request $request, $orderId)
    {
        try {
            $user = Auth::user();
            $order = Order::findOrFail($orderId);

            if ($user && $order->user_id === $user->id && $order->estado === 0) {
                $order->estado = 1; // Cambiar el estado a pagado
                $order->save();
                Mail::to($user->email)->send(new ProofPayment($order->id));
                Cart::destroy();
                return redirect()->route('home-landing')->with('success', 'La compra se realizó correctamente');
            } else {
                return redirect()->back()->with('error', 'No se puede confirmar la orden');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al confirmar la orden. Por favor, inténtalo nuevamente')->withInput();
        }
    }

    public function handleWebpayError(Request $request)
    {
        // Obtener la URL anterior de la sesión
        $previousUrl = session()->get('previous_url');

        // Redirigir al usuario a la URL anterior
        return redirect()->to($previousUrl)->with('error', 'Error en el pago. Por favor, inténtalo nuevamente.');
    }
}
