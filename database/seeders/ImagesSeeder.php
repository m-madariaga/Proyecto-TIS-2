<?php

namespace Database\Seeders;

use App\Models\Images;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = new Images();
        $images->nombre_imagen = 'Logo1';
        $images->direccion_imagen = 'imagen_logo/logo_1.png';
        $images->seleccionada = '1';
        $images->tipo_imagen = 'logo_principal';
        $images->save();

        $images = new Images();
        $images->nombre_imagen = 'Logo2';
        $images->direccion_imagen = 'imagen_footer/logo_2.png';
        $images->seleccionada = '1';
        $images->tipo_imagen = 'logo_footer';
        $images->save();
    }
}
