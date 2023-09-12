<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker;

class StorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake  = Faker\Factory::create();
        $limit = 70;

        for ($i = 0; $i < $limit; $i++){
            DB::table('stories')->insert([
                'story_name' => $fake->name,
                'author_id' => $fake->unique()->numerify($string = '###'),
                'author_name' => $fake->name,
                'category' => $fake->sentence,
                'thumb' => $fake->sentence,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
