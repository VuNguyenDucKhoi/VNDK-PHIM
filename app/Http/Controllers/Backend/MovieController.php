<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\Backend\MovieService;
use App\Http\Services\Backend\CountryService;
use App\Http\Services\Backend\CategoryService;
use App\Http\Services\Backend\GenreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class MovieController extends Controller
{
    private $movie, $category, $genre, $country;

    public function __construct(MovieService $movie, CategoryService $category, CountryService $country, GenreService $genre)
    {
        $this->movie = $movie;
        $this->category = $category;
        $this->country = $country;
        $this->genre = $genre;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->movie->getAll();
        $sum = $this->movie->countAll();
        $path = public_path().'/template/json/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path. 'movie.json', json_encode($list));
        $title = 'Phim';
        return view('backend.movie.index', compact( 'list' ,'title', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->category->getAllStatus();
        $country = $this->country->getAllStatus();
        $genre = $this->genre->getAllStatus();

        $title = 'Thêm mới phim';
        return view('backend.movie.form', compact('title', 'genre', 'country', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->movie->create($request);
        return redirect()->route('admin.movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = $this->movie->getId($id);
        $category = $this->category->getAllStatus();
        $country = $this->country->getAllStatus();
        $genre = $this->genre->getAllStatus();
        $title = 'Sửa phim: '. $movie->title;
        return view('backend.movie.form', compact('movie', 'title', 'genre', 'country', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->movie->update($id, $request);
        return redirect()->route('admin.movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->movie->delete($id);
        return redirect()->back();
    }

    public function update_year(Request $request){
        $this->movie->updateYear($request);
    }
    public function update_season(Request $request){
        $this->movie->updateSeason($request);
    }
}
