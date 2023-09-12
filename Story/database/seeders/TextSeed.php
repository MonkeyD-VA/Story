<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class TextSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake  = Faker\Factory::create();
        $limit = 70;

        for ($i = 0; $i < $limit; $i++){
            DB::table('texts')->insert([
                'text_content' => $fake->sentence,
                'audio_id' => $fake->unique()->numerify($string = '##'),
                'audio_file' => $fake->sentence,
                'audio_time' => $fake->numerify($string = '#'),
                'text_type' => $fake->randomLetter,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
