<?php

namespace App\Http\Controllers;

use App\CaiDat;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Helper\Helper;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
session_start();

class CaiDatController extends Controller
{
    public function index() {
        $caidat = CaiDat::find(1);
        return view('caidat.caidat', compact('caidat'));
    }
    public function luu(Request $request) {
        $request->validate([
            "songay" => "required|numeric|max:90",
            "solit" => "required|numeric|max:30"
        ],[
            "songay.required" => "Không được để trống",
            "songay.max" => "Tối đa 90 ngày",
            "solit.required" => "Không được để trống",
            "solit.max" => "Tối đa 30 ngày"
        ]);
        $caidat = CaiDat::find(1);
        $caidat->songay = $request->songay;
        $caidat->solit = $request->solit;
        $caidat->save();
        Session::flash('message', 'Cập nhật thành công');
        return Redirect::to('/cai-dat');
    }
}
