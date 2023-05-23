<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'precio',
        'cantidad',
        'monto',  
        'producto_id',
        'pedido_id ',
    ];

    public function order(): BelongsTo 
    {
        return $this->belongsTo(Order::class, 'pedido_id');
    }
    
    public function product(): BelongsTo 
    {
        return $this->belongsTo(Product::class, 'producto_id');
    }
}
