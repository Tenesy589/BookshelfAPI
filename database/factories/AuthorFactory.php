<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'patronymic' => $this->faker->lastName,
        ];
    }

    /**
     * Indicate that the author has a picture.
     *
     * @param  string  $path
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    /**
     * Indicate that the author has books.
     *
     * @param  int  $count
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function hasBooks($count)
    {
        return $this->afterCreating(function (Author $author) use ($count) {
            $books = Book::factory()->count($count)->create();

            $author->books()->attach($books);
        });
    }
}
