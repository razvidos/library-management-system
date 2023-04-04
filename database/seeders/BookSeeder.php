<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory(10)
            ->create()
            ->each(function ($book) {
                $book->genres()->attach(Genre::factory()->create());
            });
    }
}
