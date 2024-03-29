<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'main_name',
        'name',
        'type',
        'path',
        'url',
        'size',
        'file',
    ];
}
