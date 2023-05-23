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
        $method -> imagen = '';
        $method -> save();

        $method = new PaymentMethod();
        $method -> name = 'Efectivo';
        $method -> imagen = '';
        $method -> save();

        $method = new PaymentMethod();
        $method -> name = 'WebPay';
        $method -> imagen = '';
        $method -> save();
    }
}
