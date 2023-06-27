<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipment_status extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_estado', 
        'shipment_fk'
    ];
}
