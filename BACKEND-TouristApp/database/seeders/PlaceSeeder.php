<?php

namespace Database\Seeders;

use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = [[

            'name' => Str::random(10),
            'location_id' => 1,
            'lat' => rand(1,100),
            'lng' => rand(1,100),
            'visited'=> (bool)rand(0,1)
        ],
        [

            'name' => Str::random(10),
            'location_id' => 1,
            'lat' => rand(1,100),
            'lng' => rand(1,100),
            'visited'=> (bool)rand(0,1)
        ]
        ,
        [

            'name' => Str::random(10),
            'location_id' => 1,
            'lat' => rand(1,100),
            'lng' => rand(1,100),
            'visited'=> (bool)rand(0,1)
        ]
        ];

        foreach ($places as $place) {
            DB::table('places')->insert($place);
        }
    }
}
