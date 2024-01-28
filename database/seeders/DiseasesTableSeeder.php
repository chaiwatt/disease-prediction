<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('diseases')->insert([
            [
                'name' => 'Diabetes'
            ],
            [
                'name' => 'Chronic respiratory'
            ],
            [
                'name' => 'Heart disease'
            ],
            [
                'name' => 'HIV'
            ],
            [
                'name' => 'Kidney disease'
            ],
            [
                'name' => 'Diarrhea'
            ],
            [
                'name' => 'Common cold'
            ],
            [
                'name' => 'Stroke'
            ],
            [
                'name' => 'Headaches'
            ],
            [
                'name' => 'Coronavirus'
            ],
            [
                'name' => 'Pneumonia'
            ],
            [
                'name' => 'Tuberculosis'
            ],
            [
                'name' => 'Cirrhosis'
            ],
            [
                'name' => 'Anxiety'
            ],
            [
                'name' => 'Influenza'
            ],
            [
                'name' => 'Sore throat'
            ],
            [
                'name' => 'Dengue'
            ],
            [
                'name' => 'Stomach Aches'
            ],
            [
                'name' => 'Malaria'
            ],
            [
                'name' => 'Zika'
            ],
            [
                'name' => 'Hepatitis'
            ],
            [
                'name' => 'Malaria'
            ],
            [
                'name' => 'Cholera'
            ],
            [
                'name' => 'Meningitis'
            ],
            [
                'name' => 'Hypertention'
            ],
            [
                'name' => 'Cardiovacular Disease'
            ]
        ]);
    }
}
