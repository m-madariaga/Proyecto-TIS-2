<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PointOfSaleController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('point_of_sale.index',compact('orders'));
    }
}
