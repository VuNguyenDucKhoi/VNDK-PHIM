<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'genre_id',
        'category_id',
        'country_id',
        'status',
        'slug',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,  'category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,  'country_id');
    }

    public function movie_genre()
    {
        return $this->belongsToMany(Genre::class,'movie_genre', 'movie_id', 'genre_id');
    }

    public function episode()
    {
        return $this->hasMany(Episode::class);
    }
}
