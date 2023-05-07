<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'categoria_id',
        'nombre',
        'precio',
        'color',
        'talla',
        'stock',
        'imagen',
    ];

    public function marca(): BelongsTo{
        return $this->belongsTo(Marca_producto::class,'marca_id');
    }
    public function categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class,'categoria_id');
    }
}
