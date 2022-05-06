<?php

namespace App\Http\Services\Backend;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    public function getAll(){
        return Category::orderBy('position', 'ASC')->paginate(10);
    }

    public function countAll(){
        $list = Category::get();
        return count($list);
    }

    public function getAllStatus(){
        return Category::where('status', 1)->pluck('title', 'id');
    }
    public function create($request): bool
    {
        try{
            $request->except('_token');
            Category::create($request->all());
            Session::flash('success', ' Thêm danh mục thành công!');
        }catch (\Exception $err){
            Session::flash('error', ' Lỗi, Thêm danh mục thất bại!');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function update($id, $request) : bool{
        try{
            $category = Category::find($id);
            $category->fill($request->input());
            $category->save();
            Session::flash('success', ' Cập nhật danh mục thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Cập nhật danh mục thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function getId($id){
        Return Category::where('id', $id)->firstOrFail();
    }
    public function delete($id){
        try{
            Category::where('id', $id)->delete();
            Session::flash('success', ' Xóa danh mục thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Xóa danh mục thất bại');
            Log::info($err->getMessage());
        }
    }
    public function resort($request){
        $data = $request->all();
        foreach ($data['array_id'] as $key => $value){
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
}
