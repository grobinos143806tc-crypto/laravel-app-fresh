<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'genre',
        'published_year',
        'isbn',
        'pages',
        'language',
        'publisher',
        'price',
        'cover_image',
        'is_available',
    ];
}
