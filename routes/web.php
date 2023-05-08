<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

    Route::get('/productos',[ProductController::class,'index'])->name('productos');
    Route::get('/productos/create',[ProductController::class,'create'])->name('productos-create');
    Route::post('/productos/store',[ProductController::class,'store'])->name('productos-store');
    Route::get('/productos/{id}/edit',[ProductController::class,'edit'])->name('productos-edit');
    Route::patch('/productos/{id}/update',[ProductController::class,'update'])->name('productos-update');
    Route::delete('/productos/{id}',[ProductController::class,'destroy'])->name('productos-destroy');

    Route::get('/categorias',[CategoryController::class,'index'])->name('categorias');
    Route::get('/categorias/create',[CategoryController::class,'create'])->name('categorias-create');
    Route::post('/categorias/store',[CategoryController::class,'store'])->name('categorias-store');
    Route::get('/categorias/{id}/edit',[CategoryController::class,'edit'])->name('categorias-edit');
    Route::patch('/categorias/{id}/update',[CategoryController::class,'update'])->name('categorias-update');
    Route::delete('/categorias/{id}',[CategoryController::class,'destroy'])->name('categorias-destroy');

    Route::get('/marcas',[BrandController::class,'index'])->name('marcas');
    Route::get('/marcas/create',[BrandController::class,'create'])->name('marcas-create');
    Route::post('/marcas/store',[BrandController::class,'store'])->name('marcas-store');
    Route::get('/marcas/{id}/edit',[BrandController::class,'edit'])->name('marcas-edit');
    Route::patch('/marcas/{id}/update',[BrandController::class,'update'])->name('marcas-update');
    Route::delete('/marcas/{id}',[BrandController::class,'destroy'])->name('marcas-destroy');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
