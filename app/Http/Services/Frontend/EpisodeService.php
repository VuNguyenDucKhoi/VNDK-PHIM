<?php

namespace App\Http\Services\Frontend;

use App\Models\Episode;

class EpisodeService
{

    public function getIdEpiFirst($id){
        return Episode::with('movie')
            ->where('movie_id', $id)
            ->orderBy('episode', 'ASC')
            ->take(1)
            ->first();
    }

    public function getIdEpi($id, $episode){
        return Episode::with('movie')
            ->where('movie_id', $id)
            ->where('episode', $episode)
            ->orderBy('episode', 'DESC')
            ->first();
    }

    public function getEpi($id){
        return Episode::with('movie')
            ->where('movie_id', $id)
            ->get();
    }

}
