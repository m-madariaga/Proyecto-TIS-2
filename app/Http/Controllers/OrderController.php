<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Detail;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\Action;
use Carbon\Carbon;
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
        $order->pagado = $request->has('pagado') ? 1 : 0;
        $order->save();

        $action = new Action();
        $action->name = 'Edición Pedido';
        $action->user_fk = Auth::User()->id;
        $action->save();

        return redirect()->route('orders.index');
    }

    public function showOrder($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);
        return view('order', compact('order'));
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
    public function getSalesData(Request $request)
    {
        // get the time period from the request, default to 'day'
        $timePeriod = $request->get('timePeriod', 'day');

        // get the date from the request, default to today
        $date = $request->get('date', Carbon::now());

        // calculate the start and end date based on the time period
        switch ($timePeriod)
        {
            case 'day':
                $startDate = Carbon::parse($date)->startOfDay();
                $endDate = Carbon::parse($date)->endOfDay();
                break;
            case 'week':
                $startDate = Carbon::parse($date)->startOfWeek();
                $endDate = Carbon::parse($date)->endOfWeek();
                break;
            case 'month':
                $startDate = Carbon::parse($date)->startOfMonth();
                $endDate = Carbon::parse($date)->endOfMonth();
                break;
        }

        // get the orders between the start and end date and where 'pagado' is '1'
        $orders = Order::where('pagado', '1')->whereBetween('created_at', [$startDate, $endDate])->get();

        // calculate the sales data
        $salesData = $orders->groupBy(function ($order)
        {
            return Carbon::parse($order->created_at)->format('Y-m-d');
        })->map(function ($ordersPerDay)
        {
            return $ordersPerDay->sum('total');
        });

        // return the sales data
        return response()->json($salesData);
    }
    public function getTodaysSalesData()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $todaySales = Order::whereDate('created_at', $today)->where('pagado', '1')->sum('total');
        $yesterdaySales = Order::whereDate('created_at', $yesterday)->where('pagado', '1')->sum('total');

        $salesDifference = $todaySales - $yesterdaySales;
        $percentageChange = ($yesterdaySales > 0) ? ($salesDifference / $yesterdaySales) * 100 : 0;

        return response()->json([
            'todaySales' => $todaySales,
            'percentageChange' => $percentageChange,
        ]);
    }
    public function getNewClientsData()
    {
        $currentQuarterStart = Carbon::now()->firstOfQuarter();
        $lastQuarterStart = Carbon::now()->subQuarter()->firstOfQuarter();
        $lastQuarterEnd = Carbon::now()->subQuarter()->lastOfQuarter();

        $currentQuarterClients = Order::where('created_at', '>=', $currentQuarterStart)
            ->where('pagado', '1')
            ->distinct('user_id')
            ->count('user_id');

        $lastQuarterClients = Order::whereBetween('created_at', [$lastQuarterStart, $lastQuarterEnd])
            ->where('pagado', '1')
            ->distinct('user_id')
            ->count('user_id');

        $clientDifference = $currentQuarterClients - $lastQuarterClients;
        $percentageChange = ($lastQuarterClients > 0) ? ($clientDifference / $lastQuarterClients) * 100 : 0;

        return response()->json([
            'currentQuarterClients' => $currentQuarterClients,
            'percentageChange' => $percentageChange,
        ]);
    }
}
