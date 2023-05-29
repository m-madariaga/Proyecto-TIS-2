<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Purchase_order extends Model
{
    use HasFactory;

    protected $fillable = ['total'];

    public function product(): HasMany
    {
        return $this->hasMany(Purchase_order_product::class, 'purchase_order_id');
    }
}
