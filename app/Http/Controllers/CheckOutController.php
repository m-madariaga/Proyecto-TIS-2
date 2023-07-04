<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Notifications\lowStockNotif;
use Illuminate\Support\Facades\Notification;
use App\Mail\ProofPayment;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Models\ComprobanteTransfer;

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CheckOutTransfer(Request $request)
    {
        $sections = Section::all();
        $socialnetworks = SocialNetwork::all();
        $cart = $request->input('cart_id');
        $userId = auth()->id();
        $user = User::find($userId);

        $cart = Cart::content();
        $shipment_type = $request->input('shipment_type');
        $paymentMethodId = $request->input('paymentMethod');
        $paymentMethod = PaymentMethod::find($paymentMethodId);

        if ($paymentMethod) {
            $dataBankTransfers = $paymentMethod->dataBankTransfers;

            if ($dataBankTransfers->count() > 0) {
                $selectedAccount = $dataBankTransfers->where('selected', 1)->first();
            } else {
                $selectedAccount = null;
            }
        } else {
            $selectedAccount = null;
        }

        if ($selectedAccount) {
            $name = $selectedAccount->name;
            $run = $selectedAccount->run;
            $email = $selectedAccount->email;
            $bank = $selectedAccount->bank;
            $accountType = $selectedAccount->account_type;
            $accountNumber = $selectedAccount->account_number;
        } else {
            $name = 'Nombre desconocido';
            $run = 'RUN desconocido';
            $email = 'Email desconocido';
            $bank = 'Banco desconocido';
            $accountType = 'Tipo de cuenta desconocido';
            $accountNumber = 'Número de cuenta desconocido';
        }

        $order = json_decode($request->input('order'));

        return view('checkout_transfer', compact('cart', 'sections', 'shipment_type', 'name', 'run', 'email', 'bank', 'accountType', 'accountNumber', 'order', 'socialnetworks'));
    }

    public function confirmOrder(Request $request, $orderId)
    {
        $user = Auth::user();
        $order = Order::findOrFail($orderId);
        Cart::destroy();
        session()->forget('order');

        // Guardar el archivo
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $rutaGuardar = 'comprobantes_transferencia/'; // Especifica la carpeta donde se guardarán los archivos
            $nombreArchivo = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move($rutaGuardar, $nombreArchivo);

            // Crear un nuevo registro en la tabla ComprobanteTransfer
            $comprobante = new ComprobanteTransfer();
            $comprobante->order_id = $order->id;
            $comprobante->direccion_comprobante = $rutaGuardar . $nombreArchivo;
            $comprobante->save();
        }

        Mail::to($user->email)->send(new ProofPayment($order->id, 'Pedido'));
    }
    public function update($orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            $order->pagado = 1;
            $order->estado = 1;
            $order->save();
            return redirect()->route('documents.index');
        } else {
            // Handle the case when the order is not found
            return redirect()->back()->with('error', 'Order not found.');
        }
    }
}
