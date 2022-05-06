<?php

namespace App\Http\Services\Frontend;

use App\Models\Category;

class CategoryService
{
    public function getAll(){
        return Category::where('status', 1)->orderBy('id')->get();
    }

    public function getHome(){
        return Category::with('movie')->where('status', 1)->orderBy('id')->get();
    }

    public function getSlug($slug){
        return Category::where('slug', $slug)->first();
    }
}
