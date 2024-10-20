<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        "image",
        "thumbnail",
        "name",
        "slug",
        "content",
        "cat_ust",
        "status",
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Product::class, "category_id", "id");
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
