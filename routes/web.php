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

});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'yonetim']], function () {
    Route::get('/', function () {
        return view('admin.anasayfa');
    })->name('admin_anasayfa');
});