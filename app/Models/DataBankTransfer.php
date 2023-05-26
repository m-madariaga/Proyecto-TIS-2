<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBankTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'run',
        'email',
        'bank',
        'account_type',
        'account_number',
        'paymentmethod_fk',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethod_fk');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $transferenciaBancaria = PaymentMethod::where('name', 'Transferencia Bancaria')->first();
            $model->paymentmethod_fk = $transferenciaBancaria->id;
        });
    }
}
