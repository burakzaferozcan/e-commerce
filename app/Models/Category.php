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

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'cat_ust', 'id');
    }

    public function category() {
        return $this->hasOne(Category::class,'id','cat_ust');
    }

    public function getTotalProductCount(){
        $total= $this->items()->count();
        foreach ($this->subcategory as $childCategory){
            $total+=$childCategory->items()->count();
        }
        return $total;
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
        return $this->hasOne(ImageMedia::class,'table_id','id')->where('model_name','Category');
    }
}
