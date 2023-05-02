<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function get_marca(){
        return $this->belongsTo(Marca_producto::class);
    }
}
