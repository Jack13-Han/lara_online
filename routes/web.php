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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){
    Route::resource("category",\App\Http\Controllers\CategoryController::class)->middleware('isAdmin');
    Route::resource("post",\App\Http\Controllers\PostController::class);
    Route::resource('photo',\App\Http\Controllers\PhotoController::class);
    Route::resource("tag",\App\Http\Controllers\TagController::class);
});

