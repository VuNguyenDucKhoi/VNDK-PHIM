<?php

namespace App\Http\Services\Backend;

use App\Models\Genre;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class GenreService
{
    public function getAll(){
        return Genre::orderBy('id')->paginate(10);
    }
    public function countAll(){
        $list = Genre::get();
        return count($list);
    }
    public function getAllStatus(){
        return Genre::where('status', 1)->pluck('title', 'id');
    }
    public function create($request): bool
    {
        try{
            $request->except('_token');
            Genre::create($request->all());
            Session::flash('success', ' Thêm thể loại phim thành công!');
        }catch (\Exception $err){
            Session::flash('error', ' Lỗi, Thêm thể loại phim thất bại!');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function update($id, $request) : bool{
        try{
            $genre = Genre::find($id);
            $genre->fill($request->input());
            $genre->save();
            Session::flash('success', ' Cập nhật thể loại phim thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Cập nhật thể loại phim thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function getId($id){
        Return Genre::where('id', $id)->firstOrFail();
    }
    public function delete($id){
        try{
            Genre::where('id', $id)->delete();
            Session::flash('success', ' Xóa thể loại phim thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Xóa thể loại phim thất bại');
            Log::info($err->getMessage());
        }
    }
}
