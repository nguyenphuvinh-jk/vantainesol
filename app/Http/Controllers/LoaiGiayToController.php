<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\LoaiGiayTo;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
session_start();

class LoaiGiayToController extends Controller
{
    public function index(){
        $loaigiayto = LoaiGiayTo::all();
        return view('loaigiayto.loaigiayto')->with(compact('loaigiayto'));
    }

    public function luu(Request $request){
        $request->validate([
            "tengiayto" => "required|unique:tbl_loaigiayto",
        ],[
            'tengiayto.required' => 'Không được để trống',
            'tengiayto.loaigiayto' => 'Dữ liệu đã được thêm',
        ]);

        try {
            $loaigiayto =  new LoaiGiayTo();
            $loaigiayto->tengiayto = $request->tengiayto;
            $loaigiayto->save();
            Session::flash('message','Thêm thành công!');
            return Redirect::back();
        }catch (\Exception $e){
            Log::error($e);
            Session::flash('message_err','Thêm thất bại!!!');
            return Redirect::back();
        }

    }

    public function xoa($loaigiayto_id){
        try {
            loaigiayto::where('id',$loaigiayto_id)->delete();
            Session::flash('message','Thêm thành công!');
            return Redirect::back();
        }catch (\Exception $e){
            Log::error($e);
            Session::flash('message_err','Xóa thất bại!!!');
            return Redirect::back();
        }

    }
}
