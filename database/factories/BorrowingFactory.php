<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "book_id"=>Book::inRandomOrder()->first()->id ?? Book::factory(),
            "member_id"=> member::inRandomOrder()->first()->id ?? member::factory(),
            "borrowed_at"=>$this->faker->dateTimeBetween('-1 month', 'now'),
            "due_date"=>$this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
