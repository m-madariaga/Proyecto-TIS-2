<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CitySeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PayMentMethods::class);
        
        $this->call(ShipmentTypesSeeder::class);
        $this->call(DataBankSeeder::class);
        $this->call(SectionSeeder::class);   
        $this->call(SocialNetworksSeeder::class);
        
        $this->call(QuestionsSeeder::class); 
        $this->call(ResponseSeeder::class); 

        $this->call(ImagesSeeder::class); 
    }
}
