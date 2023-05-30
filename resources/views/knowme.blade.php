@extends('layouts-landing.welcome')

@section('css')
    <style>
        .rounded-image {
            border-radius: 20%;
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.25);
            max-height: 25rem;
            width: auto;
        }

        #custom-center {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .custom-paragraph {
            max-width: 100%;
            font-style: italic;
            animation: fade-in 4s ease-in-out;

        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
@endsection



@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="new_arrivals">
            <div class="container">
                <div class="row mb-4">
                    <div class="col text-center">
                        <div class="section_title new_arrivals_title mb-4">
                            <h1>Conócenos</h1>
                        </div>
                    </div>
                </div>

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-5 mt-3">
                            <div class="card card-knowme">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/images-knowme/foto_principal.jpg') }}"
                                        class="rounded-image" alt="foto1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 mt-4" id="custom-center">
                            <div class="card card-knowme">
                                <div class="card-body custom-center">
                                    <p class="custom-paragraph">" Mi nombre es Francisca Arias, Soy estudiante de enfermería
                                        además de ser la creadora de la tienda Que Guay! ..."</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 mt-4" id="custom-center">
                            <div class="card card-knowme">
                                <div class="card-body">
                                    <p class="custom-paragraph">" ...En un principio comencé con la idea de vender Chaquetas
                                        customizadas ya que el arte y la moda son cosas que siempre llamaron mi atención y
                                        el tener la oportunidad de identificarme y plasmar las ideas de los demás en sus
                                        prendas me resultaba muy inspirador... "</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mt-3">
                            <div class="card card-knowme">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/images-knowme/foto1.jpeg') }}" class="rounded-image"
                                        alt="foto1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mt-3">
                            <div class="card card-knowme">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/images-knowme/foto2.jpeg') }}" class="rounded-image"
                                        alt="foto1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 mt-4" id="custom-center">
                            <div class="card card-knowme">
                                <div class="card-body">
                                    <p class="custom-paragraph">" ...Y esa misma emoción fue la que dio este nombre a la
                                        tienda,
                                        ya que "Que Guay!" es una expresión española que se usa para cuando algo es bueno o
                                        bonito, además de ser una expresión muy alegre y llamativa... "</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 mt-4" id="custom-center">
                            <div class="card card-knowme">
                                <div class="card-body">
                                    <p class="custom-paragraph">" ...Solo fue cosa de tiempo y sin darme cuenta ya contaba
                                        con
                                        mucha más variedad y demanda de la que creí llegar a tener y fue entonces cuando
                                        comencé a expandir la tienda, ya no eran solo chaquetas customizadas, era todo un
                                        closet femenino, ropa masculina y una amplia variedad de accesorios, expandí aún más
                                        los límites llegando a contar con distintos distribuidores dentro y fuera del país."
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mt-3">
                            <div class="card card-knowme">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/images-knowme/inicio.jpeg') }}" class="rounded-image"
                                        alt="foto1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4" id="custom-center">
                            <div class="card card-knowme">
                                <div class="card-body">
                                    <p class="custom-paragraph">" Tengo en cuenta que Que Guay puede parecer una pyme
                                        pequeña
                                        en comparación con otras de su tipo, pero este proyecto comenzó con toda la ilusión
                                        de tener una vista y enfoque más humano, dirijo a entregar identidad y libertad a
                                        mis clientes. "</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
