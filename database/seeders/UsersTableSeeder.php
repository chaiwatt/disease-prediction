<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'program',
            'email' => 'program@smep',
            'password' => bcrypt('11111111')
        ]);
        User::create([
            'name' => 'tara',
            'email' => 'tara@smep',
            'password' => bcrypt('11111111')
        ]);
        User::create([
            'name' => 'prung',
            'email' => 'prung@smep',
            'password' => bcrypt('11111111')
        ]);
    }
}
