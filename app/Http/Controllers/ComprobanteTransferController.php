<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ComprobanteTransferController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $comprobante = new ComprobanteTransfer();
            $order = json_decode($request->input('order'));

            // Obtener el ID del pedido desde la URL o como lo hayas pasado

            if ($file = $request->file('pdf_file')) {
                $rutaGuardar = 'comprobantes_transferencia/'; // Especifica la carpeta donde se guardarán los archivos
                $nombreArchivo = date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move($rutaGuardar, $nombreArchivo);
                $comprobante->order_id = $order->id; // Guarda el nombre del archivo en la propiedad nombre_archivo
                $comprobante->direccion_comprobante = $rutaGuardar . $nombreArchivo; // Guarda la ruta en el modelo

                // Si el archivo es una imagen, redimensionarla
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $resizedImage = Image::make(public_path($rutaGuardar . $nombreArchivo))->resize(null, 204.5, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $resizedImage->save();
                }

                // Asignar el ID del pedido al comprobante
            
                $comprobante->save();

                return redirect()->route('checkout_transfer')->with('success', 'Comprobante de transferencia ingresado correctamente.');
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComprobanteTransfer  $comprobanteTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComprobanteTransfer $comprobanteTransfer)
    {

    }
}
