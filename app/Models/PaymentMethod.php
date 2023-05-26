<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen','visible'];

    public function dataBankTransfers()
    {
        return $this->hasMany(DataBankTransfer::class, 'paymentmethod_fk');
    }
}
