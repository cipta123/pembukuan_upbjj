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
    return view('guest/entry');
});
//----------------------------------------------------------
Route::get('/entry', function () {
    return view('guest/entry');
});
Route::post('/entry_process_1','entryController@entry_process_1');
Route::get('/lap/bku_process','lapController@bkuProcess');
Route::get('/lap/ba_process','baController@baProcess');
Route::get('/lap/pajak_process','pajakController@pajakProcess');
Route::get('/lap/lpj_process','lpjController@lpjProcess');


Route::get('/laporan', function () {
    return view('guest/laporan');
});


//---------------------------------------------------------
Route::post('/login/validate', 'loginController@validate');

//-------------------latihan css grid---------------//
Route::get('/css-grid', function () {
    return view('css_grid/lat_satu');
});
Route::get('/css-grid-1', function () {
    return view('css_grid/css_grid_traversy');
});
Route::get('/css-grid-2', function () {
    return view('css_grid/lat_dua');
});


//-------------------latihan css grid---------------//