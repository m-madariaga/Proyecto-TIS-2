<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $section = new Section();
        $section->nombre = 'Hombre';
        $section->visible = '0';
        $section->save();

        $section = new Section();
        $section->nombre = 'Mujer';
        $section->visible = '1';
        $section->save();
        
      
        $section = new Section();
        $section->nombre = 'Niños';
        $section->visible = '0';
        $section->save();

        $section = new Section();
        $section->nombre = 'Accesorios';
        $section->visible = '0';
        $section->save();

    }
}