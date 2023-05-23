<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('order',compact('orders'));
    }

    public function update(Request $request, $id){
        $order = Order::findOrFail($id);

        $order->estado = $request->has('estado') ? 1 : 0;
        $order->save();
        return redirect()->route('orders.index');
    }
}
