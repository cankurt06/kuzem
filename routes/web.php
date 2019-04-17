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

Route::get('/', function () {
    return view('anasayfa');
})->name('anasayfa');

Route::get('hakkimizda', function () {
    return view('hakkimizda');
})->name('hakkimizda');

Route::get('bagislar', function () {
    return view('anasayfa');
})->name('bagislar');

Route::get('haberler', function () {
    return view('anasayfa');
})->name('haberler');

Route::get('iletisim', function () {
    return view('anasayfa');
})->name('iletisim');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['web', 'auth']], function () {


});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'yonetim']], function () {

});