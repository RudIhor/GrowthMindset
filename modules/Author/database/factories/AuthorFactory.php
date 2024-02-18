<?php

namespace Modules\Author\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Author\app\Models\Author;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
        ];
    }
}
