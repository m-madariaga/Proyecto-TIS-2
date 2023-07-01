<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobanteTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'direccion_comprobante',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
