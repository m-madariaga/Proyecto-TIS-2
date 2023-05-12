<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Country;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve the country Chile
        $country = Country::where('name', 'Chile')->first();

        if ($country) {
            // Define the regions for Chile
            $regions = [
                'Arica y Parinacota',
                'Tarapacá',
                'Antofagasta',
                'Atacama',
                'Coquimbo',
                'Valparaíso',
                'Metropolitana de Santiago',
                'Libertador General Bernardo O\'Higgins',
                'Maule',
                'Ñuble',
                'Biobío',
                'La Araucanía',
                'Los Ríos',
                'Los Lagos',
                'Aysén del General Carlos Ibáñez del Campo',
                'Magallanes y de la Antártica Chilena'
            ];

            // Create the regions for Chile
            foreach ($regions as $regionName) {
                Region::create([
                    'name' => $regionName,
                    'country_fk' => $country->id
                ]);
            }

            $this->command->info('Regions for Chile seeded successfully.');
        } else {
            $this->command->error('Country Chile not found. Please ensure the country exists in the countries table.');
        }
    }
}
