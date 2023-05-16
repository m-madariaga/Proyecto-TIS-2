<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->codigo = 'ASDF123456';
        $order->subtotal = '19771';
        $order->impuesto = '3219';
        $order->total = '22990';
        $order->user_id = '4';
        $order->save();
        $this->command->info('Order seeded successfully.');
    }
}
