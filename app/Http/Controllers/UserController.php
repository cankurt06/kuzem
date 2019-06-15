<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profilim(){
        $kullanici_bilgileri=User::where('id',Auth::id())->first();
        return view('profilim',compact('kullanici_bilgileri'));
    }

    public function profil_guncelle(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'tc_kimlik'=>'required|string|min:11|max:11',
            'telefon'=>'required|string|min:11|max:11',
        ]);

        if (User::where('email',$request->email)->where('id','<>',Auth::id())->first()){
            return redirect()->route('profilim')->with('sonuc', ["warning", "Yeni Girdiğiniz Eposta Başkası Tarafından Kullanılıyor."]);
        }
        if (User::where('tc_kimlik',$request->tc_kimlik)->where('id','<>',Auth::id())->first()){
            return redirect()->route('profilim')->with('sonuc', ["warning", "Yeni Girdiğiniz TC Kimlik Başkası Tarafından Kullanılıyor."]);
        }
        if ($request->password!=null){
            if (strlen(trim($request->password))<6){
                return redirect()->route('profilim')->with('sonuc', ["warning", "Şifreniz En Az 6 Karakter Olmalıdır."]);
            }
            if (trim($request->password)!=$request->password_confirmation){
                return redirect()->route('profilim')->with('sonuc', ["warning", "Şifreler Eşleşmiyor"]);
            }
        }
        $kullanici_duzelt=User::where('id',Auth::id())->first();
        $kullanici_duzelt->name=$request->name;
        $kullanici_duzelt->email=$request->email;
        $kullanici_duzelt->password=Hash::make(trim($request->password));
        $kullanici_duzelt->telefon=$request->telefon;
        $kullanici_duzelt->tc_kimlik=$request->tc_kimlik;
        $kullanici_duzelt->save();
        return redirect()->route('profilim')->with('sonuc', ["success", "Profiliniz Başarıyla Güncellendi."]);
    }
}
