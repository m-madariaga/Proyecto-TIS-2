<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Marca_producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    public function products()
    {
        return $this->hasMany(Producto::class, 'marca_id');
    }
}
