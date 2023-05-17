<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function additem(Request $request)
    {
        $productIds = $request->input('id');

        foreach ($productIds as $productId) {
            $product = Product::find($productId);

            Cart::add([
                'id' => $product->id,
                'name' => $product->nombre,
                'price' => $product->precio,
                'qty' => 1,
                'weight' => 1,
                'options' => [
                    'urlfoto' => $product->imagen,
                    'nombre' => null,
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Los productos se han agregado al carrito exitosamente');
    }

    public function showCart()
    {
        $cartItems = Cart::content();
        return view('cart', compact('cartItems'));
    }

    public function removeitem(Request $request)
    {
        $rowId = $request->input('rowId');
        Cart::remove($rowId);
        return redirect()->back()->with('success', 'El producto se ha eliminado del carrito exitosamente');
    }
}
