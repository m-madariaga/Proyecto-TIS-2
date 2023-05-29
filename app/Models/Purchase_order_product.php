<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase_order_product extends Model
{
    use HasFactory;
    protected $table = 'purchase_order_products';

    protected $fillable = [
        'purchase_order_id',
        'products_id',
        'cantidad',
        'precio',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Purchase_order::class, 'purchase_order_id');
    }
}
