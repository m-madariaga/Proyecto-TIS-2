<?php

namespace App\Http\Controllers;

use App\Mail\ProofPayment;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function additem(Request $request)
    {
        $productIds = $request->input('id');
        $quantity = $request->input('quantity');
        $user = Auth::user();

        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);

            $qty = isset($quantity[$index]) ? $quantity[$index] : 1; // Verificar si el índice está definido

            if ($product->stock >= $qty) {
                $cartItem = Cart::search(function ($cartItem, $rowId) use ($productId) {
                    return $cartItem->id === $productId;
                });

                if ($cartItem->isNotEmpty()) {
                    // Si el producto ya existe en el carrito, incrementar la cantidad
                    $existingQty = $cartItem->first()->qty;
                    $qty += $existingQty;

                    // Verificar si hay suficiente stock antes de actualizar la cantidad en el carrito
                    if ($product->stock >= $qty) {
                        Cart::update($cartItem->first()->rowId, $qty);
                    } else {
                        // No hay suficiente stock, mostrar un mensaje de error o realizar alguna acción apropiada
                        return redirect()->back()->with('error', 'No hay suficiente stock disponible para este producto');
                    }
                } else {
                    // Si el producto no existe en el carrito, agregarlo
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

                    // Disminuir el stock del producto
                    $product->stock -= $qty;
                    $product->save();
                }
            } else {
                // No hay suficiente stock, mostrar un mensaje de error o realizar alguna acción apropiada
                return redirect()->back()->with('error', 'No hay suficiente stock disponible para este producto');
            }
        }

        return redirect()->back()->with('success', 'Los productos se han agregado al carrito exitosamente');
    }

    public function showCart()
    {
        $user = Auth::user();

        if ($user) {
            $items = Cart::content();
        } else {
            $cartItems = session('cart_items', []);
            $items = [];
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem['id']);
                $product->quantity = $cartItem['quantity'];
                $items[] = $product;
            }
        }

        return view('cart', compact('items'));
    }

    public function removeitem(Request $request)
    {
        $item = $request->route('rowId');
        Cart::remove($item);

        // Incrementar el stock del producto eliminado
        $removedItem = Cart::get($item); // Obtener el producto eliminado
        $product = Product::find($removedItem->id);
        $product->stock += $removedItem->qty;
        $product->save();

        return redirect()->back()->with('success', 'El producto se ha eliminado del carrito exitosamente');
    }

    public function incrementitem(Request $request)
    {
        $item = Cart::get($request->id);

        if ($item) {
            Cart::update($request->id, $item->qty + 1);

            // Disminuir el stock del producto en la base de datos
            $product = Product::find($item->id);
            $product->decrement('stock');
        }

        return back();
    }

    public function decrementitem(Request $request)
    {
        $item = Cart::get($request->id);

        if ($item && $item->qty > 1) {
            Cart::update($request->id, $item->qty - 1);

            // Aumentar el stock del producto en la base de datos
            $product = Product::find($item->id);
            $product->increment('stock');
        }

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
        $order->subtotal = Cart::subtotal() * 1000 - Cart::tax() * 1000;
        $order->impuesto = Cart::tax() * 1000;
        $order->total = Cart::subtotal() * 1000;
        $order->estado = 0;
        $order->user_id = Auth::user()->id;
        $order->save();

        foreach (Cart::content() as $item) {
            $detail = new Detail();
            $detail->precio = $item->price;
            $detail->cantidad = $item->qty;
            $detail->monto = $detail->cantidad * $detail->precio;
            $detail->producto_id = $item->id;
            $detail->pedido_id = $order->id;
            $detail->save();

            // Disminuir el stock del producto
            $product = Product::find($item->id);
            $product->stock -= $item->qty;
            $product->save();
        }

        Mail::to(Auth::user()->email)->send(new ProofPayment($order->id));
        Cart::destroy();
        return redirect()->route('home-landing');
    }
}
