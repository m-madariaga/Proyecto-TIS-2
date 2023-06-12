<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Detail;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('order', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->estado = $request->has('estado') ? 1 : 0;
        $order->save();
        return redirect()->route('orders.index');
    }

    public function showOrder($orderId)
    {
        $order = Order::find($orderId);
        $details = Detail::with('product')->where('pedido_id', $orderId)->get();

        return response()->json([
            'order' => $order,
            'details' => $details
        ]); 
    }

    public function store(Request $request, $id)
    {
        $order = Order::find($id);
        $details = Detail::with('product')->where('pedido_id', $id)->get();

        return view('vieworder', compact('order', 'details'));
    }
    public function genera_pdf(Order $id)
    {
        $pdf = PDF::loadView('receipt.ticket_cliente', ['order' => $id]);
        return $pdf->download('ticket.pdf');
    }
}
