<?php

namespace App\Http\Controllers;

use App\Bagislar;
use App\UserBagis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function bagislarim()
    {
        $bagislarim=UserBagis::with('get_bagis_bilgisi')->where('user_id',Auth::id())->orderByDesc('created_at')->get();
        return view('bagislarim',compact('bagislarim'));
    }
    public function bagis_yap($slug)
    {
        if ($slug)
        {
            $bagis=Bagislar::where('slug',$slug)->first();
            return view('bagis_yap',compact('bagis'));
        }
        return redirect()->route('bagislar');
    }

    public function bagis_yap_post(Request $request)
    {
        $bagis=Bagislar::where('id',$request->bagis_id)->first();
        if ($bagis->created_at>Carbon::now() || $bagis->bagis_tamamlandı==1)
        {
            return redirect()->route('bagis_yap',["slug"=>$bagis->slug])->with('hata',"Bu kampanya bağışa kapanmış yada aktif değil.");
        }
        if ($bagis)
        {
            $sonuc=[];
            $bagis_no=$this->random_siparis_no();
            $sonuc["bagisno"]=$bagis_no;
            $yeni_bagis=new UserBagis();
            $yeni_bagis->bagis_no=$bagis_no;
            $yeni_bagis->user_id=Auth::id();
            $yeni_bagis->bagis_id=$bagis->id;
            if ($request->tutar=="custom")
            {
                if (!$this->decimal_yap($request->elle_tutar))
                {
                    return redirect()->route('bagis_yap',["slug"=>$bagis->slug])->with('hata',"Geçersiz Tutar Girişi Yaptınız.");
                }
                $yeni_bagis->bagis_tutari=$this->decimal_yap($request->elle_tutar);
                $sonuc["tutar"]=$this->decimal_yap($request->elle_tutar);
            }
            else
            {
                if (!$this->decimal_yap($request->tutar))
                {
                    return redirect()->route('bagis_yap',["slug"=>$bagis->slug])->with('hata',"Geçersiz Tutar Girişi Yaptınız.");
                }
                $yeni_bagis->bagis_tutari=$this->decimal_yap($request->tutar);
                $sonuc["tutar"]=$this->decimal_yap($request->tutar);
            }
            $yeni_bagis->save();
            if ($yeni_bagis)
                return redirect()->route('bagis_yap',["slug"=>$bagis->slug])->with('basarili',$sonuc);
            else
                return redirect()->route('bagis_yap',["slug"=>$bagis->slug])->with('hata',"Hata Oluştu Tekrar Deneyin");
        }
        return redirect()->route('bagis_yap',["slug"=>$bagis->slug])->with('hata',"Geçersiz İşlem");
    }
    public function decimal_yap($tutar)
    {
        try
        {
            if (!is_numeric(str_replace(',','.',$tutar)))
            {
                return false;
            }
            $tutar= str_replace(',','.',$tutar);
            if ($tutar<=0)
            {
                return false;
            }
            return $tutar;
        }
        catch (\Exception $e)
        {
            return 0;
        }
    }

    public function random_siparis_no()
    {
        $random=mt_rand(1000000000,mt_getrandmax());
        if (UserBagis::where('bagis_no',$random)->first())
        {
           return $this->random_siparis_no();
        }
        return $random;
    }
}
