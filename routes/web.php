<?php

use Illuminate\Http\Request;
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


Route::get('/posts', function (Request $request) {
	$obj = new PostController();
	$posts = $obj->show($request);
	return view('home', ['posts' => $posts['result']]);
})->name('home');

//Route::get('/posts',[PostController::class,'home']);

/*Route::get('/post/{id}', function (Request $request) {
	$obj = new PostController();
	$postData = $obj->getPost($request);
	return view('postitem');
})->name('postitem');
*/

Route::get('/postitem/{id}', [PostController::class, 'showPostItem'])->name('postitem');