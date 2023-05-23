<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase_order_product extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'products_id',
        'cantidad',
        'precio',
    ];

    public function purchase_order(): BelongsTo{
        return $this->belongsTo(Purchase_order::class,'id');
    }

    public function products(): BelongsTo{
        return $this->belongsTo(Product::class,'id');
    }
}
