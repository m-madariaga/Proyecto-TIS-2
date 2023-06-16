<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\ShipmentType;
use Illuminate\Http\Request;

class ShippingMethodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $cartId = $request->input('cart_id');
        $userId = auth()->id(); // Obtener el ID del usuario conectado
        $order = $request->session()->get('order');
        @error_log("aqui llega el order:" . $order);
        // Obtener la dirección del usuario
        $user = User::find($userId);
        $address = strtolower($user->address);

        // Determinar el método de envío a mostrar
        $selectedMethod = ($this->isInChillanOrSanFernando($address)) ? 'retiro' : 'starken';

        // Obtener todos los métodos de envío
        $shipment_types = ShipmentType::all();

        $cart = Cart::content();
        $product = Product::all();

        return view('shippingmethod', compact('shipment_types', 'cartId', 'cart', 'selectedMethod', 'product', 'order'));
    }


    private function isInChillanOrSanFernando($address)
    {
        return strpos($address, 'chillan') !== false || strpos($address, 'san fernando') !== false;
    }


}