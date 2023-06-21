<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_fk',
        'status',
        'shipment_type_fk',
        'products',

    ];
    protected $casts = [
        'products' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_fk');
    }

    public function shipment_type()
    {
        return $this->belongsTo(ShipmentType::class,'shipment_type_fk');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'shipment_products');
    }
}
