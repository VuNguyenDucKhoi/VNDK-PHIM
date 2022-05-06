<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\EpisodeService;
use Illuminate\Http\Request;
use App\Http\Services\Frontend\CountryService;
use App\Http\Services\Frontend\GenreService;
use App\Http\Services\Frontend\CategoryService;
use App\Http\Services\Frontend\MovieService;

class IndexController extends Controller
{
    private $category, $country, $genre, $movie, $episode;

    public function __construct(CategoryService $category,
                                CountryService $country,
                                GenreService $genre,
                                MovieService $movie, EpisodeService $episode)
    {
        $this->movie = $movie;
        $this->category = $category;
        $this->country = $country;
        $this->genre = $genre;
        $this->episode = $episode;
    }

    public function home(){
        $title = 'VNDK Phim | Xem phim mới | Phim Online | Full HD - Vietsub';
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $category_home = $this->category->getHome();
        $movie_hot = $this->movie->getMovieHot();

        return view('frontend.pages.home',
            compact('title', 'category', 'country', 'genre', 'category_home', 'movie_hot', 'movie_year'));
    }

    public function category($slug){
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $cate_slug =  $this->category->getSlug($slug);
        $movie = $this->movie->getMovieCate($cate_slug->id);
        $title = '[Tuyển tập] '.$cate_slug->title.' hay nhất 2022 | VNDK Phim';
        return view('frontend.pages.category',
            compact('title', 'category', 'country', 'genre', 'cate_slug', 'movie', 'movie_year'));
    }

    public function country($slug){
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $cou_slug =  $this->country->getSlug($slug);
        $movie = $this->movie->getMovieCou($cou_slug->id);
        $title = '[Tuyển tập] Phim '.$cou_slug->title.' hay nhất 2022 | VNDK Phim';
        return view('frontend.pages.country',
            compact('title', 'category', 'country', 'genre', 'cou_slug', 'movie', 'movie_year'));
    }

    public function genre($slug){
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $gen_slug =  $this->genre->getSlug($slug);
        $movie_genre = $this->movie->getMovieGenre($gen_slug->id);
        $many_genre = [];
        foreach ($movie_genre as $key => $movi){
            $many_genre[] = $movi->movie_id;
        }
        $movie = $this->movie->getMovieGen($many_genre);
        $title = '[Tuyển tập] Phim '.$gen_slug->title.' hay nhất 2022 | VNDK Phim';
        return view('frontend.pages.genre',
            compact('title', 'category', 'country', 'genre', 'gen_slug', 'movie', 'movie_year'));
    }

    public function year($year){
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $year_movie =  $year;
        $movie = $this->movie->getMovieOrYear($year_movie);
        $title = '[Tuyển tập] Phim '.$year_movie.' hay nhất 2022 | VNDK Phim';
        return view('frontend.pages.year',
            compact('title', 'category', 'country', 'genre', 'year_movie', 'movie', 'movie_year'));
    }

    public function movie($slug){
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $movie = $this->movie->getMovieWatch($slug);
        $movie_related = $this->movie->getMovieRelated($movie->genre->id, $slug);
        $first_episode = $this->episode->getIdEpiFirst($movie->id);
        $episode_current = $this->episode->getEpi($movie->id);
        $episode_current_count = $episode_current->count();
        $title = $movie->title;
        return view('frontend.pages.movie',
            compact('title', 'category', 'country', 'genre', 'movie', 'movie_related', 'movie_year', 'first_episode', 'episode_current_count'));
    }

    public function watch($slug, $tap){
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $movie = $this->movie->getMovieWatch($slug);
        $movie_related = $this->movie->getMovieRelated($movie->genre->id, $slug);

        if (isset($tap)){
            $episode = $tap;
            $episode = substr($tap, 4, 20);
            $episode_movie = $this->episode->getIdEpi($movie->id, $episode);
        } else{
            $episode = 1;
            $episode_movie = $this->episode->getIdEpi($movie->id, $episode);
        }

        $title = $movie->title.' - '.$episode_movie->title;
        return view('frontend.pages.watch',
            compact('title', 'category', 'country', 'genre', 'movie', 'movie_related', 'movie_year', 'episode_movie', 'episode'));
    }

    public function tag($tag){
        $movie_year = $this->movie->getMovieYear();
        $category = $this->category->getAll();
        $country = $this->country->getAll();
        $genre = $this->genre->getAll();
        $tag_movie =  $tag;
        $movie = $this->movie->getMovieTag($tag_movie);
        $title = 'Từ khóa - '.$tag_movie;
        return view('frontend.pages.tag',
            compact('title', 'category', 'country', 'genre', 'tag_movie', 'movie', 'movie_year'));
    }

    public function episode(){
        return view('frontend.pages.episode');
    }

    public function search(){
        if(isset($_GET['tu-khoa'])){
            $search = $_GET['tu-khoa'];
            $movie_year = $this->movie->getMovieYear();
            $category = $this->category->getAll();
            $country = $this->country->getAll();
            $genre = $this->genre->getAll();
            $movie = $this->movie->getMovieSearch($search);
            $title = 'Tìm kiếm - '.$search;
            return view('frontend.pages.search',
                compact('title', 'category', 'country', 'genre', 'search', 'movie', 'movie_year'));
        }
        else{
            return redirect()->to('/');
        }
    }

}
