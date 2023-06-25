<?php

namespace App\Http\Controllers;

use App\Models\Section;
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
        return view('section.index', compact('secciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('section.create');
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
    public function update(Request $request, Section $id)
    {
        $request->validate([
            'nombre' => 'required',
            'visible' => 'required',
        ]);
        $secciones = Section::all();
        
        if (!$secciones) {
            return redirect()->route('section.index')->with('error', 'No se encontró la Sección.');
        }
        $seccion = $secciones->find($id);
        $seccion->nombre = $request->nombre;
        $seccion->visible = $request->input('visible');

        $seccion->save();
        return redirect()->route('section.index', 'Sección actualizada correctamente');
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