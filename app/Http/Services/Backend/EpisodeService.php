<?php

namespace App\Http\Services\Backend;

use App\Models\Episode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EpisodeService
{
    public function getAll(){
        return Episode::with('movie')->orderBy('updated_at', 'DESC')->get();
    }

    public function getId($id){
        Return Episode::where('id', $id)->firstOrFail();
    }

    public function create($request): bool
    {
        try{
            $request->except('_token');
            Episode::create($request->all());
            Session::flash('success', ' Thêm tập phim thành công!');
        }catch (\Exception $err){
            Session::flash('error', ' Lỗi, Thêm tập loại phim thất bại!');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($id, $request) : bool{
        try{
            $episode = Episode::find($id);
            $episode->fill($request->input());
            $episode->save();
            Session::flash('success', ' Cập nhật tập phim thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Cập nhật tập phim thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($id){
        try{
            Episode::find($id)->delete();
            Session::flash('success', ' Xóa tập phim thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Xóa tập phim thất bại');
            Log::info($err->getMessage());
        }
    }

}
