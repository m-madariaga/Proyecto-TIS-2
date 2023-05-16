<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Region;
use App\Models\Country;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $country = Country::where('name', 'Chile')->first();

        if ($country) {
            $regionsData = [
                [
                    'name' => 'Arica y Parinacota',
                    'cities' => [
                        'Arica',
                        'Putre',
                    ],
                ],
                [
                    'name' => 'Tarapacá',
                    'cities' => [
                        'Iquique',
                        'Pozo Almonte',
                    ],
                ],
                [
                    'name' => 'Antofagasta',
                    'cities' => [
                        'Antofagasta',
                        'Calama',
                        'Tocopilla',
                        'Mejillones',
                        'San Pedro de Atacama',
                    ],
                ],
                [
                    'name' => 'Atacama',
                    'cities' => [
                        'Copiapó',
                        'Vallenar',
                        'Chañaral',
                        'Caldera',
                        'Huasco',
                    ],
                ],
                [
                    'name' => 'Coquimbo',
                    'cities' => [
                        'La Serena',
                        'Coquimbo',
                        'Illapel',
                        'Ovalle',
                        'Salamanca',
                    ],
                ],
                [
                    'name' => 'Valparaíso',
                    'cities' => [
                        'Valparaíso',
                        'Viña del Mar',
                        'Quillota',
                        'San Antonio',
                        'Los Andes',
                    ],
                ],
                [
                    'name' => 'Metropolitana de Santiago',
                    'cities' => [
                        'Santiago',
                        'Puente Alto',
                        'Maipú',
                        'La Florida',
                        'Las Condes',
                    ],
                ],
                [
                    'name' => 'Libertador General Bernardo O\'Higgins',
                    'cities' => [
                        'Rancagua',
                        'Rengo',
                        'Machalí',
                        'San Fernando',
                        'Santa Cruz',
                    ],
                ],
                [
                    'name' => 'Maule',
                    'cities' => [
                        'Talca',
                        'Curicó',
                        'Linares',
                        'Constitución',
                        'Cauquenes',
                    ],
                ],
                [
                    'name' => 'Ñuble',
                    'cities' => [
                        'Chillán',
                        'Bulnes',
                        'Yungay',
                        'San Carlos',
                        'Quirihue',
                    ],
                ],
                [
                    'name' => 'Biobío',
                    'cities' => [
                        'Concepción',
                        'Chillán Viejo',
                        'Los Ángeles',
                        'Coronel',
                        'Talcahuano',
                    ],
                ],
                [
                    'name' => 'La Araucanía',
                    'cities' => [
                        'Temuco',
                        'Padre las Casas',
                        'Angol',
                        'Victoria',
                        'Villarrica',
                    ],
                ],
                ['name' => 'Los Ríos',
                    'cities' => [
                        'Valdivia',
                        'La Unión',
                        'Paillaco',
                        'Panguipulli',
                    ],
                ],
                [
                    'name' => 'Los Lagos',
                    'cities' => [
                        'Puerto Montt',
                        'Osorno',
                        'Puerto Varas',
                        'Castro',
                        'Ancud',
                    ],
                ],
                [
                    'name' => 'Aysén del General Carlos Ibáñez del Campo',
                    'cities' => [
                        'Coyhaique',
                        'Puerto Aysén',
                        'Chile Chico',
                        'Cochrane',
                        'Puerto Cisnes',
                    ],
                ],
                [
                    'name' => 'Magallanes y de la Antártica Chilena',
                    'cities' => [
                        'Punta Arenas',
                        'Puerto Natales',
                        'Porvenir',
                        'Cabo de Hornos',
                        'Puerto Williams',
                    ],
                ],
            ];

            foreach ($regionsData as $regionData) {
                $region = Region::where('name', $regionData['name'])->first();

                if ($region) {
                    foreach ($regionData['cities'] as $cityName) {
                        City::create([
                            'name' => $cityName,
                            'region_fk' => $region->id,
                            'country_fk' => $country->id,
                        ]);
                    }
                }
            }

            $this->command->info('Cities seeded successfully.');
        } else {
            $this->command->error('Country "Chile" not found.');
        }
    }
}
