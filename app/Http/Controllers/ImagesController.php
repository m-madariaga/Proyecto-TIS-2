<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    // ...

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

            if ($image = $request->file('imagen_principal')) {
                $rutaGuardarImg = 'imagen_logo/';
                $imagenUser = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move($rutaGuardarImg, $imagenUser);
                $imagen->nombre_imagen = $imagenUser;
                $imagen->direccion_imagen = $rutaGuardarImg . $imagenUser;

                // Guardar el tipo de imagen
                $imagen->tipo_imagen = $request->input('tipo_imagen_principal', '');

                $resizedImage = Image::make(public_path($rutaGuardarImg . $imagenUser))->resize(null, 204.5, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $resizedImage->save();

                $imagen->save();

                return redirect()->route('section.index')->with('success', 'Imagen del Logo Principal ingresada correctamente.');
            } elseif ($image = $request->file('imagen_footer')) {
                $rutaGuardarImg = 'imagen_logo/';
                $imagenUser = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move($rutaGuardarImg, $imagenUser);
                $imagen->nombre_imagen = $imagenUser;
                $imagen->direccion_imagen = $rutaGuardarImg . $imagenUser;

                // Guardar el tipo de imagen
                $imagen->tipo_imagen = $request->input('tipo_imagen_footer', '');

                $resizedImage = Image::make(public_path($rutaGuardarImg . $imagenUser))->resize(null, 204.5, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $resizedImage->save();

                $imagen->save();

                return redirect()->route('section.index')->with('success', 'Imagen del Footer ingresada correctamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
        }
    }

    // ...

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
            $selectedImagesPrincipal = $request->input('seleccion_principal', []);
            $selectedImagesFooter = $request->input('seleccion_footer', []);

            // Reiniciar el atributo seleccionada a 0 para todas las imágenes del logo principal
            if (!empty($selectedImagesPrincipal)) {
                Images::where('tipo_imagen', 'logo_principal')->update(['seleccionada' => false]);
            }

            // Reiniciar el atributo seleccionada a 0 para todas las imágenes del logo del footer
            if (!empty($selectedImagesFooter)) {
                Images::where('tipo_imagen', 'logo_footer')->update(['seleccionada' => false]);
            }

            // Actualizar el atributo seleccionada a 1 para las imágenes seleccionadas del logo principal
            Images::whereIn('id', $selectedImagesPrincipal)->update(['seleccionada' => true]);

            // Actualizar el atributo seleccionada a 1 para las imágenes seleccionadas del logo del footer
            Images::whereIn('id', $selectedImagesFooter)->update(['seleccionada' => true]);

            return redirect()->route('section.index')->with('success', 'Las imágenes seleccionadas han sido actualizadas correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('section.index')->with('error', 'Error al actualizar las imágenes: ' . $e->getMessage());
        }
    }
}