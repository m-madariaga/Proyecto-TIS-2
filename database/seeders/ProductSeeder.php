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
        $product->talla = 'L';
        $product->stock = '4';
        $product->imagen = 'pantalon-seattle.jpeg';
        $product->visible = 1;
        $product->marca_id = '1';
        $product->categoria_id = '2';
        $product->save();

        $product = new Product();
        $product->nombre = 'Beatle Paris';
        $product->precio = '22990';
        $product->color = 'Negro';
        $product->talla = 'M';
        $product->stock = '4';
        $product->imagen = 'beatle-paris.jpeg';
        $product->visible = 1;
        $product->marca_id = '1';
        $product->categoria_id = '3';
        $product->save();

        $product = new Product();
        $product->nombre = 'Blusa Brasilia';
        $product->precio = '22990';
        $product->color = 'Beige';
        $product->talla = 'S';
        $product->stock = '4';
        $product->imagen = 'blusa-brasilia.jpeg';
        $product->visible = 1;
        $product->marca_id = '1';
        $product->categoria_id = '1';
        $product->save();

        $product = new Product();
        $product->nombre = 'Chaleco Cairo';
        $product->precio = '12990';
        $product->color = 'Fucsia';
        $product->talla = 'M';
        $product->stock = '5';
        $product->imagen = 'chaleco-cairo.jpeg';
        $product->visible = 1;
        $product->marca_id = '2';
        $product->categoria_id = '3';
        $product->save();

        $product = new Product();
        $product->nombre = 'Chaleco Toronto';
        $product->precio = '12990';
        $product->color = 'Negro';
        $product->talla = 'M';
        $product->stock = '2';
        $product->imagen = 'chaleco-toronto.jpeg';
        $product->visible = 1;
        $product->marca_id = '2';
        $product->categoria_id = '3';
        $product->save();

        $product = new Product();
        $product->nombre = 'Chaleco Venecia';
        $product->precio = '19990';
        $product->color = 'Beige';
        $product->talla = 'M';
        $product->stock = '4';
        $product->imagen = 'chaleco-venecia.jpeg';
        $product->visible = 1;
        $product->marca_id = '2';
        $product->categoria_id = '3';
        $product->save();
        
        $product = new Product();
        $product->nombre = 'Chaqueta Milán';
        $product->precio = '54990';
        $product->color = 'Azul';
        $product->talla = 'M';
        $product->stock = '3';
        $product->imagen = 'chaqueta-milan.jpeg';
        $product->visible = 1;
        $product->marca_id = '3';
        $product->categoria_id = '4';
        $product->save();
    }
}
