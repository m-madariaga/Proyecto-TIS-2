<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShipmentType;

class ShipmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipmentType::create([
            'nombre' => 'Starken'
        ]);
        ShipmentType::create([
            'nombre' => 'Retiro'
        ]);

        $this->command->info('ShipmentType Starken seeded successfully.');
    }
}
