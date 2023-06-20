<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen','visible'];

    

    // FUNCIONES QUE DEVUELVEN LOS DATOS GUARDADOS 
    public function dataBankTransfers(): HasMany
    {
        return $this->hasMany(DataBankTransfer::class, 'paymentmethod_fk');
    }

    public function webPayCredential(): HasMany
    {
        return $this->hasMany(WebpayCredential::class, 'paymentmethod_fk');
    }
    
    public function Order(): HasMany
    {
        return $this->hasMany(Order::class, 'metodo_pago_id');
    }
}
