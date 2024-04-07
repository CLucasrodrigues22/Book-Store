<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});


Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('profile', 'App\Http\Controllers\AuthController@profile');
    Route::Apiresource('books', 'App\Http\Controllers\BooksController');
    Route::Apiresource('stores', 'App\Http\Controllers\StoresController');
    Route::Apiresource('bookstore', 'App\Http\Controllers\BookstoreController');
});
