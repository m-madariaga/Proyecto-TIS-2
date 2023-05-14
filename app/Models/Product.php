<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'color',
        'talla',
        'stock',
        'imagen',
        'visible',
        'marca_id',
        'categoria_id',
    ];

    public function marca(): BelongsTo{
        return $this->belongsTo(Brand::class,'marca_id');
    }
    public function categoria(): BelongsTo{
        return $this->belongsTo(Category::class,'categoria_id');
    }
}
