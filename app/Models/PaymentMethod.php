<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen'];

    // public function getImagenUrlAttribute()
    // {
    //     if ($this->imagen) {
    //         return asset('storage/' . $this->imagen);
    //     }
        
    //     return asset('images/default-payment-method.png');
    // }
}