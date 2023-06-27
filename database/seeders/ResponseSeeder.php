<?php

namespace Database\Seeders;

use App\Models\Frequent_response;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = new Frequent_response();
        $response->respuesta = 'Sí, Enviamos a todo Chile Continental.';
        $response->frequent_question_id = '1';
        $response->save();

        $response = new Frequent_response();
        $response->respuesta = 'Nuestros productos serán entregados a través de Starken dependiendo de la dirección de envío. El plazo de entrega promedio en RM es de 3 días y en Regiones es de 10 días hábiles.';
        $response->frequent_question_id = '2';
        $response->save();

        $response = new Frequent_response();
        $response->respuesta = 'No, solo realizamos cambios de producto.';
        $response->frequent_question_id = '3';
        $response->save();


        $response = new Frequent_response();
        $response->respuesta = '¡No hay problema!, nos comunicamos contigo y cambiamos el producto.';
        $response->frequent_question_id = '4';
        $response->save();

        $response = new Frequent_response();
        $response->respuesta = 'Por el momento tenemos Transferencia Bancaria y efectivo';
        $response->frequent_question_id = '5';
        $response->save();
    }
}
