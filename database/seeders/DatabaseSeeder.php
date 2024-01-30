<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\DialogFlow\DialogFlow;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $diablogFlow = new DialogFlow();
        $response = $diablogFlow->deleteAllIntent();
        
        $this->call(UsersTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
    }
}
