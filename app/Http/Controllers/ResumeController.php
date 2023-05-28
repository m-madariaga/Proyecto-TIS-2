<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;


use App\Models\User;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('resume');
    }

    public function showResume(Request $request)
    {
        $paymentMethodId = $request->input('paymentMethodId');
        $paymentMethod = PaymentMethod::findOrFail($paymentMethodId);

        // Aquí también necesitarás obtener los detalles de la orden o carrito de compras

        return view('resume', compact('paymentMethod'));
    }

    


    public function orderConfirmation()
    {
        return view('order_confirmation');
    }
}
