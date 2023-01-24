<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/',[App\Http\Controllers\FrontendController::class,'index']);
Route::get('/history',[App\Http\Controllers\FrontendController::class,'history']);
Route::get('/item_lelang/{id_lelang}',[App\Http\Controllers\FrontendController::class,'item_lelang']);
Route::middleware(['auth','masyarakat-auth'])->group(function(){
    Route::post('/tawar/{id_lelang}',[App\Http\Controllers\FrontendController::class,'tawar_item']);
    Route::get('/current_bid',[App\Http\Controllers\FrontendController::class,'current_bid']);
});

Auth::routes();

Route::prefix('admin')->middleware(['auth','admin-auth'])->group( function(){

    Route::get('/',[App\Http\Controllers\AdminController::class,'index']);
    // === USER ===
        // +++ MASYARAKAT +++
        Route::get('/user',[App\Http\Controllers\UserController::class,'index']);
        // +++ MASYARAKAT +++
        // +++ PETUGAS +++
        Route::get('/user_petugas',[App\Http\Controllers\UserController::class,'user_petugas']);
        Route::get('/tambah_user_petugas',[App\Http\Controllers\UserController::class,'tambah_user_petugas']);
        Route::post('/tambah_data_petugas',[App\Http\Controllers\UserController::class,'tambah_data_petugas']);
        // +++ PETUGAS +++
    // === USER ===
    // === LELANG ===
        // +++ LELANG DIBUKA +++
        Route::get('/lelang_dibuka',[App\Http\Controllers\LelangController::class,'index']);
        Route::get('/open_lelang',[App\Http\Controllers\LelangController::class,'tambah_lelang']);
        Route::post('/tambah_open_lelang',[App\Http\Controllers\LelangController::class,'tambah_data_lelang']);
        // +++ LELANG DIBUKA +++

        // +++ LELANG DITUTUP +++
        Route::get('/lelang_ditutup',[App\Http\Controllers\LelangController::class,'lelang_ditutup']);
        Route::get('/history_bidding/{id_lelang}',[App\Http\Controllers\LelangController::class,'history_lelang']);
        // +++ LELANG DITUTUP +++
    // === LELANG ===

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
