<?php

namespace App\Http\Controllers;

use App\Mail\ProofPayment;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Section;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\lowStockNotif;
use Illuminate\Support\Facades\Notification;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function checkStock()
    {
        $products = Product::all();

        foreach ($products as $product) {
            if ($product->stock <= 0) {
                $product->stock = 0;
                $product->save();
            }
        }
    }

    private function updateStock($productId)
    {
        $product = Product::find($productId);

        if ($product && $product->stock < 0) {
            $product->stock = 0;
            $product->save();
        }
    }

    public function additem(Request $request)
    {
        $productIds = $request->input('id');
        $quantity = $request->input('quantity');


        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);

            $qty = isset($quantity[$index]) ? $quantity[$index] : 1; // Verificar si el índice está definido

            if ($product->stock >= $qty && $qty >= 1) {
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
                        // Actualizar la cantidad en el carrito al stock disponible
                        Cart::update($cartItem->first()->rowId, $product->stock);


                        $this->updateStock($product->id);

                        // No hay suficiente stock, mostrar un mensaje de advertencia o realizar alguna acción apropiada
                        return redirect()->back()->with('warning', 'La cantidad del producto se ha ajustado al stock disponible');
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
                    $product->stock = max(0, $product->stock); // Convert negative stock to zero

                    if ($product->stock < 5) {
                        $admins = User::role('admin')->get();
                        Notification::send($admins, new lowStockNotif("blusa"));
                    }

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
        $socialnetworks = SocialNetwork::all();
        $sections = Section::all();
        $this->checkStock();

        $user = Auth::user();
        $order = session('order'); // Obtener el pedido de la sesión

        if ($user && !$order) {
            // El usuario está autenticado pero no hay un pedido en la sesión
            $items = Cart::content();
        } elseif ($order) {
            // Mostrar los detalles del pedido almacenado en la sesión
            $items = $order->details;
        } else {
            // El usuario no está autenticado y no hay un pedido en la sesión
            $cartItems = session('cart_items', []);
            $items = [];
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem['id']);
                $product->quantity = $cartItem['quantity'];
                $items[] = $product;
            }
        }

        $items = collect($items)->filter(function ($item) {
            return $item->stock > 0;
        });

        return view('cart', compact('items', 'socialnetworks', 'sections'));
    }


    public function removeitem(Request $request)
    {
        $rowId = $request->route('rowId');
        $item = Cart::get($rowId);

        if ($item) {
            Cart::remove($rowId);

            // Incrementar el stock del producto eliminado
            $product = Product::find($item->id);
            $product->stock += $item->qty;
            $product->save();

            $this->updateStock($product->id);

            return redirect()->back()->with('success', 'El producto se ha eliminado del carrito exitosamente');
        }

        return redirect()->back()->with('error', 'El producto no se encontró en el carrito');
    }


    public function incrementitem(Request $request)
    {
        $item = Cart::get($request->id);

        if ($item) {
            Cart::update($request->id, $item->qty + 1);

            // Disminuir el stock del producto en la base de datos
            $product = Product::find($item->id);
            $product->decrement('stock');

            if ($product->stock < 5) {
                $admins = User::role('admin')->get();
                Notification::send($admins, new lowStockNotif("blusa"));
            }
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

    public function generateOrder()
{
    $user = Auth::user();
    $order = session('order'); // Obtener el pedido de la sesión

    if (!$order) {
        // Si no hay un pedido en la sesión, crear uno nuevo
        $order = new Order();
        $order->subtotal = Cart::subtotal() * 1000 - Cart::tax() * 1000;
        $order->impuesto = Cart::tax() * 1000;
        $order->total = Cart::subtotal() * 1000;
        $order->estado = 0;
        $order->user_id = $user->id;
        $order->paymentmethod_fk = null; // Establecer paymentmethod_fk como nulo
        $order->save();
    } else {
        // Si hay un pedido en la sesión, actualiza los detalles del pedido existente en lugar de crear uno nuevo
        $order->details()->delete(); // Elimina los detalles del pedido existentes

        // Actualiza los montos y otros detalles del pedido si es necesario
        $order->subtotal = Cart::subtotal() * 1000 - Cart::tax() * 1000;
        $order->impuesto = Cart::tax() * 1000;
        $order->total = Cart::subtotal() * 1000;
        $order->estado = 0;
        $order->user_id = $user->id;
        $order->paymentmethod_fk = null; // Establecer paymentmethod_fk como nulo
        $order->save();
    }

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

        if ($product->stock < 5) {
            $admins = User::role('admin')->get();
            Notification::send($admins, new lowStockNotif("blusa"));
        }

        $this->updateStock($item->id);
    }

    // Almacenar el pedido en la sesión
    session()->put('order', $order);

    return redirect()->action([ShippingMethodsController::class, 'index'])->with('order', $order);
}





    public function confirmOrder($orderId)
    {
        $user = Auth::user();
        $order = Order::findOrFail($orderId);
        Cart::destroy();
        session()->forget('order');

        Mail::to($user->email)->send(new ProofPayment($order->id));
        return redirect()->route('home-landing')->with('success', 'La Compra se realizó correctamente');
    }
}
