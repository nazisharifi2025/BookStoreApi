<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MembersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('Author' , AuthorController::class);
Route::apiResource('Book' , BookController::class);
Route::apiResource('Members', MembersController::class);
Route::apiResource('Borrow', BorrowingController::class)->only(['index', 'store', 'show']);
