<?php

namespace App\Http\Services\Frontend;

use App\Models\Genre;

class GenreService
{
    public function getAll(){
        return Genre::where('status', 1)->orderBy('title')->get();
    }

    public function getSlug($slug){
        return Genre::where('slug', $slug)->first();
    }
}
