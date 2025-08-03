<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use App\Models\CategoryTraining;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        CategoryTraining::insert([
            ['name' => 'Crypto'],
            ['name' => 'Data Science'],
            ['name' => 'Cybersécurité'],
            ['name' => 'Autres'],
        ]);
        */
        CategoryPost::insert([
            ['name' => 'Crypto'],
            ['name' => 'Data Science'],
            ['name' => 'Cybersécurité'],
            ['name' => 'Autres'],
        ]);
    }
}
