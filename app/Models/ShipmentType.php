<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function shipments()
    {
        return $this->hasMany(Shipment::class,'shipment_type_fk');
    }
}
