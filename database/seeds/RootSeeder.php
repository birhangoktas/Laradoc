<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roots')->insert([
            'name' => 'Birhan',
            'last' => 'Göktaş',
            'email' => 'example.com',
            'password' => Hash::make('password'),
            'is_level' => 3
        ]);
    }
}
