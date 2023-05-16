<?php

namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = new Brand();
        $brand->nombre = 'Que Guay!';
        $brand->logo = 'queguay_logo.png';
        $brand->save();

        $brand = new Brand();
        $brand->nombre = 'Michael Kors';
        $brand->logo = 'michaelkors_logo.png';
        $brand->save();

        $brand = new Brand();
        $brand->nombre = 'IKKS';
        $brand->logo = 'ikks_logo.png';
        $brand->save();

        $brand = new Brand();
        $brand->nombre = 'Liu Jo';
        $brand->logo = 'liujo_logo.png';
        $brand->save();

        $brand = new Brand();
        $brand->nombre = 'Adolfo Dominguez';
        $brand->logo = 'adolfo_logo.png';
        $brand->save();

    }
}
