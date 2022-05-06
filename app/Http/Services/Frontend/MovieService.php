<?php

namespace App\Http\Services\Frontend;

use App\Models\Movie;
use App\Models\Movie_Genre;
use Illuminate\Support\Facades\DB;

class MovieService
{
    public function getMovieYear(){
        return Movie::select('year')->where('status', 1)->groupBy('year')->get();
    }


    public function getMovieOrYear($year_movie){
        return Movie::where('year', $year_movie)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
    }

    public function getMovieHot(){
        return Movie::where('moviehot', 1)->where('status', 1)->orderBy('created_at', 'DESC')->get();
    }

    public function getMovieCate($id){
        return Movie::where('category_id', $id)
            ->with('episode')
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);
    }

    public function getMovieGenre($id){
        return Movie_Genre::where('genre_id', $id)->get();
    }

    public function getMovieGen($many_genre){
        return Movie::whereIn('id', $many_genre)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
    }

    public function getMovieCou($id){
        return Movie::where('country_id', $id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
    }

    public function getMovieWatch($slug){
        return Movie::where('slug', $slug)->where('status', 1)->firstOrFail();
    }

    public function getMovieTag($tag){
        return Movie::where('tags', 'LIKE', '%'.$tag.'%')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
    }

    public function getMovieSearch($search){
        return Movie::where('title', 'LIKE', '%'.$search.'%')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
    }

    public function getMovieRelated($id, $slug){
        return Movie::where('genre_id', $id)->where('status', 1)
            ->orderBy(DB::raw('RAND()'))
            ->whereNotIn('slug', [$slug])
            ->limit(6)
            ->get();
    }
}
