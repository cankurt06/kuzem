<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'AnasayfaController@index')->name('anasayfa');

Route::get('/cikis', 'Auth\LoginController@logout')->name('cikis');

Route::post('/cikis', 'Auth\LoginController@logout')->name('logout');

Route::get('/giris', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/giris', 'Auth\LoginController@login')->name('login_post');

Route::post('/sifre-sifirla-email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('/sifre-sifirla', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::post('/sifre-sifirla', 'Auth\ResetPasswordController@reset')->name('password.request.post');

Route::get('/sifre-sifirla/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/kayit-ol', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::post('/kayit-ol', 'Auth\RegisterController@register')->name('password.reset.post');

Route::get('hakkimizda', function () {
    return view('hakkimizda');
})->name('hakkimizda');

Route::get('iletisim', function () {
    return view('iletisim');
})->name('iletisim');

Route::post('bize-yazin','AnasayfaController@bize_yazin')->name('bize_yazin');

Route::get('bagislar/{slug?}','BagisController@bagislar')->name('bagislar');

Route::get('haberler/{slug?}','HaberController@haberler')->name('haberler');


Route::group(['middleware' => ['web', 'auth']], function () {

Route::get('bagis-yap/{slug?}','BagisController@bagis_yap')->name('bagis_yap');

Route::post('bagis-yap','BagisController@bagis_yap_post')->name('bagis_yap_post');

Route::get('bagislarim','BagisController@bagislarim')->name('bagislarim');

Route::get('sertifika-indir/{uuid}','BagisController@sertifika_indir')->name('sertifika_indir');
});

Route::group(['prefix' => 'yonetim', 'middleware' => ['web', 'auth', 'yonetim']], function () {
    Route::get('/', function () {
        return view('admin.anasayfa');
    })->name('admin_anasayfa');

    Route::get('/uyeler', function () {
        return view('admin.uyeler');
    })->name('admin_uyeler');

    Route::get('kullanici-sil/{id}','AdminController@kullanici_sil')->name('kullanici_sil');

    Route::get('kullanici-yonetici-yap/{id}','AdminController@kullanici_admin_yap')->name('kullanici_admin_yap');

    Route::get('/bagislar', function () {
        return view('admin.bagislar');
    })->name('admin_bagislar');

    Route::get('bagis-sil/{id}','AdminController@bagis_sil')->name('bagis_sil');

    Route::get('/bagis-ekle', function () {
        return view('admin.bagis_ekle');
    })->name('bagis_ekle');

    Route::post('bagis-ekle','AdminController@bagis_ekle')->name('bagis_ekle_post');

    Route::get('bagis-duzenle/{id}','AdminController@bagis_duzenle')->name('bagis_duzenle');

    Route::post('bagis-duzenle','AdminController@bagis_duzenle_post')->name('bagis_duzenle_post');

    Route::get('/yapilan-bagislar', function () {
        return view('admin.yapilan_bagislar');
    })->name('yapilan_bagislar');

    Route::get('odeme-sil/{id}','AdminController@odeme_sil')->name('odeme_sil');

    Route::get('odeme-yap/{id}','AdminController@odeme_yap')->name('odeme_yap');
});