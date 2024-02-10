<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'summary' => $this->faker->text,
            'description' => $this->faker->text,
            'stock' => $this->faker->numberBetween(2, 10),
            // 'brand_id'=>$this->faker->randomElement(Brand::all()->pluck('id')),
            // 'cat_id'=>$this->faker->randomElement(Category::where('is_parent',1)->get()->pluck('id')),
            // 'vendor_id'=>$this->faker->randomElement(User::all()->pluck('id')),
            // 'child_cat_id'=>$this->faker->randomElement(Category::where('is_parent', 0)->get()->pluck('id')),

            'brand_id' => $this->faker->randomElement(Brand::all()->pluck('id')),
            'cat_id' => 1,
            // 'cat_id' => $this->faker->randomElement(Category::where('is_parent', 1)->get()->pluck('id')),
            'vendor_id' => $this->faker->randomElement(User::all()->pluck('id')),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent', 0)->get()->pluck('id')),
            'photo' => $this->faker->imageUrl('400', '200'),
            'price' => $this->faker->randomFloat(1, 30, 100),

            'offer_price' => $this->faker->randomFloat(1, 20, 99),
            // 'price'=>0.00,
            // 'offer_price'=>$this->faker->randomFloat(10, 2),
            // 'offer_price'=>0.00,
            'discount' => 0.00,
            // 'discount'=>$this->faker->randomFloat(10, 2),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'conditions' => $this->faker->randomElement(['new', 'popular', 'winter']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
