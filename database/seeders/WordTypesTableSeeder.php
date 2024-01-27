<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WordTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('word_types')->insert([
            [
                'name' => 'adj'
            ],
            [
                'name' => 'adv'
            ],
            [
                'name' => 'verb'
            ],
            [
                'name' => 'aux verb'
            ],
            [
                'name' => 'pronoun'
            ],
            [
                'name' => 'prep'
            ],
            [
                'name' => 'article'
            ],
            [
                'name' => 'conj'
            ]
        ]);
    }
}
