<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;

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

    public function CheckOutTransBank(Request $request)
    {
        $cart = Cart::content();

        // Realiza el procesamiento necesario con los datos del carrito
        $amount = round(Cart::subtotal());
        // Genera identificadores de compra y sesión
        $buyOrder = uniqid();
        $sessionId = uniqid();
        $return_url = route('confirmationcart');
        // Crea la transacción en Webpay Plus
        $transaccion = (new Transaction)->create(
            $buyOrder,
            $sessionId,
            $amount,
            $return_url
        );
        // Obtiene la URL de redirección proporcionada por Transbank
        $redirectUrl = $transaccion->getUrl() . '?token_ws=' . $transaccion->getToken();

        // Redirige al usuario a la página de pago de Transbank
        return redirect()->away($redirectUrl);
    }

    public function confirmCart(Request $request)
    {
        // Obtén los datos de la respuesta de Transbank
        $token = $request->input('token_ws');

        // Verifica y confirma la transacción en Webpay Plus
        $response = (new Transaction)->commit($token);

        // Procesa el resultado de la transacción
        if ($response->isApproved()) {
            // La transacción fue aprobada
            // Realiza las acciones necesarias (por ejemplo, actualizar el estado del carrito, generar la orden, etc.)

            return "¡Transacción exitosa! Gracias por tu compra.";
        } else {
            // La transacción fue rechazada o hubo un error
            // Realiza las acciones necesarias (por ejemplo, mostrar un mensaje de error, redirigir a otra página, etc.)

            return "La transacción no pudo ser completada. Por favor, inténtalo nuevamente.";
        }
    }
}