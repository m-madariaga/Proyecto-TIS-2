<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtotal',
        'impuesto',
        'total',
        // 'fecha_pedido',
        'estado',
        // 'user_id',
    ];

    public function users():BelongsTo 
    {
        return $this->belongsTo(User::class, 'id');
    }
  
}
