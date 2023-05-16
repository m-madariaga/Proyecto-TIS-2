@component('mail::message')
# Introduction

Hola {{ $name }},

El estado de su orden {{$id}} ha cambiado.

 Ahora se encuentra en estado {{$status}}.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
