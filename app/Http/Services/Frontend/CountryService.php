<?php

namespace App\Http\Services\Frontend;

use App\Models\Country;

class CountryService
{
    public function getAll(){
        return Country::where('status', 1)->orderBy('title')->get();
    }

    public function getSlug($slug){
        return Country::where('slug', $slug)->first();
    }
}
