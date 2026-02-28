<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\borrowing;
use App\Models\member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Book::factory(40)->create();
        // member::factory(40)->create();
        // Author::factory(20)->create();
        borrowing::factory(50)->create();
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
