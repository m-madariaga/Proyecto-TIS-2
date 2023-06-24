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
        $paymentMethod = PaymentMethod::with([
            'dataBankTransfers' => function ($query) {
                $query->orderBy('selected', 'desc');
            }
        ])->find($id);

        if (!$paymentMethod) {
            return redirect()->route('paymentmethod.index_admin')->with('error', 'No se encontró el método de pago.');
        }

        $selectedAccountId = $paymentMethod->dataBankTransfers->first()->id ?? null;

        return view('editpaymethod', compact('paymentMethod', 'selectedAccountId'));
    }



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'visible' => 'required',
        ]);

        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return redirect()->route('paymentmethod.index_admin')->with('error', 'No se encontró el método de pago.');
        }

        $paymentMethod->visible = $request->input('visible');

        if (strtolower($paymentMethod->name) === 'transferencia bancaria') {
            $selectedAccountId = $request->input('selected_account');

            // Actualizar el atributo 'selected' de todas las cuentas bancarias asociadas a este método de pago
            $paymentMethod->dataBankTransfers()->update(['selected' => 0]);

            if ($selectedAccountId) {
                // Marcar la cuenta bancaria seleccionada como 'selected'
                $selectedAccount = $paymentMethod->dataBankTransfers()->find($selectedAccountId);
                if ($selectedAccount) {
                    $selectedAccount->selected = 1;
                    $selectedAccount->save();
                }
            }
        }

        $paymentMethod->save();

        return redirect()->route('paymentmethod.index_admin')->with('success', 'Método de pago actualizado exitosamente!');
    }




    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return redirect()->route('paymentmethod.index_admin')->with('error', 'No se encontró el método de pago.');
        }

        $paymentMethod->delete();

        return redirect()->route('paymentmethod.index_admin')->with('success', 'Método de pago eliminado exitosamente!');
    }


}