<?php

namespace App\Http\Services\Backend;

use App\Models\Country;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CountryService
{
    public function getAll(){
        return Country::orderBy('id')->paginate(10);
    }
    public function countAll(){
        $list = Country::get();
        return count($list);
    }
    public function getAllStatus(){
        return Country::where('status', 1)->pluck('title', 'id');
    }
    public function create($request): bool
    {
        try{
            $request->except('_token');
            Country::create($request->all());
            Session::flash('success', ' Thêm quốc gia thành công!');
        }catch (\Exception $err){
            Session::flash('error', ' Lỗi, Thêm quốc gia thất bại!');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function update($id, $request) : bool{
        try{
            $county = Country::find($id);
            $county->fill($request->input());
            $county->save();
            Session::flash('success', ' Cập nhật quốc gia thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Cập nhật quốc gia thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function getId($id){
        Return Country::where('id', $id)->firstOrFail();
    }
    public function delete($id){
        try{
            Country::where('id', $id)->delete();
            Session::flash('success', ' Xóa quốc gia thành công');
        }catch (\Exception $err){
            Session::flash('error', ' Xóa quốc gia thất bại');
            Log::info($err->getMessage());
        }
    }
}
