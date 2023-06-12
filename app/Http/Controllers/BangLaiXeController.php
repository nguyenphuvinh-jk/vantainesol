<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BangLai;
use App\CaiDat;
use App\TaiXe;
use Session;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
session_start();

class BangLaiXeController extends Controller
{
    public function index(){
        $taixe = TaiXe::all()->sortBy('ten_taixe');
        $caidat = CaiDat::find(1);
        $banglai = DB::table('tbl_banglai')
            ->join('tbl_taixe', 'tbl_taixe.taixe_id', '=', 'tbl_banglai.taixe_id')
            ->orderBy('banglai_id', 'desc')
            ->get();
        return view('banglaixe.banglaixe')->with(compact('taixe', 'banglai', 'caidat'));
    }

    public function luu(Request $request){
        $request->validate([
            "tenbanglai" => "required",
            "taixe_id" => "required",
            "ngaycap" => "required|date_format:d/m/Y",
            "ngayhethan" => "required|date_format:d/m/Y|after:ngaycap",
        ],[
            'tenbanglai.required' => 'Không được để trống',
            'taixe_id.required' => 'Không được để trống',
            'ngaycap.required' => 'Không được để trống',
            'ngayhethan.required' => 'Không được để trống',
            'ngayhethan.after' => 'Ngày hết hạn phải sau ngày cấp'
        ]);

        try {
            $banglai =  new BangLai();
            $banglai->tenbanglai = $request->tenbanglai;
            $banglai->taixe_id = $request->taixe_id;
            $banglai->ngaycap = Carbon::createFromFormat('d/m/Y', $request->ngaycap)->toDateString();
            $banglai->ngayhethan = Carbon::createFromFormat('d/m/Y', $request->ngayhethan)->toDateString();
            $banglai->donvicap = $request->donvicap;
            $banglai->save();
            Session::flash('message','Thêm bằng lái thành công!');
            return Redirect::back();
        }catch (\Exception $e){
            Log::error($e);
            Session::flash('message','Thêm bằng lái thất bại!');
            return Redirect::back();
        }
    }

    public function xoa($banglai_id){
        try {
            BangLai::where('banglai_id',$banglai_id)->delete();
            return Redirect::back();
        }catch (\Exception $e){
            Log::error($e);
            Session::flash('message','Không thể xóa trường này!');
            return Redirect::back();
        }

    }

    public function sua($banglai_id){
        $taixe = TaiXe::orderBy('ten_taixe', 'desc')->get();
        $caidat = CaiDat::find(1);
        $banglai = DB::table('tbl_banglai')
            ->join('tbl_taixe', 'tbl_taixe.taixe_id', '=', 'tbl_banglai.taixe_id')
            ->orderBy('banglai_id', 'desc')
            ->get();
        $banglai_edit = banglai::where('banglai_id',$banglai_id)->get();
        return view('banglaixe.banglaixe')->with(compact('banglai_edit', 'banglai', 'taixe', 'caidat'));
    }

    public function capnhat(Request $request,$banglai_id){
        $request->validate([
            "tenbanglai" => "required",
            "taixe_id" => "required",
            "ngaycap" => "required|date_format:d/m/Y",
            "ngayhethan" => "required|date_format:d/m/Y|after:ngaycap",

        ],[
            'tenbanglai.required' => 'Không được để trống',
            'taixe_id.required' => 'Không được để trống',
            'ngaycap.required' => 'Không được để trống',
            'ngayhethan.required' => 'Không được để trống',
            'ngayhethan.after' => 'Ngày hết hạn phải sau ngày cấp'
        ]);

        try {
            $banglai = BangLai::where('banglai_id',$banglai_id)->first();
            $banglai->tenbanglai = $request->tenbanglai;
            $banglai->taixe_id = $request->taixe_id;
            $banglai->ngaycap = Carbon::createFromFormat('d/m/Y', $request->ngaycap)->toDateString();
            $banglai->ngayhethan = Carbon::createFromFormat('d/m/Y', $request->ngayhethan)->toDateString();
            $banglai->donvicap = $request->donvicap;
            $banglai->save();
            Session::flash('message','Cập nhật thành công!');
            return Redirect::to('/quan-ly-tai-xe/bang-lai');
        }catch (\Exception $e){
            Log::error($e);
            Session::flash('message','Cập nhật không thành công!!');
            return Redirect::to('/quan-ly-tai-xe/bang-lai');
        }
    }
}
