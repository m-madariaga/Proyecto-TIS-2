<?php

namespace App\Http\Controllers;

use App\Models\Frequent_question;
use Illuminate\Http\Request;

class FrequentQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frequent_questions = Frequent_question::all();
        return view('question.index', compact('frequent_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
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
            'pregunta' => 'required'
        ]);

        $frequent_question = new Frequent_question();
        $frequent_question->pregunta = $request->pregunta;
        $frequent_question->save();

        return redirect()->route('preguntas')->with('success', 'Pregunta ingresada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frequent_question  $frequent_question
     * @return \Illuminate\Http\Response
     */
    public function show(Frequent_question $frequent_question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frequent_question  $frequent_question
     * @return \Illuminate\Http\Response
     */
    public function edit(Frequent_question $id)
    {
        $preguntas = Frequent_question::all();
        $pregunta = $preguntas->find($id);
        return view('question.edit',compact('pregunta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frequent_question  $frequent_question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frequent_question $id)
    {
        $request->validate([
            'pregunta' => 'required',
        ]);
        $preguntas = Frequent_question::all();
        $pregunta = $preguntas->find($id);
        $pregunta->pregunta = $request->pregunta;
        $pregunta->save();

        return redirect()->route('preguntas')->with('success', 'Pregunta actualizada correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frequent_question  $frequent_question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frequent_question $id)
    {
        $preguntas = Frequent_question::all();
        $pregunta = $preguntas->find($id);
        $pregunta->delete();
        return redirect()->route('preguntas')->with('success', 'Pregunta borrada correctamente.');
    }
}
