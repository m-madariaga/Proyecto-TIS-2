<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteTransfer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ComprobanteTransferController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lógica para mostrar todos los recursos
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación
    }

    public function store(Request $request)
    {
        // Lógica para guardar un nuevo recurso
    }

    public function show($id)
    {
        // Lógica para mostrar un recurso específico
    }

    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un recurso específico
    }

    public function destroy($id)
    {
        // Lógica para eliminar un recurso específico
    }
}
