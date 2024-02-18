<?php

namespace Modules\Quote\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Author\database\factories\AuthorFactory;
use Modules\Category\database\factories\CategoryFactory;
use Modules\Quote\app\Models\Quote;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Quote\app\Models\Quote>
 */
class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        AuthorFactory::new()->count(10)->create();
        CategoryFactory::new()->count(10)->create();

        return [
            'content' => Str::random(),
            'author_id' => rand(1, 10),
            'category_id' => rand(1, 10),
        ];
    }
}
