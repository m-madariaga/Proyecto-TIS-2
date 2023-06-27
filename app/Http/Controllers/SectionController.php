<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Section;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secciones = Section::all();
        $images = Images::all();
        $redesSociales = SocialNetwork::all();
        return view('section.index', compact('secciones', 'redesSociales','images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'nombre' => 'required',
        ]);
        $seccion = new Section([
            'nombre' => $request->get('nombre'),
        ]);
        $seccion->save();
        return redirect()->route('section.index')->with('success', 'Sección ingresada correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $id)
    {
        $secciones = Section::all();
        $seccion = $secciones->find($id);
        return view('section.edit', compact('seccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'visible' => 'required|array',
        ]);

        $visibleValues = $request->input('visible');
        $secciones = Section::all();

        if (!$secciones->isEmpty()) {
            foreach ($secciones as $key => $seccion) {
                $seccion->visible = $visibleValues[$key];
                $seccion->save();
            }

            return redirect()->route('section.index')->with('success', 'Secciones actualizadas correctamente');
        }

        return redirect()->route('section.index')->with('error', 'No se encontraron secciones.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $id)
    {
        $secciones = Section::all();
        $seccion = $secciones->find($id);
        $seccion->delete();
        return response()->json(['success' => true]);
    }
}
