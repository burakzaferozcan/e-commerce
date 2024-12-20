<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $men = Category::create([
            "name" => "Erkek",
            "content" => "Erkek Giyim",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => null,
        ]);
        Category::create([
            "name" => "Erkek Kazak",
            "content" => "Erkek Kazakları",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => $men->id,
        ]);
        Category::create([
            "name" => "Erkek Ayakkabı",
            "content" => "Erkek Ayakkabıları",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => $men->id,
        ]);
        $women = Category::create([
            "name" => "Kadın",
            "content" => "Kadın Giyim",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => null,
        ]);
        Category::create([
            "name" => "Kadın Çanta",
            "content" => "Kadın Çantaları",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => $women->id,
        ]);
        Category::create([
            "name" => "Kadın T-Shirt",
            "content" => "Kadın T-Shirtleri",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => $women->id,
        ]);
        $child = Category::create([
            "name" => "Çocuk",
            "content" => "Çocuk Giyim",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => null,
        ]);
        Category::create([
            "name" => "Çocuk Pantolon",
            "content" => "Çocuk Pantolonları",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => $child->id,
        ]);
        Category::create([
            "name" => "Çocuk Polar",
            "content" => "Çocuk Polarları",
            "status" => "1",
            "image" => null,
            "thumbnail" => null,
            "cat_ust" => $child->id,
        ]);
    }
}
