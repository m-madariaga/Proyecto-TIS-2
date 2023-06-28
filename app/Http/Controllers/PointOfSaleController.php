<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class PointOfSaleController extends Controller
{
    public function index()
    {
        $orders = Order::all()->where('pagado', 0)->where('paymentmethod_fk', 2);
        $productos = Product::paginate(8);
        return view('point_of_sale.index', compact('orders', 'productos'));
    }
    // establece la orden como pagada
    public function update(Order $id)
    {
        $order = Order::find($id->id);
        $order->pagado = 1;
        $order->estado = 1;
        $order->save();
        return redirect()->route('point_of_sale');
    }
    public function createOrder()
    {
        $contenido = Cart::instance('admin')->content();
        //preguntamos si el carrito esta vacio
        if ($contenido->isNotEmpty()) {
            //creamos nueva orden vacia
            $order = new Order([
                'subtotal' => 0,
                'impuesto' => 0,
                'total' => 0,
                'estado' => 1,
                'pagado' => 0,
                'user_id' => Auth()->user()->id,
                'paymentmethod_fk' => 2,
            ]);
            $order->save();
            //recorremos el contenido del carrito agregando los productos al detalle de la orden
            foreach ($contenido as $key => $producto) {
                $detail = new Detail();
                $detail->precio = $producto->price;
                $detail->cantidad = $producto->qty;
                $detail->monto = $producto->price * $producto->qty;
                $detail->producto_id = $producto->id;
                $detail->pedido_id = $order->id;
                $detail->save();
            }
            //actualizamos los valores de la orden
            $order->subtotal = Cart::instance('admin')->subtotal() * 1000 - Cart::instance('admin')->tax() * 1000;
            $order->impuesto = Cart::instance('admin')->tax() * 1000;
            $order->total = Cart::instance('admin')->subtotal() * 1000;
            $order->pagado = 1;
            $order->save();
            //borrar los productos del carrito
            Cart::instance('admin')->destroy();

            return redirect()->route('orders.index');
        } else {
            return back()->with('error', 'El carrito no contiene productos.');
        }
    }
    //agrega producto al carrito o suma 1 a la cantidad si ya esta
    public function addProduct(Product $id)
    {
        $producto = Product::find($id->id);
        $stock_disponible = $producto->stock;
        //busca el producto en el carrito
        $result = Cart::instance('admin')->search(function ($item, $rowId) use ($producto) {
            return $item->id === $producto->id;
        });
        //pregunta si encontro el producto
        if ($result->isNotEmpty()) {
            //si esta el producto aumenta la cantidad
            $qty = $result->first()->qty; //cantidad actual en el carrito
            $qty++;
            //pregunta si hay suficientes productos
            if ($stock_disponible > 0) {
                //actualiza la cantidad
                Cart::instance('admin')->update($result->first()->rowId, ['qty' => $qty]);
                $producto->stock = $stock_disponible - 1;
                $producto->save();
            } else {
                //retorna un error falta de stock
                return back()->with('error', 'No hay productos en stock');
            }
        } else {
            //si no esta el producto en el carrito pregunta si hay suficientes productos
            if ($stock_disponible > 0) {
                //agrega el producto
                Cart::instance('admin')->add([
                    'id' => $producto->id,
                    'name' => $producto->nombre,
                    'price' => $producto->precio,
                    'qty' => 1,
                    'weight' => 1,
                    'options' => [
                        'urlfoto' => asset("assets/images/images-products/$producto->imagen"),
                        'nombre' => null,
                    ],
                ]);
                //disminuimos el stock
                $producto->stock = $stock_disponible - 1;
                $producto->save();
            } else {
                //retorna un error falta de stock
                return back()->with('error', 'No hay productos en stock');
            }
        }
        return back()->with('success', 'Se agregó el producto al carrito.');
    }
    //diminuye 1 la cantidad de un producto en el carrito
    public function disminuyeCantidad(Product $id)
    {
        //busca el producto en la BD
        $producto = Product::find($id->id);
        $stock_disponible = $producto->stock;
        //busca el producto en el carrito
        $result = Cart::instance('admin')->search(function ($item, $rowId) use ($producto) {
            return $item->id === $producto->id;
        });
        //pregunta si encontro el producto en el carrito
        if ($result->isNotEmpty()) {
            //disminuye la cantidad del producto en el carrito
            $qty = $result->first()->qty;
            $qty--;
            Cart::instance('admin')->update($result->first()->rowId, $qty);
            //aumenta en un el stock del producto
            $producto->stock = $stock_disponible + 1;
            $producto->save();
            //retorna un error falta de stock
        } else {
            return back()->with('error', 'No se encontró el producto en el carrito');
        }
        return back()->with('success', 'Se disminuyó el producto del carrito.');
    }
    //elimina un producto del carrito
    public function dropProduct(Product $id)
    {
        //busca el producto en la BD
        $producto = Product::find($id->id);
        $stock_disponible = $producto->stock;
        //busca el producto en el carrito
        $result = Cart::instance('admin')->search(function ($item, $rowId) use ($producto) {
            return $item->id === $producto->id;
        });
        //si encontro el producto
        if ($result->isNotEmpty()) {
            //guardar cantidad del producto que esta en el carrito
            $qty = $result->first()->qty;
            //quitamos el producto del carrito
            Cart::instance('admin')->remove($result->first()->rowId);
            //actualizamos el producto en la BD (se agrega la cantidad que habia en el carrito)
            $producto->stock = $stock_disponible + $qty;
            $producto->save();
        } else {
            return back()->with('error', 'No se encontró el producto en el carrito');
        }
        return back()->with('success', 'El producto se eliminó del carrito.');
    }
}
