@extends('layouts-landing.welcome')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">

@endsection

@section('content')
<div class="container-fluid py-4 mb-4 faq-container">
    <div class="new_arrivals">
        <div class="row">
            <div class="col text-center mb-4">
                <div class="section_title new_arrivals_title">
                    <h2>Preguntas frecuentes</h2>
                </div>
            </div>
        </div>

        <div class="card px-4">
            <div class="card-body px-4">

                <div class="row justify-content-center">
                    <div class="col-8 col-md-8">
                        <div class="accordion" id="accordionExample">
                            @foreach($questions as $question)
                            <div class="accordion-item">
                                <h2 class="accordion-header text-center" id="heading{{ $question->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $question->id }}" aria-expanded="false" aria-controls="collapse{{ $question->id }}">
                                        <strong>{{ $question->pregunta }}</strong>
                                    </button>
                                </h2>
                                <div id="collapse{{ $question->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $question->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach($question->response as $response)
                                        <div class="respuesta-container">
                                            {{ $response->respuesta }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    @endsection

    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    @endsection