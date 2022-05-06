<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'episode',
        'movie_id',
        'movie_link',
        'status',
    ];
     public function movie(){
         return $this->belongsTo(Movie::class);
     }
}
