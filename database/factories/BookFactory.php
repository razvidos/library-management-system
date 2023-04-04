<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'author_id' => Author::factory(),
            'ISBN' => $this->faker->isbn13(),
            'publish_date' => $this->faker->date(),
        ];
    }
}
