<?php

namespace Database\Seeders;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PayMentMethods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $method = new PaymentMethod();
        $method -> name = 'Transferencia Bancaria';
        $method -> imagen = 'transferencia_bancaria.png';
        $method -> visible = 1;
        $method -> save();

        $method = new PaymentMethod();
        $method -> name = 'Efectivo';
        $method -> imagen = 'dinero.png';
        $method -> visible = 1;
        $method -> save();

        $method = new PaymentMethod();
        $method -> name = 'WebPay';
        $method -> imagen = 'webpay.png';
        $method -> visible = 1;
        $method -> save();

   
    }
}
