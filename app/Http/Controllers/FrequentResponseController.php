<?php

namespace App\Http\Controllers;

use App\Models\Frequent_response;
use App\Models\Frequent_question;
use Illuminate\Http\Request;

class FrequentResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frequent_responses = Frequent_response::with('frequent_question')->get();
        return view('response.index', compact('frequent_responses'));
    }

    public function create()
    {
        $frequent_questions = Frequent_question::all();
        return view('response.create', compact('frequent_questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'respuesta' => 'required',
            'frequent_question_id' => 'required'
        ]);

        $frequent_response = new Frequent_response();
        $frequent_response->respuesta = $request->respuesta;
        $frequent_response->frequent_question_id = $request->frequent_question_id;
        $frequent_response->save();

        return redirect()->route('respuestas')->with('success', 'Respuesta ingresada correctamente.');
    }

    public function edit($id)
    {
        $frequent_response = Frequent_response::findOrFail($id);
        $frequent_questions = Frequent_question::all();
        return view('response.edit', compact('frequent_response', 'frequent_questions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required'
        ]);

        $frequent_response = Frequent_response::findOrFail($id);
        $frequent_response->respuesta = $request->respuesta;
        $frequent_response->save();

        return redirect()->route('respuestas')->with('success', 'Respuesta actualizada correctamente.');
    }
    public function destroy(Frequent_response $id)
    {
        $respuestas = Frequent_response::all();
        $respuesta = $respuestas->find($id);
        $respuesta->delete();
        return redirect()->route('respuestas')->with('success', 'Respuesta eliminada correctamente.');
    }
}
