@extends('layouts.argon.app')

@section('title', 'Editar Método de Pago')

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{ route('paymentmethod.index') }}">Métodos
                de Pago</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar Método de Pago</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Editar Método de Pago</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                        <h6 class="float-start">Editar Método de Pago</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('paymethods.update', $paymentMethod->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $paymentMethod->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="visible">Visible:</label>
                                <select class="form-select" id="visible" name="visible">
                                    <option value="1" {{ $paymentMethod->visible == 1 ? 'selected' : '' }}>Mostrar
                                    </option>
                                    <option value="0" {{ $paymentMethod->visible == 0 ? 'selected' : '' }}>No mostrar
                                    </option>
                                </select>
                            </div>
                            @if (strtolower($paymentMethod->name) === 'transferencia bancaria')
                                <div class="form-group">
                                    <label for="accounts">Cuentas bancarias:</label>
                                    @foreach ($paymentMethod->dataBankTransfers as $dataBankTransfer)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="selected_account"
                                                id="account{{ $dataBankTransfer->id }}" value="{{ $dataBankTransfer->id }}"
                                                {{ $dataBankTransfer->id == $selectedAccountId ? 'checked' : '' }}>
                                            <label class="form-check-label" for="account{{ $dataBankTransfer->id }}"
                                                onclick="selectAccount('{{ $dataBankTransfer->id }}')">
                                                {{ $dataBankTransfer->name }} - {{ $dataBankTransfer->account_number }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function selectAccount(accountId) {
            document.getElementById('account' + accountId).checked = true;
        }
    </script>
@endsection
