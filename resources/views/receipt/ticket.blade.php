<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <title>Comprobante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .logo {
            float: left;
        }

        .invoice-header {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }

        .invoice-header h1 {
            font-size: 2em;
            margin: 0 0 10px 0;
            text-align: center;
        }

        .invoice-header p {
            margin: 0;
            text-align: right;
        }

        .invoice-body {
            margin-bottom: 30px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th {
            background-color: #c92780;
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .invoice-total {
            float: right;
        }

        .invoice-total td:first-child {
            font-weight: bold;
            text-align: right;
            padding-right: 10px;
        }

        .invoice-footer {
            border-top: 1px solid #ccc;
            padding-top: 20px;
            margin-top: 40px;
        }

        .invoice-footer p {
            margin: 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
</head>

<body>
    <div class="container">
        <header class="invoice-header">
            <img class="logo img-fluid" src="..\public\assets\images\logo_2.png" alt="Logo de la empresa">
            <h1>Orden de Compra</h1>

            <p>N° de orden: {{$orden->id}}</p>
            <p>Fecha de orden: {{ $orden->created_at }}</p>


        </header>
        <section class="invoice-body">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $prod)
                        <tr>
                            <td>{{ $prod->product->nombre}} {{$prod->product->marca->nombre}}</td>
                            <td>{{$prod->cantidad}}</td>
                            <td>${{$prod->precio}}</td>
                            <td>${{$prod->cantidad * $prod->precio}}</td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr class="invoice-total">
                        <td colspan="3">Total:</td>
                        <td>${{$orden->total}}</td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <footer class="invoice-footer">
            <p>www.queguay.cl</p>
        </footer>
    </div>

</body>

</html>
