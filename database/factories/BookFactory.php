<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Category;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'category_id' => Category::factory(), // automatically create category
            'published_year' => $this->faker->year,
            'stock_count' => $this->faker->numberBetween(1, 10),
        ];
    }
}
