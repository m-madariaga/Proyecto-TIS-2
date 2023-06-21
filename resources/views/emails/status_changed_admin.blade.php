@component('mail::message')
# Introduction

Hola,

El estado de la orden {{$id}} del cliente {{$name}} ha cambiado.

 Ahora se encuentra en estado {{$status}}.

Detalles:

@foreach ($traceability as $status)

Fué declarado {{$status->nombre_estado}} en la fecha {{$status->created_at}}.
    
@endforeach

<br>
QG
@endcomponent
