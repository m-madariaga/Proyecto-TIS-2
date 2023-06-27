<?php

namespace App\Http\Controllers;

use App\Models\Document_transfer;
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
        //
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
    public function show(Document_transfer $document_transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document_transfer  $document_transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Document_transfer $document_transfer)
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
    public function update(Request $request, Document_transfer $document_transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document_transfer  $document_transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document_transfer $document_transfer)
    {
        //
    }
    public function cargarArchivo(Request $request)
    {
        $validatedData = $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048', // Valida que se seleccione un archivo PDF de hasta 2MB
            'numero_pedido' => 'required',
        ]);
    
        // Guardar el archivo adjunto
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $path = Storage::disk('public')->putFile('document_transfer', $file);
    
            // Guardar la información en la base de datos
            $document_transfer = new Document_transfer();
            $document_transfer->numero_pedido = $request->numero_pedido;
            $document_transfer->ruta_archivo = $path;
            $document_transfer->save();
        }
    }
}
