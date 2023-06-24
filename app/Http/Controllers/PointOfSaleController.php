<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class PointOfSaleController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $productos = Product::all();
        return view('point_of_sale.index', compact('orders', 'productos'));
    }
    public function store(Request $request)
    {
    }
}
