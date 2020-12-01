<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

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
            'price' => random_int(0,200),
            'vat' => random_int(0,20),
            'deposit' => random_int(0,1),
            'is_packaging' => false,
            'wholesale' => false,
            'public_purchase' => true,
            'brand_id' => function(){
                return Brand::factory()->create()->id;
            },
            'location_id' => function(){
                return Location::factory()->create()->id;
            },
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
