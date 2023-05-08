<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller\RolesController;
use App\Http\Controllers\Controller\PermissionsController;

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
  
    Route::get('/calendar', [App\Http\Controllers\EventController::class, 'index'])->name('calendar');;
    
    Route::get('/roles', [App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [App\Http\Controllers\RolesController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles/{id}', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [App\Http\Controllers\RolesController::class, 'destroy'])->name('roles.destroy');

    Route::get('/permissions', [App\Http\Controllers\PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [App\Http\Controllers\PermissionsController::class, 'create'])->name('permissions.create');
    Route::post('/permissions/store', [App\Http\Controllers\PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [App\Http\Controllers\PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::patch('/permissions/{id}', [App\Http\Controllers\PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{id}', [App\Http\Controllers\PermissionsController::class, 'destroy'])->name('permissions.destroy');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin_home');

});

Route::group(['middleware' => ['permission:vista analista'], 'prefix' => 'analista'], function () {
    //insertar rutas de analista aqui


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('analista_home');
});


Auth::routes();

//Remover la ruta de abajo una vez que se pueda cerrar sesión desde el landing
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
