<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'sort_order',
        'type',
        'image',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_desc'
    ];

    protected static function boot()
    {
        parent::boot();

        // Define the 'saving' event handler
        static::saving(function ($category) {
            $originalSlug = $category->slug;
            $count = 1;

            // Check if the current slug is unique
            while (static::where('slug', $category->slug)->where('id', '!=', $category->id)->exists()) {
                $category->slug = $originalSlug . '-' . $count;
                $count++;
            }
        });
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('sort_order', 'ASC');
    }

    public function category()
    {
        return $this->morphedByMany(Category::class, 'catables');
    }

    public function mags()
    {
        return $this->morphedByMany(Mag::class, 'catables');
    }
}
