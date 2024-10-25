<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId=[1,2,3,4,5,6,7,8,9];
        $sizeList=["XS","S","M","L","XXL"];
        $color=["Beyaz","Siyah","Kahverengi","Mor"];

        return [

            "name" => fake()->name(),
            "category_id" => $categoryId[random_int(0,8)],
            "short_text" => $categoryId[random_int(0,8)]."id'li ürün",
            "price" => random_int(10,500),
            "size" => $sizeList[random_int(0,4)],
            "color" => $color[random_int(0,3)],
            "qty" => 1,
            "status" => "1",
            "content" => "yazılar",
        ];
    }
}
