@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="assets/css/method_style.css">
@endsection

@section('content')
    <div class="container-fluid py-4" id="container-payment">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="payment-method-section">
                    <h2>Métodos de Envío</h2>

                    <div class="card-deck mb-4">
                        
                    </div>
                    
                    <form action="{{ route('paymentmethod') }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
 
@endsection
