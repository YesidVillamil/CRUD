<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestamosController;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/libro/create',[LibroController::class, 'create']);*/ 

Route::resource('libro', LibroController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [LibroController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [LibroController::class, 'index'])->name('home');
});

Route::resource('cliente', ClienteController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [ClienteController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [ClienteController::class, 'index'])->name('home');
});

Route::resource('prestamos', PrestamosController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [ClienteController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [ClienteController::class, 'index'])->name('home');
});
