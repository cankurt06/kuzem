<?php

namespace App\Http\Controllers;

use App\Bagislar;
use App\Haberler;
use App\UserBagis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $yaklasan_bagislar=Bagislar::with('get_kategori')->where('created_at','>',Carbon::now())->orderBy('created_at')->limit(3)->get();
        return $yaklasan_bagislar;
    }

    public static function diger_bagislar()
    {
        $diger_bagislar=Bagislar::where('created_at','<',Carbon::now())->orderByDesc('created_at')->get();
        return $diger_bagislar;
    }

    public static function footer_bagislar()
    {
        $footer_bagislar=Bagislar::where('created_at','<',Carbon::now())->orderByDesc('created_at')->limit(3)->get();
        return $footer_bagislar;
    }

    public static function turk_parasi_yap($tutar)
    {
        return number_format($tutar,2,',','.')." TL";
    }

    public static function footer_haberler()
    {
        $footer_haberler=Haberler::orderByDesc('created_at')->limit(3)->get();
        return $footer_haberler;
    }

    public static function yapilan_bagis_toplami($bagis_id)
    {
        $yapilan_odeme=UserBagis::where('bagis_id',$bagis_id)->where('bagis_durumu',1)->get();
        if (count($yapilan_odeme)>0)
        return $yapilan_odeme->sum("bagis_tutari");
        else
            return 0;
    }

    public static function bagis_tamamlama_orani($hedef_tutar,$odenen_tutar)
    {
        if ($odenen_tutar<=0)
        {
            return 0;
        }
        $yuzde=100-round((($hedef_tutar-$odenen_tutar)/$hedef_tutar)*100);
        return $yuzde;
    }

    public function bize_yazin(Request $request)
    {
        $data = array
        (
            'adi'=>$request->isim,
            'eposta'=>$request->eposta,
            'mesaj'=>$request->mesaj
        );
        try
        {
            Mail::send('iletisim_mail', $data, function ($message) use ($request){
                $message->subject ('Bağışçım Ol Mesaj Gönderildi!');
                $message->from ('iletisim@kuzemodevim.site', 'Bağışçım Ol');
                $message->to('iletisim@kuzemodevim.site', 'Bağışçım Ol')->to('cankurt06@gmail.com');
            });
            return redirect()->route('iletisim')->with('basarili','true');
        }catch (\Exception $e )
        {
            return redirect()->route('iletisim')->with('hata',$e->getMessage());
        }

    }
}
