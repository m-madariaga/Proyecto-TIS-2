<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipment_type extends Model
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
