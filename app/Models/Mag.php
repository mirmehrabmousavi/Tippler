<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'slug',
        'content',
        'publish',
        'meta_title',
        'meta_keyword',
        'meta_desc',
        'views',
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'catables');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }

    public function incrementViews()
    {
        $this->views++;
        return $this->save();
    }
}
