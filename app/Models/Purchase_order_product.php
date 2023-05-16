<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_order_product extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'products_id',
        'cantidad',
        'precio',
    ];
    
}
