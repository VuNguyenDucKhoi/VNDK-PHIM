<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\Backend\EpisodeService;
use App\Http\Services\Backend\MovieService;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    private $episode, $movie;

    public function __construct(EpisodeService $episode, MovieService $movie)
    {
        $this->episode = $episode;
        $this->movie = $movie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->episode->getAll();
        $title = 'Tập phim';
        return view('backend.episode.index', compact('title', 'list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm mới tập phim';
        $list_movie = $this->movie->getAllforEpi();
        return view('backend.episode.form', compact('title', 'list_movie'));
    }

    public function select_movie(){
        $id = $_GET['id'];
        $movie = $this->movie->getId($id);
        $output = '';
        if($movie->isboorle == 1){
            for($i = 1; $i <= $movie->episodes; $i++){
                $output.= ' <option value="'.$i.'">'.$i.'</option> ';
            }
        }else{
            $output.= ' <option value="HD">HD</option>
                        <option value="FullHD">FullHD</option>
                        <option value="HD">CAM</option>
                        <option value="HD">HDCAM</option> ';
        }

        echo $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->episode->create($request);
        return redirect()->route('admin.episode.index');
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
        $list_movie = $this->movie->getAllforEpi();
        $episode = $this->episode->getId($id);
        $title = 'Sửa tập phim: '. $episode->title . ' - '. $episode->movie->title;
        return view('backend.episode.form', compact('episode', 'title', 'list_movie'));
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
        $this->episode->update($id, $request);
        return redirect()->route('admin.episode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->episode->delete($id);
        return redirect()->back();
    }


}
