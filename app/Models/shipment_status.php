<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipment_status extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_estado', 
        'shipment_type_fk'
    ];
    public function shipment_type()
    {
        return $this->belongsTo(ShipmentType::class,'shipment_type_fk');
    }
}
