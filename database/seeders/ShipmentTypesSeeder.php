<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\shipment_type;

class ShipmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        shipment_type::create([
            'nombre' => 'Starken'
        ]);

        $this->command->info('ShipmentType Starken seeded successfully.');
    }
}
