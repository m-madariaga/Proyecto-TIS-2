<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteTransfer;
use Illuminate\Http\Request;

class DocumentTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = ComprobanteTransfer::all();
        return view('documenttransfers.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document_transfer  $document_transfer
     * @return \Illuminate\Http\Response
     */
    public function show(ComprobanteTransfer $document_transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document_transfer  $document_transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(ComprobanteTransfer $document_transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document_transfer  $document_transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComprobanteTransfer $document_transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document_transfer  $document_transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComprobanteTransfer $document_transfer)
    {
        //
    }
}
