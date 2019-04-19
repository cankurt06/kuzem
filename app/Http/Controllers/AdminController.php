<?php

namespace App\Http\Controllers;

use App\Bagislar;
use App\Haberler;
use App\User;
use App\UserBagis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public static function bagis_sayisi()
    {
        $bagis_sayisi = Bagislar::selectRaw('COUNT(id) AS SAYI')->first()->SAYI;
        return $bagis_sayisi;
    }

    public static function toplanan_para()
    {
        $toplanan_para = UserBagis::selectRaw('SUM(bagis_tutari) AS TOPLAM')->first()->TOPLAM;
        return $toplanan_para;
    }

    public static function toplam_bagis_yuzdesi()
    {
        $hedef_para = Bagislar::selectRaw('SUM(bagis_tutar) AS TOPLAM')->first()->TOPLAM;
        $toplanan_para = UserBagis::selectRaw('SUM(bagis_tutari) AS TOPLAM')->first()->TOPLAM;
        if ($toplanan_para <= 0) {
            return 0;
        }
        $yuzde = 100 - round((($hedef_para - $toplanan_para) / $hedef_para) * 100);
        return $yuzde;
    }

    public static function bagisci_sayisi()
    {
        $user = User::selectRaw('COUNT(id) AS SAYI')->first()->SAYI;
        return $user;
    }

    public static function bagis_oranlari()
    {
        $tamamlanan = UserBagis::selectRaw('COUNT(id) AS TOPLAM')->where('bagis_durumu', 1)->first()->TOPLAM;
        $bekleyen = UserBagis::selectRaw('COUNT(id) AS TOPLAM')->where('bagis_durumu', 0)->first()->TOPLAM;
        $hepsi = UserBagis::selectRaw('COUNT(id) AS TOPLAM')->first()->TOPLAM;
        $bagis_oran["tamam"] = 100 - round((($hepsi - $tamamlanan) / $hepsi) * 100);
        $bagis_oran["bekleyen"] = 100 - round((($hepsi - $bekleyen) / $hepsi) * 100);
        return $bagis_oran;
    }

    public function kullanici_sil($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin_uyeler')->with('sonuc', ["success", "Kullanıcı Başarıyla Silindi."]);
    }

    public function kullanici_admin_yap($id)
    {
        User::where('id', $id)->update(['admin_user' => 1]);
        return redirect()->route('admin_uyeler')->with('sonuc', ["success", "Kullanıcı Artık Yönetici Yetkisine Sahip."]);
    }

    public function bagis_sil($id)
    {
        Bagislar::where('id', $id)->delete();
        return redirect()->route('admin_bagislar')->with('sonuc', ["success", "Bağış Başarıyla Silindi."]);
    }

    public function bagis_ekle(Request $request)
    {
        $bagis_con = new BagisController();
        $yeni_bagis = new Bagislar();
        $yeni_bagis->user_id = Auth::id();
        $yeni_bagis->bagis_adi = $request->bagis_adi;
        $yeni_bagis->bagis_slogan = $request->bagis_slogan;
        $yeni_bagis->bagis_icerik = $request->bagis_icerik;
        $yeni_bagis->bagis_turu = $request->bagis_turu;
        $yeni_bagis->bagis_tutar = $bagis_con->decimal_yap($request->bagis_tutar) != false ? $bagis_con->decimal_yap($request->bagis_tutar) : 0;
        $yeni_bagis->slayt_goster = $request->slayt_resmi != "" ? 1 : 0;
        $yeni_bagis->slayt_resmi = $request->slayt_resmi;
        $yeni_bagis->bagis_resmi = $request->bagis_resmi != "" ? $request->bagis_resmi : "images/empty.png";
        $yeni_bagis->onemli_bagis = $request->onemli_bagis == "on" ? 1 : 0;
        $yeni_bagis->slug = $this->slug_kontrol(str_slug($request->bagis_adi, '-'), "bagis");
        $yeni_bagis->created_at=Carbon::parse($request->bagis_tarihi)->format('Y-m-d 00:00:00');
        $yeni_bagis->save();
        return redirect()->route('bagis_ekle')->with('sonuc', ["success", "Bağış Başarıyla Eklendi."]);
    }

    public function bagis_duzenle($id)
    {
        $bagis = Bagislar::with('get_kategori')->where('id', $id)->first();
        if ($bagis)
            return view('admin.bagis_duzenle', compact('bagis'));
        else
            return redirect()->route("admin_bagislar");
    }

    public function bagis_duzenle_post(Request $request)
    {
        $bagis_con = new BagisController();
        $yeni_bagis = Bagislar::where('id',$request->id)->first();
        $yeni_bagis->bagis_adi = $request->bagis_adi;
        $yeni_bagis->bagis_slogan = $request->bagis_slogan;
        $yeni_bagis->bagis_icerik = $request->bagis_icerik;
        $yeni_bagis->bagis_turu = $request->bagis_turu;
        $yeni_bagis->bagis_tutar = $bagis_con->decimal_yap($request->bagis_tutar) != false ? $bagis_con->decimal_yap($request->bagis_tutar) : 0;
        $yeni_bagis->slayt_goster = $request->slayt_resmi != "" ? 1 : 0;
        $yeni_bagis->slayt_resmi = $request->slayt_resmi;
        $yeni_bagis->bagis_resmi = $request->bagis_resmi != "" ? $request->bagis_resmi : "images/empty.png";
        $yeni_bagis->onemli_bagis = $request->onemli_bagis == "on" ? 1 : 0;
        $yeni_bagis->bagis_tamamlandi = $request->bagis_tamamlandi == "on" ? 1 : 0;
        $yeni_bagis->slug = $this->slug_kontrol(str_slug($request->bagis_adi, '-'), "bagis",$yeni_bagis->slug);
        $yeni_bagis->created_at=Carbon::parse($request->bagis_tarihi)->format('Y-m-d 00:00:00');
        $yeni_bagis->save();
        return redirect()->route('bagis_duzenle',['id'=>$request->id])->with('sonuc', ["success", "Bağış Başarıyla Güncellendi."]);
    }

    public static function aylik_istatiktik()
    {
        $tutar = collect();
        $ay = collect();
        $simdiki_ay = Carbon::now();
        $bir_ay_oncesi = Carbon::now()->subMonths(1);
        $iki_ay_oncesi = Carbon::now()->subMonths(2);
        $uc_ay_oncesi = Carbon::now()->subMonths(3);
        $dort_ay_oncesi = Carbon::now()->subMonths(4);
        $bes_ay_oncesi = Carbon::now()->subMonths(5);
        $alti_ay_oncesi = Carbon::now()->subMonths(6);
        $yedi_ay_oncesi = Carbon::now()->subMonths(7);
        $sekiz_ay_oncesi = Carbon::now()->subMonths(8);
        $dokuz_ay_oncesi = Carbon::now()->subMonths(9);
        $on_ay_oncesi = Carbon::now()->subMonths(10);
        $onbir_ay_oncesi = Carbon::now()->subMonths(11);
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $onbir_ay_oncesi->year)->whereMonth('created_at', $onbir_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($onbir_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $on_ay_oncesi->year)->whereMonth('created_at', $on_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($on_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $dokuz_ay_oncesi->year)->whereMonth('created_at', $dokuz_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($dokuz_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $sekiz_ay_oncesi->year)->whereMonth('created_at', $sekiz_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($sekiz_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $yedi_ay_oncesi->year)->whereMonth('created_at', $yedi_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($yedi_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $alti_ay_oncesi->year)->whereMonth('created_at', $alti_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($alti_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $bes_ay_oncesi->year)->whereMonth('created_at', $bes_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($bes_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $dort_ay_oncesi->year)->whereMonth('created_at', $dort_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($dort_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $uc_ay_oncesi->year)->whereMonth('created_at', $uc_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($uc_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $iki_ay_oncesi->year)->whereMonth('created_at', $iki_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($iki_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $bir_ay_oncesi->year)->whereMonth('created_at', $bir_ay_oncesi->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($bir_ay_oncesi->month));
        $tutar->push(UserBagis::where('bagis_durumu', 1)->whereYear('created_at', $simdiki_ay->year)->whereMonth('created_at', $simdiki_ay->month)->get()->sum("bagis_tutari"));
        $ay->push(self::ay_adi($simdiki_ay->month));
        $sonuc["tutar"] = $tutar;
        $sonuc["ay"] = $ay;
        return $sonuc;
    }

    public static function ay_adi($ay)
    {
        switch ($ay) {
            case 1:
                return "Ocak";
                break;
            case 2:
                return "Şubat";
                break;
            case 3:
                return "Mart";
                break;
            case 4:
                return "Nisan";
                break;
            case 5:
                return "Mayıs";
                break;
            case 6:
                return "Haziran";
                break;
            case 7:
                return "Temmuz";
                break;
            case 8:
                return "Ağustos";
                break;
            case 9:
                return "Eylül";
                break;
            case 10:
                return "Ekim";
                break;
            case 11:
                return "Kasım";
                break;
            case 12:
                return "Aralık";
                break;
            default:
                return "Yok";
                break;
        }

    }

    public function slug_kontrol($slug, $tip, $eski_slug = null)
    {
        if ($eski_slug1 = null && $slug == $eski_slug) {
            return $eski_slug;
        }
        if ($tip == "bagis") {
            $db_slug = Bagislar::where('slug', '=', $slug)->first();
        } else if ($tip == "haber") {
            $db_slug = Haberler::where('slug', '=', $slug)->first();
        }

        if ($db_slug) {
            return $this->slug_kontrol($slug . "-1", $tip);
        } else {
            return $slug;
        }
    }
}
