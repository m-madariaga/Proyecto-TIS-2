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
    // establece la orden como pagada
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
    //agrega producto al carrito
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
            $qty = $result->first()->cantidad; //cantidad actual en el carrito
            $qty += 1;
            //pregunta si hay suficientes productos
            if ($qty < $stock_disponible) {
                //actualiza la cantidad
                Cart::instance('admin')->update($result->first()->rowId, $qty);
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
    //aumenta la cantidad de un producto en el carrito
    public function aumentaCantidad(Product $id)
    {
        //busca el producto en la BD
        $producto = Product::find($id->id);
        $stock_disponible = $producto->stock;
        //busca el producto en el carrito
        $result = Cart::instance('admin')->search(function ($item, $rowId) use ($producto) {
            return $item->id === $producto->id;
        });
        if ($result->isNotEmpty()) {
            //pregunta si hay stock disponible para aumentar la cantidad
            if ($stock_disponible > 0) {
                //aumenta la cantidad del producto en el carrito
                $stock_disponible++;
                Cart::instance('admin')->update($result->first()->rowId, $stock_disponible);
                //disminuye en un el stock del producto
                $producto->stock = $stock_disponible - 1;
                $producto->save();
            } else {
                //retorna un error falta de stock
                return back()->with('error', 'No hay productos en stock');
            }
        } else {
            return back()->with('error', 'No se encontro en producto en el carrito');
        }

        return back()->with('success', 'Se agregó el producto al carrito.');
    }
    //diminuye la cantidad de un producto en el carrito
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
        return back()->with('success', 'Se disminuyó el producto al carrito.');
    }
    public function dropProduct(Product $id)
    {
        //busca el producto en la BD
        $producto = Product::find($id->id);
        $stock_disponible = $producto->stock;
        //busca el producto en el carrito
        $result = Cart::instance('admin')->search(function ($item, $rowId) use ($producto) {
            return $item->id === $producto->id;
        });
    }
}
