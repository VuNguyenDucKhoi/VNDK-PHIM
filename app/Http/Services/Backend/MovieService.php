<?php

namespace App\Http\Services\Backend;

use App\Models\Episode;
use App\Models\Movie;

use App\Models\Movie_Genre;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MovieService
{
    public function getAll(){
        return Movie::with('movie_genre', 'genre')
            ->with('category')
            ->with('country')
            ->orderBy('id', 'DESC')->get();
    }

    public function getAllforEpi(){
        return Movie::where('status', 1)->orderBy('updated_at', 'DESC')->pluck('title', 'id');
    }

    public function countAll(){
        $list = Movie::get();
        return count($list);
    }

    public function create($request): bool
    {
        try{
            $data = $request->all();
            $movie = new Movie();
            $movie->title = $data['title'];
            $movie->title_eng = $data['title_eng'];
            $movie->description = $data['description'];
            $movie->status = $data['status'];
            $movie->category_id = $data['category_id'];
            foreach ($data['genre_id'] as $key => $genre){
                $movie->genre_id = $genre[0];
            }
            $movie->country_id = $data['country_id'];
            $movie->slug = $data['slug'];
            $movie->moviehot = $data['moviehot'];
            $movie->resolution = $data['resolution'];
            $movie->sub_title = $data['sub_title'];
            $movie->running_time = $data['running_time'];
            $movie->tags = $data['tags'];
            $movie->trailer = $data['trailer'];
            $movie->episodes = $data['episodes'];
            $movie->isboorle = $data['isboorle'];

            $getImage = $request->file('image');
            if($getImage){
                $getNameImage = $getImage->getClientOriginalName();
                $nameImage = current(explode('.',$getNameImage));
                $newImage = $nameImage.rand(0,9999).'.'.$getImage->getClientOriginalExtension();
                $getImage->move('uploads/movie',$newImage);
                $movie->image = $newImage;
            }
            $movie->save();
            // Phim nhiều thể loại
            $movie->movie_genre()->attach($data['genre_id']);

            Session::flash('success', ' Thêm phim thành công!');
        }catch (\Exception $err){
            Session::flash('error', ' Lỗi, Thêm phim thất bại!');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function getId($id){
        Return Movie::where('id', $id)->firstOrFail();
    }

    public function update($id, $request) : bool{
        try{
            $data = $request->all();
            $movie = Movie::find($id);
            $movie->title = $data['title'];
            $movie->title_eng = $data['title_eng'];
            $movie->description = $data['description'];
            $movie->status = $data['status'];
            $movie->category_id = $data['category_id'];
            foreach ($data['genre_id'] as $key => $genre){
                $movie->genre_id = $genre[0];
            }
            $movie->country_id = $data['country_id'];
            $movie->slug = $data['slug'];
            $movie->moviehot = $data['moviehot'];
            $movie->resolution = $data['resolution'];
            $movie->sub_title = $data['sub_title'];
            $movie->running_time = $data['running_time'];
            $movie->tags = $data['tags'];
            $movie->trailer = $data['trailer'];
            $movie->episodes = $data['episodes'];
            $movie->isboorle = $data['isboorle'];

            $getImage = $request->file('image');
            if($getImage){
                if($movie->image != NULL){
                    $fileLink = 'uploads/movie/'.$movie->image;
                    unlink($fileLink);
                    $getNameImage = $getImage->getClientOriginalName();
                    $nameImage = current(explode('.',$getNameImage));
                    $newImage = $nameImage.rand(0,9999).'.'.$getImage->getClientOriginalExtension();
                    $getImage->move('uploads/movie',$newImage);
                    $movie->image = $newImage;
                }
                else{
                    $getNameImage = $getImage->getClientOriginalName();
                    $nameImage = current(explode('.',$getNameImage));
                    $newImage = $nameImage.rand(0,9999).'.'.$getImage->getClientOriginalExtension();
                    $getImage->move('uploads/movie',$newImage);
                    $movie->image = $newImage;
                }
            }
            $movie->save();
            // Phim nhiều thể loại
            $movie->movie_genre()->sync($data['genre_id']);
            Session::flash('success', ' Cập nhật phim thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Cập nhật phim thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($id){
        try{
            $movie = Movie::find($id);
            if($movie->image != NULL){
                $fileLink = 'uploads/movie/'.$movie->image;
                unlink($fileLink);
            }
            Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
            Episode::whereIn('movie_id',[$movie->id])->delete();
            $movie->delete();
            Session::flash('success', ' Xóa phim thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Xóa phim thất bại');
            Log::info($err->getMessage());
        }
    }

    public function updateYear($request){
        $data = $request->all();
        $movie = Movie::find($data['id_movie']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function updateSeason($request){
        $data = $request->all();
        $movie = Movie::find($data['id_movie']);
        $movie->season = $data['season'];
        $movie->save();
    }
}
