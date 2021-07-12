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

    Route::get('/posts', [PostController::class,'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class,'create'])->name('post.create');
    Route::post('/posts', [PostController::class,'store'])->name('post.store');
    Route::get('/posts/{user}/edit', [PostController::class,'edit'])->name('post.edit');
    Route::put('/posts/{user}', [PostController::class,'update'])->name('post.update');
    Route::delete('/posts/{user}', [PostController::class,'destroy'])->name('post.destroy');

    Route::get('/media', [AdminController::class,'media']);


});

Route::get('/', [HomeController::class, 'index']);
Route::get('/{categoria}', [HomeController::class, 'categoria']);
Route::get('/{categoria}/{subcategoria}', [HomeController::class, 'subcategoria']);


Route::get('/{categoria}/{subcategoria}/{slug}', [HomeController::class, 'articulo']);


//Route::get('/{categoria}/{subcategoria}/{slug}', [HomeController::class, 'articulo']);

Route::get('/categories', [HomeController::class, 'categories']);


Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
