<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
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
        $socialnetwork = new SocialNetwork([
            'nombre' => $request->get('nombre'),
            'valor' => $request->get('valor'),
        ]);
        $socialnetwork->save();
        return redirect()->route('section.index')->with('success', 'Sección ingresada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function show(SocialNetwork $socialNetwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $socialnetwork = SocialNetwork::find($id);
        return view('section.edit', compact('socialnetwork'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'valor' => 'required',
            'visible' => 'required|in:0,1', // Solo permite valores 0 o 1
        ]);
    
        $socialnetwork = SocialNetwork::find($id);
    
        if ($socialnetwork) {
            $socialnetwork->nombre = $request->nombre;
            $socialnetwork->valor = $request->valor;
            $socialnetwork->visible = $request->visible; // Actualiza el campo visible con el valor seleccionado
    
            $socialnetwork->save();
    
            return redirect()->route('section.index')->with('success', 'Redes Sociales actualizadas correctamente');
        }
    
        return redirect()->route('section.index')->with('error', 'No se encontraron redes sociales.');
    }
    

    public function destroy($id)
    {
        $socialnetwork = SocialNetwork::find($id);

        if ($socialnetwork) {
            $socialnetwork->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No se encontró el registro']);
    }

}
 
