<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Database\seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            // outros seeders, se houver
        ]);
    }    
}
