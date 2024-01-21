<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'image',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_desc'
    ];

   /* public function products()
    {
        return $this->morphedByMany(Product::class, 'taggables');
    }*/
    public function mags()
    {
        return $this->morphedByMany(Mag::class, 'taggables');
    }
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'taggables');
    }
}
