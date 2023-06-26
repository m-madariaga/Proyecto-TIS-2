<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PointOfSaleController extends Controller
{
    public function index()
    {
        $orders = Order::all()->where('pagado', 0);
        $productos = Product::paginate(8);
        return view('point_of_sale.index', compact('orders', 'productos'));
    }
    public function update(Order $id)
    {
        $order = Order::find($id->id);
        $order->pagado = 1;
        $order->save();
        return redirect()->route('point_of_sale');
    }
    public function store(Request $request)
    {
    }
    public function addProduct(Product $id)
    {
        $producto = Product::find($id->id);
        $stock_disponible = $producto->stock;
        //busca el producto en el carrito
        $result = Cart::search(function ($item, $rowId) {
            return $item->id === $producto->id;
        });
        //pregunta si encontro el producto
        if ($result->isNotEmpty()) {
            //si esta el producto aumenta la cantidad
            $cant_actual = $result->cantidad;
            $cant_actual += 1;
            //pregunta si hay suficientes productos
            if ($cant_actual < $stock_disponible) {
                //actualiza la cantidad
                Cart::instance('admin')->update($result->rowId, ['cantidad' => $cant_actual]);
            } else {
                //retorna un error falta de stock
                return back()->with('error','No hay stock disponible.');
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
                return back()->withErrors('error-stock', 'No hay stock disponible.');
            }
        }
        return back();
    }
}
