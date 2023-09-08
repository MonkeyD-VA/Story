<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class PageSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake  = Faker\Factory::create();
        $limit = 60;

        for ($i = 0; $i < $limit; $i++){
            DB::table('pages')->insert([
                'page_id' => $i + 1,
                'page_number' => $fake->numerify($string = '#'),
                'story_id' => $fake->numerify($string = '#'),
                'image_background' => $fake->sentence(20),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
