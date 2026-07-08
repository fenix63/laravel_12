<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{id}',[PostController::class,'show'])->name('postdetail');
Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('postedit');
Route::post('/posts/{id}/edit',[PostController::class,'update'])->name('postupdate');
*/


Route::get('/posts', function () {
	return view('home');
})->name('home');