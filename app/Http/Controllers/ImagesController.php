<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        try {
            $imagen = new Images();
            $imagenUser = '';

            if ($image = $request->file('imagen')) {
                $rutaGuardarImg = 'imagen_logo/';
                $imagenUser = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move($rutaGuardarImg, $imagenUser);
                $imagen->nombre_imagen = $imagenUser; // Guardar el nombre de la imagen en la propiedad nombre_imagen
                $imagen->direccion_imagen = $rutaGuardarImg . $imagenUser; // Guardar la ruta en el modelo

                $resizedImage = Image::make(public_path($rutaGuardarImg . $imagenUser))->resize(null, 204.5, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                

                $resizedImage->save();

                $imagen->save();

                return redirect()->route('section.index')->with('success', 'Imagen ingresada correctamente.');
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function show(Images $images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function edit(Images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $selectedImages = $request->input('seleccion', []);

            // Reiniciar el atributo seleccionada a 0 para todas las imágenes
            Images::query()->update(['seleccionada' => false]);

            // Actualizar el atributo seleccionada a 1 para las imágenes seleccionadas
            Images::whereIn('id', $selectedImages)->update(['seleccionada' => true]);

            return redirect()->route('section.index')->with('success', 'Imágenes seleccionadas actualizadas correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('section.index')->with('error', 'Error al actualizar las imágenes seleccionadas: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function destroy(Images $images)
    {
        //
    }
}

