<?php

use Database\Seeders\Doctordate;
use Database\Seeders\RootSeeder;
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
        
        $this->call([RootSeeder::class,Doctordate::class]);
       
    }
}
