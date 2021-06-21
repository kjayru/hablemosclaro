<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/{categoria}', [HomeController::class, 'categoria']);
Route::get('/{categoria}/{subcategoria}', [HomeController::class, 'subcategoria']);
Route::get('/{categoria}/{subcategoria}/{articulo}', [HomeController::class, 'articulo']);

Route::get('/categories', [HomeController::class, 'categories']);


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
  ]);


Route::group(['prefix' => 'admin'],function(){

    Route::get('/', [AdminController::class,'index'])->name('dashboard');

    Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class,'store'])->name('category.store');
    Route::get('/categories/{user}/edit', [CategoryController::class,'edit'])->name('category.edit');
    Route::put('/categories/{user}', [CategoryController::class,'update'])->name('category.update');
    Route::delete('/categories/{user}', [CategoryController::class,'destroy'])->name('category.destroy');


});
