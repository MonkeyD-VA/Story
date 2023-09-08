<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class TouchSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake  = Faker\Factory::create();
        $limit = 70;

        for ($i = 0; $i < $limit; $i++){
            DB::table('touches')->insert([
                'touch_id' => $i + 1,
                'page_id' => $fake->unique()->numerify($string='##'),
                'text_id' => $fake->unique()->numerify($string = '##'),
                'position' => $fake->json,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
