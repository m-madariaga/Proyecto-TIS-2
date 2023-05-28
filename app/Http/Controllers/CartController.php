<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function additem(Request $request)
    {
        $productIds = $request->input('id');
        $quantity = $request->input('quantity');
        $user = auth()->user();

        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);

            $qty = isset($quantity[$index]) ? $quantity[$index] : 1; // Verificar si el índice está definido

            Cart::add([
                'id' => $product->id,
                'name' => $product->nombre,
                'price' => $product->precio,
                'qty' => $qty,
                'weight' => 1,
                'options' => [
                    'urlfoto' => asset("assets/images/images-products/$product->imagen"),
                    'nombre' => null,
                ]
            ]);
        }

        if ($user) {
            return redirect()->back()->with('success', 'Los productos se han agregado al carrito exitosamente');
        } else {
            return redirect()->back()->with('success', 'Los productos se han agregado al carrito exitosamente');
        }
    }



    public function showCart()
    {
        $user = auth()->user();

        if ($user) {
            $items = Cart::content();
        } else {
            $cartItems = session('cart_items', []);
            $items = Product::whereIn('id', $cartItems)->get();
        }

        return view('cart', compact('items'));
    }


    public function removeitem(Request $request)
    {
        $item = $request->route('rowId');
        Cart::remove($item);
        return redirect()->back()->with('success', 'El producto se ha eliminado del carrito exitosamente');
    }
    public function incrementitem(Request $request)
    {
        $item = Cart::content()->where("rowId", $request->id)->first();
        Cart::Update($request->id, ["qty" => $item->qty + 1]);
        return back();
    }

    public function decrementitem(Request $request)
    {
        $item = Cart::content()->where("rowId", $request->id)->first();
        Cart::Update($request->id, ["qty" => $item->qty - 1]);
        return back();
    }

    public function destroycart()
    {
        Cart::destroy();
        return back();
    }

    public function confirmcart()
    {
        $order = new Order();
        $order->subtotal = Cart::subtotal();
        $order->impuesto = Cart::tax();
        $order->total = Cart::subtotal();
        // $order -> fecha_pedido = $order->created_at;
        $order->estado = 1;

        $order->user_id = auth()->user()->id;
        $order->save();

        foreach (Cart::content() as $item) {
            $detail = new Detail();
            $detail->precio = $item->price;
            $detail->cantidad = $item->qty;
            $detail->monto = $item->precio * $item->qty;
            $detail->producto_id = $item->id;
            $detail->pedido_id = $order->id;
            $detail->save();
        }

        Cart::destroy();
        return back();
    }
}
