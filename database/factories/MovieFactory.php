<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = ["Action","Drama","Comedy","Adventure","Scary"];

        return [
            'name' => $this->faker->catchPhrase(),
            'year' => $this->faker->unique()->numberBetween($min = 1900, $max = 2023),
            'director' => $this->faker->name(),
            'category' => $category[rand(0,4)],
            'description' => $this->faker->text()
        ];
    }
}
