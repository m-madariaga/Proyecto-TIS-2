<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Seeder;

class SocialNetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialnetwork = new SocialNetwork();
        $socialnetwork->nombre = 'Número Teléfonico';
        $socialnetwork->valor = '+56990959494';
        $socialnetwork->visible = '1';
        $socialnetwork->save();

        $socialnetwork = new SocialNetwork();
        $socialnetwork->nombre = 'Facebook';
        $socialnetwork->valor = 'https://es-la.facebook.com/';
        $socialnetwork->visible = '1';
        $socialnetwork->save();

        $socialnetwork = new SocialNetwork();
        $socialnetwork->nombre = 'Instagram';
        $socialnetwork->valor = 'https://www.instagram.com/que.guay_/';
        $socialnetwork->visible = '1';
        $socialnetwork->save();

        
        $socialnetwork = new SocialNetwork();
        $socialnetwork->nombre = 'Twitter';
        $socialnetwork->valor = 'https://twitter.com/?lang=es';
        $socialnetwork->visible = '1';
        $socialnetwork->save();
    }
}
