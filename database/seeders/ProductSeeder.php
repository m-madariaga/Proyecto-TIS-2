<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->nombre = 'Pantalón Seattle';
        $product->precio = '22990';
        $product->color = 'Negro';
        $product->talla = '34';
        $product->stock = '4';
        $product->imagen = 'pantalon_seattle.png';
        $product->visible = 1;
        $product->marca_id = '1';
        $product->categoria_id = '2';
        $product->save();
    }
}
