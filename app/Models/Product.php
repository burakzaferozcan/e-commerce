<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable, HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'category_id',
        'short_text',
        'price',
        'size',
        'color',
        'qty',
        'kdv',
        'status',
        'content',
        'title',
        'description',
        'keywords',
    ];
    public function category()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function images()
    {
        return $this->hasOne(ImageMedia::class,'table_id','id')->where('model_name','Product');
    }
}
