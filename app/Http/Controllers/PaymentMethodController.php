<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('paymentmethod_landing', compact('paymentMethods'));
    }

    public function index_admin()
    {
        $paymentMethods = PaymentMethod::all();
        return view('paymentmethods', compact('paymentMethods'));
    }

    public function create()
    {
        return view('createpaymethod');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('argon/assets/img/images-paymethods'), $imageName);

        $paymentMethod = new PaymentMethod;
        $paymentMethod->name = $request->name;
        $paymentMethod->imagen = $imageName;
        $paymentMethod->save();

        return redirect()->route('paymentmethod.index_admin')->with('success', 'Método de pago creado exitosamente!');
    }

    public function store_landing(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $paymentMethod = new PaymentMethod;
        $paymentMethod->name = $request->name;
        $paymentMethod->save();

        return redirect()->route('paymentmethod.index')->with('success', 'Método de pago creado exitosamente!');
    }

    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return redirect()->route('paymentmethod.index_admin')->with('error', 'No se encontró el método de pago.');
        }

        $selectedAccountId = $paymentMethod->$id; // Aquí asigna el ID de la cuenta bancaria seleccionada

        return view('editpaymethod', compact('paymentMethod', 'selectedAccountId'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'visible' => 'required',
        ]);

        $paymentMethod = PaymentMethod::find($id);

        if ($paymentMethod) {
            $paymentMethod->visible = $request->input('visible');
            $paymentMethod->save();

            return redirect()->route('paymentmethod.index_admin')->with('success', 'Método de pago actualizado exitosamente!');
        }

        return redirect()->route('paymentmethod.index_admin')->with('error', 'No se encontró el método de pago.');
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return redirect()->route('paymentmethod.index_admin')->with('error', 'No se encontró el método de pago.');
        }

        $paymentMethod->delete();

        return response()->json(['success' => true]);
    }
}
