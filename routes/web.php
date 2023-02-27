<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\ConfigurationController;
use App\Http\Controllers\Backend\RegisterController;
use App\Http\Controllers\Backend\QuizController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\OptionController;
use App\Http\Controllers\Backend\ResultController;

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
    Route::get('/configuration', [ConfigurationController::class,'index'])->name('configuration.index');
    Route::put('/configuration/{config}', [ConfigurationController::class,'update'])->name('configuration.update');
    Route::get('/register', [RegisterController::class,'index'])->name('register.index');
    Route::get('/users', [UserController::class,'index'])->name('user.index');
    Route::get('/users/create', [UserController::class,'create'])->name('user.create');
    Route::post('/users', [UserController::class,'store'])->name('user.store');
    Route::get('/users/{user}/edit', [UserController::class,'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class,'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class,'destroy'])->name('user.destroy');
    Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class,'store'])->name('category.store');
    Route::get('/categories/{categoria}/edit', [CategoryController::class,'edit'])->name('category.edit');
    Route::put('/categories/{categoria}', [CategoryController::class,'update'])->name('category.update');
    Route::delete('/categories/{categoria}', [CategoryController::class,'destroy'])->name('category.destroy');
    Route::get('/quizzes', [QuizController::class,'index'])->name('quiz.index');
    Route::get('/quizzes/create', [QuizController::class,'create'])->name('quiz.create');
    Route::post('/quizzes', [QuizController::class,'store'])->name('quiz.store');
    Route::get('/quizzes/{quiz}/edit', [QuizController::class,'edit'])->name('quiz.edit');
    Route::put('/quizzes/{quiz}', [QuizController::class,'update'])->name('quiz.update');
    Route::delete('/quizzes/{quiz}', [QuizController::class,'destroy'])->name('quiz.destroy');
    Route::get('/questions', [QuestionController::class,'index'])->name('question.index');
    Route::get('/questions/create/{quiz_id}', [QuestionController::class,'create'])->name('question.create');
    Route::post('/questions', [QuestionController::class,'store'])->name('question.store');
    Route::get('/questions/{ques}', [QuestionController::class,'show'])->name('question.show');
    Route::get('/questions/{ques}/edit/{quiz_id}', [QuestionController::class,'edit'])->name('question.edit');
    Route::put('/questions/{ques}', [QuestionController::class,'update'])->name('question.update');
    Route::delete('/questions/{ques}', [QuestionController::class,'destroy'])->name('question.destroy');
    Route::get('/options/create', [OptionController::class,'create'])->name('option.create');
    Route::post('/options', [OptionController::class,'store'])->name('option.store');
    Route::get('/options/{op}/edit', [OptionController::class,'edit'])->name('option.edit');
    Route::put('/options/{op}', [OptionController::class,'update'])->name('option.update');
    Route::delete('/options/{op}', [OptionController::class,'destroy'])->name('option.destroy');
    Route::get('/options/{op}', [OptionController::class,'show'])->name('option.show');
    Route::post('/options/setresult',[OptionController::class,'setResult']);
    Route::post('/options/getresult',[OptionController::class,'getResult']);
    Route::post('/resultquiz', [ResultController::class,'store'])->name('result.destroy');
    Route::put('/resultquiz/{res}', [ResultController::class,'update'])->name('result.destroy');
    Route::get('/posts', [PostController::class,'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class,'create'])->name('post.create');
    Route::post('/posts', [PostController::class,'store'])->name('post.store');
    Route::get('/posts/{post}/edit', [PostController::class,'edit'])->name('post.edit');
    Route::put('/posts/{post}', [PostController::class,'update'])->name('post.update');
    Route::delete('/posts/{post}', [PostController::class,'destroy'])->name('post.destroy');
    Route::get('/tags', [TagController::class,'index'])->name('tag.index');
    Route::get('/tags/create', [TagController::class,'create'])->name('tag.create');
    Route::post('/tags', [TagController::class,'store'])->name('tag.store');
    Route::get('/tags/{post}/edit', [TagController::class,'edit'])->name('tag.edit');
    Route::put('/tags/{post}', [TagController::class,'update'])->name('tag.update');
    Route::delete('/tags/{post}', [TagController::class,'destroy'])->name('tag.destroy');
    Route::get('/authors', [AuthorController::class,'index'])->name('author.index');
    Route::get('/authors/create', [AuthorController::class,'create'])->name('author.create');
    Route::post('/authors', [AuthorController::class,'store'])->name('author.store');
    Route::get('/authors/{post}/edit', [AuthorController::class,'edit'])->name('author.edit');
    Route::put('/authors/{post}', [AuthorController::class,'update'])->name('author.update');
    Route::delete('/authors/{post}', [AuthorController::class,'destroy'])->name('author.destroy');
    Route::get('/media', [AdminController::class,'media']);
    
});

Route::get('/articulos/{posttype}', [HomeController::class, 'posttype']);
Route::get('/buscar/{word}', [HomeController::class, 'resultados']);
Route::get('/tag/{tag}', [HomeController::class, 'tag']);
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/{categoria}', [HomeController::class, 'categoria']);
Route::get('/{categoria}/{subcategoria}', [HomeController::class, 'subcategoria']);
Route::get('/{categoria}/{subcategoria}/{slug}', [HomeController::class, 'articulo']);
Route::get('/categories', [HomeController::class, 'categories']);
//asinc
Route::post('/suscribirse', [HomeController::class, 'suscribirse']);
Route::post('/search', [HomeController::class, 'buscar']);
Route::post('/getoptresult', [HomeController::class,'getOptResult']);
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');
//Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//    ->name('ckfinder_browser');
