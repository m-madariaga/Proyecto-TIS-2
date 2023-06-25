<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class PointOfSaleController extends Controller
{
    public function index()
    {
        $orders = Order::all()->where('pagado', 0);
        $productos = Product::paginate(2);;
        return view('point_of_sale.index', compact('orders', 'productos'));
    }
    public function update(Order $id)
    {
        $order = Order::find($id->id);
        $order->pagado = 1;
        $order->save();
        return redirect()->route('point_of_sale');
    }
}
