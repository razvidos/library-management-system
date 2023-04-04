<?php

namespace Database\Seeders;

use App\Models\BookGenre;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BookGenre::factory(10)->create();
    }
}
