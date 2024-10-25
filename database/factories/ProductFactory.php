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
        $categoryId = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $sizeList = ["XS", "S", "M", "L", "XXL"];
        $color = ["Beyaz", "Siyah", "Kahverengi", "Mor"];
        $photo = ["images/shoe_1.jpg", "images/women.jpg", "images/men.jpg", "images/children.jpg", "images/men.jpg", "images/cloth_1.jpg", "images/cloth_2.jpg", "images/cloth_3.jpg", "images/person_1.jpg", "images/person_2.jpg", "images/person_3.jpg", "images/person_4.jpg"];

        return [
            "image" => $photo[random_int(0, 11)],
            "name" => fake()->name(),
            "category_id" => $categoryId[random_int(0, 8)],
            "short_text" => $categoryId[random_int(0, 8)] . "id'li ürün",
            "price" => random_int(10, 500),
            "size" => $sizeList[random_int(0, 4)],
            "color" => $color[random_int(0, 3)],
            "qty" => 1,
            "status" => "1",
            "content" => "yazılar",
        ];
        // images/shoe_1.jpg
    }
}
