<?php

namespace Database\Seeders;

use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [[

            'name' => Str::random(10),
            'lat' => rand(1,100),
            'lng' => rand(1,100),
        ],
        [

            'name' => Str::random(10),
            'lat' => rand(1,100),
            'lng' => rand(1,100),
        ]
        ,
        [

            'name' => Str::random(10),
            'lat' => rand(1,100),
            'lng' => rand(1,100),
        ]
        ];

        foreach ($locations as $location) {
            DB::table('locations')->insert($location);
        }
    }
}
