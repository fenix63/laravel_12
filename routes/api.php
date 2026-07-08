<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
Route::post('/addmessage/', [MessageController::class, 'addMessage']);
Route::get('/getrecords/', [MessageController::class, 'findRecords']);
Route::get('/getallrecords/', [MessageController::class, 'getAllRecords']);
Route::post('/updaterecord/', [MessageController::class, 'updateMessage']);
Route::post('/deleterecord/', [MessageController::class, 'deleterecord']);



Route::post('/addpost/',[PostController::class,'addRecord']);

//TODO:доделать
//Параметр {id} нужно указать в методе editRecord - чтоб он туда передавался
Route::post('/posts/{id}/edit',[PostController::class,'editRecord']);
*/

Route::post('/addpost/', [PostController::class, 'create']);