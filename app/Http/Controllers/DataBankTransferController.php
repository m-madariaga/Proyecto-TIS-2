<?php

namespace App\Http\Controllers;

use App\Models\DataBankTransfer;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createdatabanktransfer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $databanktransfer->save();

        return redirect('admin/databanktransfer')->with('success', 'Dato Bancario creado exitosamente!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataBankTransfer  $dataBankTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(DataBankTransfer $dataBankTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataBankTransfer  $dataBankTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(DataBankTransfer $dataBankTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataBankTransfer  $dataBankTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataBankTransfer $dataBankTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataBankTransfer  $dataBankTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $databanktransfer = DataBankTransfer::find($id);
        $databanktransfer->delete();

        return redirect('admin/databanktransfer')->with('success', 'Dato Bancario eliminado exitosamente!');
    }
}