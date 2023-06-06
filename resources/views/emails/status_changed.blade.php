@component('mail::message')
# Introduction

Hola {{ $name }},

El estado de su orden {{$id}} ha cambiado.

 Ahora se encuentra en estado {{$status}}.



<br>
QG
@endcomponent
