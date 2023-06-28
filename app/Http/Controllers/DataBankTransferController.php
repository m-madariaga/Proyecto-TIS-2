<?php

namespace App\Http\Controllers;

use App\Models\DataBankTransfer;
use Illuminate\Http\Request;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class DataBankTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $databanktransfers = DataBankTransfer::all();
        return view('databanktransfer', compact('databanktransfers'));
    }

    public function create()
    {
        return view('createdatabanktransfer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'run' => 'required',
            'email' => 'required',
            'bank' => 'required',
            'account_type' => 'required',
            'account_number' => 'required',
        ]);

        $databanktransfer = new DataBankTransfer;
        $databanktransfer->name = $request->name;
        $databanktransfer->run = $request->run;
        $databanktransfer->email = $request->email;
        $databanktransfer->bank = $request->bank;
        $databanktransfer->account_type = $request->account_type;
        $databanktransfer->account_number = $request->account_number;
        $databanktransfer->selected = 0; // Dejar seleccionado como 0 por defecto
        $databanktransfer->save();

        $action = new Action();
        $action->name = 'Creación Datos Transferencia';
        $action->user_fk = Auth::user()->id;
        $action->save();

        return redirect('admin/databanktransfer')->with('success', 'Dato Bancario creado exitosamente!');
    }

    public function edit($id)
    {
        $databanktransfer = DataBankTransfer::find($id);

        if (!$databanktransfer) {
            return redirect()->back()->with('error', 'Datos de transferencia bancaria no encontrados');
        }

        return view('editdatabanktransfer', compact('databanktransfer'));
    }

    public function update(Request $request, DataBankTransfer $id)
    {
        $request->validate([
            'name' => 'required',
            'run' => 'required',
            'email' => 'required',
            'bank' => 'required',
            'account_type' => 'required',
            'account_number' => 'required',
        ]);
        $databanktransfers = DataBankTransfer::all();
        $databanktransfer = $databanktransfers->find($id);
        $databanktransfer->name = $request->name;
        $databanktransfer->run = $request->run;
        $databanktransfer->email = $request->email;
        $databanktransfer->bank = $request->bank;
        $databanktransfer->account_type = $request->account_type;
        $databanktransfer->account_number = $request->account_number;
        $databanktransfer->save();

        return redirect('admin/databanktransfer')->with('success', 'Dato Bancario actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $databanktransfer = DataBankTransfer::find($id);
        $databanktransfer->delete();

        $action = new Action();
        $action->name = 'Eliminación Datos Transferencia';
        $action->user_fk = Auth::user()->id;
        $action->save();

        return redirect('admin/databanktransfer')->with('success', 'Dato Bancario eliminado exitosamente!');
    }
}