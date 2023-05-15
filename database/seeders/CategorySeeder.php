<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->nombre = 'Blusa';
        $category->descripcion = 'vestimenta de tipo blusa para mujer';
        $category->save();
        
        $category = new Category();
        $category->nombre = 'Pantalon';
        $category->descripcion = 'vestimenta de tipo pantalon para mujer';
        $category->save();

        $category = new Category();
        $category->nombre = 'Chaleco';
        $category->descripcion = 'vestimenta de tipo chaleco para mujer';
        $category->save();

        $category = new Category();
        $category->nombre = 'Chaqueta';
        $category->descripcion = 'vestimenta de tipo chaqueta para mujer';
        $category->save();

    }
}
