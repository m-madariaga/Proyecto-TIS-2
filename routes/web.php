<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['permission:vista admin'], 'prefix' => 'admin'], function () {
    //insertar rutas de admin aqui

    Route::get('/tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/page', function () {
        return view('page');
    })->name('page');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin_home');

});

Route::group(['middleware' => ['permission:vista analista'], 'prefix' => 'analista'], function () {
    //insertar rutas de analista aqui


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('analista_home');
});


Auth::routes();

//Remover la ruta de abajo una vez que se pueda cerrar sesión desde el landing
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
