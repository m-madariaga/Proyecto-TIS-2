<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if ($product->stock < 0) {
                $product->stock = 0;
            }
        });
    }
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'marca_id');
    }
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }
    public function purchase_order(): HasMany {
        return $this->hasMany(Purchase_order_product::class, 'products_id');
    }
    public function product_desired(): HasMany
    {
        return $this->hasMany(Product_desired::class, 'product_id');
    }
    public function shipments()
    {
        return $this->belongsToMany(Shipment::class, 'shipment_product');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'producto_id', 'id');
    }
}
