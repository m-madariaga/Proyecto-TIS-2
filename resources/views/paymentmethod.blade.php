@extends('layouts-landing.welcome')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="payment-method-section">
        <h2>Método de Pago</h2>
        
        @if(Auth::check())
            <p>Seleccione un método de pago:</p>
            
            <ul>
                <li>Transferencia bancaria</li>
                <li>Efectivo</li>
                <li>Método Webpay</li>
            </ul>
            
            <button onclick="proceedToCheckout()">Proceder con la compra</button>
        @else
            <p>Debes iniciar sesión para proceder con la compra.</p>
            <a href="/login">Iniciar sesión</a>
        @endif
    </div>
    
    <script>
        function proceedToCheckout() {
            // Aquí puedes agregar la lógica para procesar la compra
            // después de seleccionar el método de pago deseado.
            // Por ejemplo, podrías enviar los datos al servidor o
            // redirigir al usuario a una página de confirmación.
        }
    </script>
@endsection