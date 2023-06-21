<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebpayCredential extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commerce_code',
        'api_key',
        'integration_type',
        'environment',
        'paymentmethod_fk',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethod_fk');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $webpay = PaymentMethod::where('name', 'WebPay')->first();
            $model->paymentmethod_fk = $webpay->id;
        });
    }
}
