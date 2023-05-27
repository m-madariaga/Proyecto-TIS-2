<!DOCTYPE html>
<html>

<head>
    <title>Página de Pago</title>
    <link rel="stylesheet" href="assets/css/method_style.css">
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
            
            margin: 0;
            padding: 0;        }

        .container-fluid {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            margin-bottom: 0;
        }

        .section-lienzo {
            text-align: center;
            height: 50vh;
            /* Establecemos la altura al 50% de la ventana */
            width: 100%;
            background-image: url('/assets/images/lienzo.png');
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: -5%;
        }

        .lienzo-img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="section-lienzo">
        <div class="col-md-12" style="padding: 0;">
        </div>
    </div>
    <div class="container-fluid py-4" id="container-payment">




        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <h2>Resumen del Pedido</h2>

                <div class="card-deck mb-4">
                    <!-- Iterar sobre los productos -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Producto 1</h5>
                            <p class="card-text">Precio: $10.00</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Producto 2</h5>
                            <p class="card-text">Precio: $15.00</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <h2>Métodos de Pago</h2>

                <div class="card-deck mb-4">
                    <!-- Agregar los medios de pago -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tarjeta de Crédito</h5>
                            <p class="card-text">Número de tarjeta: 1234 **** **** 5678</p>
                            <p class="card-text">Fecha de expiración: 12/25</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Otro Método de Pago</h5>
                            <p class="card-text">Detalles del método de pago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="ruta-del-archivo-js"></script>
</body>

</html>
