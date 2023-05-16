<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
    ];

    public function product(): BelongsToMany {
        return $this->belongsToMany(Product::class,'purchase_order_products');
    }

}
