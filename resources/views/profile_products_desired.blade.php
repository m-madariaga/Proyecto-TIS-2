@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/cart_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('.show-picture-modal').on('click', function() {
                var imgUrl = $(this).data('img-url');
                $('#pictureModalImage').attr('src', imgUrl);
                $('#pictureModal').modal('show');
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="cart-items mt-4">
                    <h4 class="text-dark pb-2">Lista de productos deseados</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre Producto</th>
                                <th>Marca</th>
                                <th>Imagen Referencial</th>
                                <th>Precio</th>
                                <th>Stock disponible</th>
                                <th>Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos_deseados as $index => $item)
                                @if (!is_null($item))
                                    <tr>
                                        <td class="align-middle"><a href="#" class="show-picture-modal"
                                                data-img-url="/assets/images/images-products/{{ $item->product->imagen }}">{{ $item->product->nombre }}</a>
                                        </td>
                                        <td class="align-middle">{{ $item->product->marca->nombre }}</td>
                                        <td>
                                            <a href="#" class="show-picture-modal"
                                                data-img-url="/assets/images/images-products/{{ $item->product->imagen }}"
                                                style="color:black;">
                                                <img src="/assets/images/images-products/{{ $item->product->imagen }}"
                                                    alt="" width="70">
                                            </a>
                                        </td>
                                        <td class="align-middle">$ {{ $item->product->precio }}</td>
                                        <td class="align-middle">
                                            <h6>{{ $item->product->stock }}<h6>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('like-product') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <button class="btn btn-danger bg-transparent" type="submit">
                                                    <i class="far fa-times-circle  fa-2x"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                    </table>
                    @if (count(Auth::user()->product_desired)<=0)
                        <p class="pt-2">No hay productos deseados agregados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Imagen-->
    <div class="modal fade" id="pictureModal" tabindex="-1" aria-labelledby="pictureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pictureModalLabel">Imagen Referencial</h5>
                    <button type="submit" class="btn btn-link" data-bs-dismiss="modal" aria-label="Close" style=""><i
                            class="far fa-times-circle"></i></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="pictureModalImage" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
@endsection
