<?php

namespace App\Http\Controllers;

use App\Bagislar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index()
    {
        $oncelikli_bagis=Bagislar::with('get_kategori')->where('onemli_bagis',1)->where('created_at','<',Carbon::now())->orderByDesc('created_at')->first();
        return view('anasayfa',compact('oncelikli_bagis'));
    }
    public static function slaytlar()
    {
        $slaytlar=Bagislar::where('slayt_goster',1)->orderByDesc('created_at')->limit(5)->get();
        return $slaytlar;
    }

    public static function yaklasan_bagislar()
    {
        $yaklasan_bagislar=Bagislar::where('created_at','>',Carbon::now())->orderByAsc('created_at')->limit(3)->get();
        return $yaklasan_bagislar;
    }

    public static function diger_bagislar()
    {
        $diger_bagislar=Bagislar::orderByDesc('created_at')->get();
        return $diger_bagislar;
    }

    public static function turk_parasi_yap($tutar)
    {
        return number_format($tutar,2,',','.')." TL";
    }
}
