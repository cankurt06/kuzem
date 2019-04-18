<?php

namespace App\Http\Controllers;

use App\Bagislar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BagisController extends Controller
{
    public function bagislar($slug=null)
    {
        if ($slug)
        {
            $bagis=Bagislar::where('slug',$slug)->first();
            return view('bagis',compact('bagis'));
        }
        $yaklasan_bagislar=Bagislar::with('get_kategori')->where('created_at','>',Carbon::now())->orderBy('created_at')->paginate(2,['*'], 'yaklasan-bagis');
        $aktif_bagislar=Bagislar::with('get_kategori')->where('created_at','<',Carbon::now())->where('bagis_tamamlandi',0)->orderByDesc('created_at')->paginate(2,['*'], 'devam-eden-bagis');
        $tamamlanan_bagislar=Bagislar::with('get_kategori')->where('bagis_tamamlandi',1)->orderByDesc('created_at')->paginate(2,['*'], 'tamamlanan-bagis');
        return view('bagislar',compact('yaklasan_bagislar','aktif_bagislar','tamamlanan_bagislar'));
    }
}
