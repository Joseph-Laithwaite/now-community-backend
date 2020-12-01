<?php

namespace Database\Factories;

use App\Models\Independent;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndependentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Independent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'slug' => $this->faker->word,
        'business_structure' => $this->faker->text,
        'email' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'profile_picture' => $this->faker->text,
        'cover_photo' => $this->faker->text,
        'about_us' => $this->faker->text
        ];
    }
}
