<?php

namespace Database\Seeders;

use App\Models\Frequent_question;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = new Frequent_question();
        $question->pregunta = '¿Envían a domicilio?';
        $question->save();
        
        $question = new Frequent_question();
        $question->pregunta = '¿Cuánto se demora mi pedido?';
        $question->save();

        $question = new Frequent_question();
        $question->pregunta = '¿Realizan devoluciones de dinero?';
        $question->save();

        $question = new Frequent_question();
        $question->pregunta = '¿Qué pasa si encuentro alguna falla en el producto?';
        $question->save();

        $question = new Frequent_question();
        $question->pregunta = '¿Cuáles son los medios de pago?';
        $question->save();
    }
}
