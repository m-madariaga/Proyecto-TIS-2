<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/page', function () {
        return view('page');
    })->name('page');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/productos',[ProductoController::class,'index'])->name('productos');
    Route::get('/productos/create',[ProductoController::class,'create'])->name('productos-create');
    Route::post('/productos/store',[ProductoController::class,'store'])->name('productos-store');
    Route::get('/productos/{id}/edit',[ProductoController::class,'edit'])->name('productos-edit');
    Route::patch('/productos/{id}/update',[ProductoController::class,'update'])->name('productos-update');
    Route::delete('/productos/{id}',[ProductoController::class,'destroy'])->name('productos-destroy');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
