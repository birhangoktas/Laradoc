<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Doctordate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctordates')->insert([
            [
                'doctor_time' => "7:30"
            ],
            [
                'doctor_time' => "8:00"
            ],
            [
                'doctor_time' => "8:30"
            ],
            [
                'doctor_time' => "9:00"
            ],
            [
                'doctor_time' => "9:30"
            ],
            [
                'doctor_time' => "10:00"
            ],
            [
                'doctor_time' => "10:30"
            ],
            [
                'doctor_time' => "11:00"
            ],
            [
                'doctor_time' => "11:30"
            ],
            [
                'doctor_time' => "12:00"
            ],
            [
                'doctor_time' => "12:30"
            ],
            [
                'doctor_time' => "13:00"
            ],
            [
                'doctor_time' => "13:30"
            ],
            [
                'doctor_time' => "14:00"
            ],
            [
                'doctor_time' => "14:30"
            ],
            [
                'doctor_time' => "15:00"
            ],
            [
                'doctor_time' => "15:30"
            ],
            [
                'doctor_time' => "16:00"
            ],
            [
                'doctor_time' => "16:30"
            ],
            [
                'doctor_time' => "17:00"
            ],
            [
                'doctor_time' => "17:30"
            ],
            [
                'doctor_time' => "18:00"
            ],
            [
                'doctor_time' => "18:30"
            ],
            [
                'doctor_time' => "19:00"
            ],
            [
                'doctor_time' => "19:30"
            ],
            [
                'doctor_time' => "20:00"
            ],
            [
                'doctor_time' => "20:30"
            ],
            [
                'doctor_time' => "21:00"
            ],
            [
                'doctor_time' => "21:30"
            ],

            [
                'doctor_time' => "22:00"
            ],
            [
                'doctor_time' => "22:30"
            ],
            [
                'doctor_time' => "23:00"
            ],
            [
                'doctor_time' => "23:30"
            ],
            [
                'doctor_time' => "00:00"
            ],
            [
                'doctor_time' => "00:30"
            ],
            [
                'doctor_time' => "01:00"
            ],
        ]);
    }
}
